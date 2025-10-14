<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../config.php';
// Load Composer autoload; return helpful error if missing
$autoload = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($autoload)) {
  echo json_encode(['success' => false, 'error' => 'Dependencies not installed. Run composer install in project root.']);
  exit;
}
require_once $autoload;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'] ?? '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo json_encode(['success' => false, 'error' => 'Invalid email']);
  exit;
}

$otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);

$conn = get_db_connection();
$stmt = $conn->prepare('INSERT INTO otp_codes (email, otp_code, expires_at, used) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL ? MINUTE), 0)');
$expiry = OTP_EXPIRY_MINUTES;
$stmt->bind_param('ssi', $email, $otp, $expiry);
$ok = $stmt->execute();

if(!$ok){ echo json_encode(['success'=>false,'error'=>'Could not create OTP']); exit; }

try {
  $mailer = new PHPMailer(true);
  $mailer->isSMTP();
  $mailer->Host = SMTP_HOST;
  $mailer->SMTPAuth = true;
  $mailer->Username = SMTP_USER;
  $mailer->Password = SMTP_PASS;
  $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mailer->Port = SMTP_PORT;
  $mailer->setFrom(SMTP_USER, SMTP_FROM_NAME);
  $mailer->addAddress($email);
  $mailer->isHTML(true);
  $mailer->Subject = 'Your DTS Email Verification Code';
  $mailer->Body = '<div style="font-family:Arial,sans-serif">'
    .'<h2 style="background:linear-gradient(180deg,' . COLOR_PRIMARY . ',' . COLOR_PRIMARY_LIGHT . ');padding:16px;color:#fff;margin:0">Welcome to Document Tracking System</h2>'
    .'<div style="padding:20px">'
    .'<h3 style="color:#3b0764;margin:0 0 8px">Verify Your Email Address</h3>'
    .'<p>Please use the following 6-digit code to verify your email:</p>'
    .'<div style="border:2px solid ' . COLOR_PRIMARY . ';padding:16px;text-align:center;border-radius:12px;font-size:28px;font-weight:800;color:' . COLOR_PRIMARY_DARK . '">' . $otp . '</div>'
    .'<p style="margin-top:12px;color:#555;font-size:12px">This code expires in ' . OTP_EXPIRY_MINUTES . ' minutes.</p>'
    .'</div></div>';
  $mailer->send();
  echo json_encode(['success'=>true]);
} catch (Exception $e) {
  echo json_encode(['success'=>false,'error'=>'Failed to send email: ' . $e->getMessage()]);
}



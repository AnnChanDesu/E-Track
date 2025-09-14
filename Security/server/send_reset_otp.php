<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../config.php';
$autoload = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($autoload)) { echo json_encode(['success'=>false,'error'=>'Dependencies not installed. Run composer install.']); exit; }
require_once $autoload;

use PHPMailer\PHPMailer\PHPMailer;

$email = $_POST['email'] ?? '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { echo json_encode(['success'=>false,'error'=>'Invalid email']); exit; }

$conn = get_db_connection();

// Only send if user exists (but do not reveal existence to client)
$userStmt = $conn->prepare('SELECT id FROM users WHERE email=? LIMIT 1');
$userStmt->bind_param('s', $email);
$userStmt->execute();
$user = $userStmt->get_result()->fetch_assoc();
if(!$user){ echo json_encode(['success'=>true]); exit; }

$otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
$expiry = OTP_EXPIRY_MINUTES;
$stmt = $conn->prepare('INSERT INTO otp_codes (email, otp_code, expires_at, used) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL ? MINUTE), 0)');
$stmt->bind_param('ssi', $email, $otp, $expiry);
$stmt->execute();

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
$mailer->Subject = 'DTS Password Reset Code';
$mailer->Body = '<div style="font-family:Arial,sans-serif">'
  .'<h2 style="background:linear-gradient(180deg,' . COLOR_PRIMARY . ',' . COLOR_PRIMARY_LIGHT . ');padding:16px;color:#fff;margin:0">Password Reset</h2>'
  .'<div style="padding:20px">'
  .'<p>Use this 6-digit code to reset your password:</p>'
  .'<div style="border:2px solid ' . COLOR_PRIMARY . ';padding:16px;text-align:center;border-radius:12px;font-size:28px;font-weight:800;color:' . COLOR_PRIMARY_DARK . '">' . $otp . '</div>'
  .'<p style="margin-top:12px;color:#555;font-size:12px">This code expires in ' . OTP_EXPIRY_MINUTES . ' minutes.</p>'
  .'</div></div>';
$mailer->send();

echo json_encode(['success'=>true]);



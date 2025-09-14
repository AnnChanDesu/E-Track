<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db.php';

$email = $_POST['email'] ?? '';
$code = $_POST['code'] ?? '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^\d{6}$/', $code)) {
  echo json_encode(['success'=>false,'error'=>'Invalid input']);
  exit;
}

$conn = get_db_connection();
$stmt = $conn->prepare('SELECT id FROM otp_codes WHERE email = ? AND otp_code = ? AND used = 0 AND expires_at > NOW() ORDER BY id DESC LIMIT 1');
$stmt->bind_param('ss', $email, $code);
$stmt->execute();
$res = $stmt->get_result();
$row = $res->fetch_assoc();

if($row){
  $upd = $conn->prepare('UPDATE otp_codes SET used = 1 WHERE id = ?');
  $upd->bind_param('i', $row['id']);
  $upd->execute();
  echo json_encode(['success'=>true]);
} else {
  echo json_encode(['success'=>false,'error'=>'Invalid or expired code']);
}



<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db.php';

$email = $_POST['email'] ?? '';
$code = $_POST['code'] ?? '';
$new = $_POST['new_password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if(!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^\d{6}$/', $code)){
  echo json_encode(['success'=>false,'error'=>'Invalid input']);
  exit;
}
if($new === '' || $new !== $confirm){
  echo json_encode(['success'=>false,'error'=>'Passwords do not match']);
  exit;
}

$conn = get_db_connection();
$find = $conn->prepare('SELECT id FROM otp_codes WHERE email=? AND otp_code=? AND used=0 AND expires_at>NOW() ORDER BY id DESC LIMIT 1');
$find->bind_param('ss', $email, $code);
$find->execute();
$row = $find->get_result()->fetch_assoc();
if(!$row){
  echo json_encode(['success'=>false,'error'=>'Invalid or expired code']);
  exit;
}

$hash = password_hash($new, PASSWORD_BCRYPT);
$upd = $conn->prepare('UPDATE users SET password=? WHERE email=?');
$upd->bind_param('ss', $hash, $email);
$upd->execute();

$mark = $conn->prepare('UPDATE otp_codes SET used=1 WHERE id=?');
$mark->bind_param('i', $row['id']);
$mark->execute();

echo json_encode(['success'=>true]);



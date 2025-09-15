<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = isset($_POST['remember']) && $_POST['remember'] === 'on';
if($username === '' || $password === ''){
  echo json_encode(['success'=>false,'error'=>'Missing credentials']);
  exit;
}

$conn = get_db_connection();
$stmt = $conn->prepare('SELECT id, password, email_verified FROM users WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc();

if($user && password_verify($password, $user['password'])){
  if(!(int)$user['email_verified']){
    echo json_encode(['success'=>false,'error'=>'Email not verified']);
    exit;
  }
  if($remember){
    // Create remember token valid for 30 days
    $token = bin2hex(random_bytes(32));
    $expiresDays = 30;
    $conn->query("CREATE TABLE IF NOT EXISTS remember_tokens (id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, token VARCHAR(128) NOT NULL, expires_at DATETIME NOT NULL, INDEX(token))");
    $ins = $conn->prepare('INSERT INTO remember_tokens (user_id, token, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL ? DAY))');
    $ins->bind_param('isi', $user['id'], $token, $expiresDays);
    $ins->execute();
    setcookie('dts_remember', $token, time()+60*60*24*$expiresDays, '/', '', false, true);
  }
  echo json_encode(['success'=>true]);
} else {
  echo json_encode(['success'=>false,'error'=>'Invalid username or password']);
}



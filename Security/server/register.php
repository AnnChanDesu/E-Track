<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db.php';

$fields = [
  'first_name','last_name','address','id_number','department','year','email','username','password'
];

foreach($fields as $f){ if(!isset($_POST[$f]) || $_POST[$f]===''){ echo json_encode(['success'=>false,'error'=>'Missing field: '.$f]); return; } }

$email = $_POST['email'];
$username = $_POST['username'];
$idNumber = $_POST['id_number'];
$password = $_POST['password'];
$conn = get_db_connection();

// Password policy: 8-12, mix letters, numbers, special
if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,12}$/', $password)) {
  echo json_encode(['success'=>false,'error'=>'Password must be 8-12 chars and include letters, numbers, and special characters']);
  exit;
}

// Username policy: 6-12 chars, first 4 letters, rest letters/numbers
if (!preg_match('/^[A-Za-z]{4}[A-Za-z0-9]{2,8}$/', $username)) {
  echo json_encode(['success'=>false,'error'=>'Username must be 6-12 chars, start with 4 letters, remaining may include numbers']);
  exit;
}

// Ensure email verified
$check = $conn->prepare('SELECT id FROM otp_codes WHERE email=? AND used=1 ORDER BY id DESC LIMIT 1');
$check->bind_param('s', $email);
$check->execute();
if(!$check->get_result()->fetch_assoc()){
  echo json_encode(['success'=>false,'error'=>'Please verify your email first']);
  exit;
}

$hash = password_hash($password, PASSWORD_BCRYPT);

// Uniqueness checks
$dupe = $conn->prepare('SELECT email, username, id_number FROM users WHERE email = ? OR username = ? OR id_number = ? LIMIT 1');
$dupe->bind_param('sss', $email, $username, $idNumber);
$dupe->execute();
$existing = $dupe->get_result()->fetch_assoc();
if($existing){
  if($existing['email'] === $email){ echo json_encode(['success'=>false,'error'=>'Email is already registered']); exit; }
  if($existing['username'] === $username){ echo json_encode(['success'=>false,'error'=>'Username is already taken']); exit; }
  if($existing['id_number'] === $idNumber){ echo json_encode(['success'=>false,'error'=>'ID Number is already used']); exit; }
}

$stmt = $conn->prepare('INSERT INTO users (first_name,last_name,address,id_number,department,year,email,username,password,email_verified) VALUES (?,?,?,?,?,?,?,?,?,1)');
$stmt->bind_param('sssssisss', $_POST['first_name'], $_POST['last_name'], $_POST['address'], $_POST['id_number'], $_POST['department'], $_POST['year'], $email, $_POST['username'], $hash);

try {
  $stmt->execute();
  echo json_encode(['success'=>true]);
} catch (mysqli_sql_exception $e) {
  echo json_encode(['success'=>false,'error'=>'Could not register user']);
}



<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db.php';

$token = $_COOKIE['dts_remember'] ?? ($_POST['token'] ?? '');
if($token === ''){ echo json_encode(['success'=>false]); exit; }

$conn = get_db_connection();
$stmt = $conn->prepare('SELECT user_id FROM remember_tokens WHERE token = ? AND expires_at > NOW()');
$stmt->bind_param('s', $token);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
if($row){ echo json_encode(['success'=>true, 'user_id'=>$row['user_id']]); }
else { echo json_encode(['success'=>false]); }



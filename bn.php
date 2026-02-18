<?php
require 'config.php';

$headers = getallheaders();
if (!isset($headers['X-API-KEY']) || $headers['X-API-KEY'] !== API_KEY) {
    http_response_code(401);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);
if (!$input || !isset($input['device_id'])) {
    http_response_code(400);
    exit;
}

$device_id = $conn->real_escape_string($input['device_id']);
$device_name = $conn->real_escape_string($input['device_name'] ?? '');
$payload = $conn->real_escape_string(json_encode($input));
$ip = $_SERVER['REMOTE_ADDR'];

/* Update device */
$conn->query("
INSERT INTO devices (device_id, device_name, ip_address, last_seen, payload)
VALUES ('$device_id','$device_name','$ip',NOW(),'$payload')
ON DUPLICATE KEY UPDATE
last_seen=NOW(), ip_address='$ip', payload='$payload'
");

/* Fetch pending commands */
$cmds = [];
$res = $conn->query("
SELECT id, message FROM messages
WHERE device_id='$device_id'
AND sender='ADMIN'
AND delivered=0
");

while ($row = $res->fetch_assoc()) {
    $cmds[] = $row['message'];
    $conn->query("UPDATE messages SET delivered=1 WHERE id=".$row['id']);
}

/* Respond with commands */
echo json_encode([
    "commands" => $cmds
]);

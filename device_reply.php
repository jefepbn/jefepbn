<?php
require 'config.php';

$headers = getallheaders();
if ($headers['X-API-KEY'] !== API_KEY) exit;

$input = json_decode(file_get_contents("php://input"), true);

$device_id = $conn->real_escape_string($input['device_id']);
$message = $conn->real_escape_string($input['message']);

$conn->query("
INSERT INTO messages (device_id, sender, message)
VALUES ('$device_id','DEVICE','$message')
");

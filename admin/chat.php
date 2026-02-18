<?php
session_start();
require '../config.php';
if (!isset($_SESSION['logged_in'])) exit;

$device_id = $_GET['device'];
$result = $conn->query("
SELECT sender, message, created_at
FROM messages
WHERE device_id='$device_id'
ORDER BY created_at
");
?>

<link rel="stylesheet" href="chat.css">

<div class="chat">
<?php while($row = $result->fetch_assoc()): ?>
<div class="<?= strtolower($row['sender']) ?>">
    <?= htmlspecialchars($row['message']) ?>
</div>
<?php endwhile; ?>
</div>

<form method="POST">
    <input name="msg" placeholder="Type message..." required>
    <button>Send</button>
</form>

<?php
if ($_POST) {
    $msg = $conn->real_escape_string($_POST['msg']);
    $conn->query("
    INSERT INTO messages (device_id, sender, message)
    VALUES ('$device_id','ADMIN','$msg')
    ");
    header("Refresh:0");
}

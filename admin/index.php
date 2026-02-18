<?php
session_start();
require '../config.php';

/* Authentication Check */

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit;
}

/* Offline Threshold (seconds) */
$OFFLINE_THRESHOLD = 60;

/* Fetch Devices */

$result = $conn->query("
    SELECT 
        device_id,
        device_name,
        ip_address,
        last_seen,
        CASE
            WHEN last_seen < NOW() - INTERVAL $OFFLINE_THRESHOLD SECOND
            THEN 'OFFLINE'
            ELSE 'ONLINE'
        END AS status
    FROM devices
    ORDER BY last_seen DESC
");
?>

<link rel="stylesheet" href="styles.css">

<h1>Device Dashboard</h1>
<a href="logout.php">Logout</a>

<table>
    <tr>
        <th>Device ID</th>
        <th>Name</th>
        <th>IP Address</th>
        <th>Last Seen</th>
        <th>Status</th>
        <th>Chat</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['device_id']) ?></td>
        <td><?= htmlspecialchars($row['device_name']) ?></td>
        <td><?= htmlspecialchars($row['ip_address']) ?></td>
        <td><?= htmlspecialchars($row['last_seen']) ?></td>

        <td class="<?= strtolower($row['status']) ?>">
            <?= $row['status'] ?>
        </td>

        <td>
            <a href="chat.php?device=<?= urlencode($row['device_id']) ?>">
                Chat
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

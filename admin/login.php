<?php
session_start();
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['username'] === ADMIN_USER &&
        $_POST['password'] === ADMIN_PASS) {

        $_SESSION['logged_in'] = true;
        header("Location: index.php");
        exit;
    }

    $error = "Invalid credentials";
}
?>

<form method="POST">
    <h2>Admin Login</h2>
    <input name="username" placeholder="Username" required>
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Login</button>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
</form>

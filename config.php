<?php

/* =========================
   Database Configuration
   ========================= */

$DATABASE_URL = getenv('DATABASE_URL');

if (!$DATABASE_URL) {
    die("DATABASE_URL not set");
}

try {
    $conn = new PDO(
        $DATABASE_URL,
        null,
        null,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("DB Connection Failed");
}

/* =========================
   System Configuration
   ========================= */

define('API_KEY', 'my-secret-key');     // Change in production
define('ADMIN_USER', 'admin');          // Change in production
define('ADMIN_PASS', 'password');       // Change in production

<?php

/* Database Configuration (Render PostgreSQL) */

$DB_HOST = getenv('DB_HOST');
$DB_PORT = getenv('DB_PORT') ?: '5432';
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

try {
    $conn = new PDO(
        "pgsql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME",
        $DB_USER,
        $DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("DB Connection Failed");
}

/* System Configuration */

define('API_KEY', 'my-secret-key');
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'password');   // Change for production

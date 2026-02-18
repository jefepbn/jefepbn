<?php

$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die("DB Connection Failed");
}

/* System Configuration */

define('API_KEY', 'my-secret-key');
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'password');   // Change for production

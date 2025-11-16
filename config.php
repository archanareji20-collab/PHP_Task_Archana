<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'event_db';

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_errno) {
    die('DB connect error: ' . $mysqli->connect_error);
}

define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'password123');

session_start();
?>

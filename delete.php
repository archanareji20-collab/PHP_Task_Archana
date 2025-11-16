<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$id = (int) $_GET['id'];

// Delete the registration
$stmt = $mysqli->prepare("DELETE FROM registrations WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();

header('Location: dashboard.php');
exit;

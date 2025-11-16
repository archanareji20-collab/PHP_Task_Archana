<?php
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET['reg_id'])) {
    header('Location: index.php');
    exit;
}

$reg_id = (int) $_GET['reg_id'];

// Fetch registration info
$stmt = $mysqli->prepare('SELECT r.name, e.name AS event_name, e.event_date FROM registrations r JOIN events e ON r.event_id = e.id WHERE r.id = ?');
$stmt->bind_param('i', $reg_id);
$stmt->execute();
$registration = $stmt->get_result()->fetch_assoc();

if (!$registration) {
    header('Location: index.php');
    exit;
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registration Success</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
<h1>Registration Successful!</h1>
<p>Thank you, <strong><?php echo htmlspecialchars($registration['name']); ?></strong>, for registering.</p>
<p>Event: <strong><?php echo htmlspecialchars($registration['event_name']); ?></strong></p>
<p>Date: <?php echo date('F j, Y', strtotime($registration['event_date'])); ?></p>
<p><a href="index.php">Back to events</a></p>
</div>
</body>
</html>

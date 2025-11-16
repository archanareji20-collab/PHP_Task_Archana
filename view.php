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

$stmt = $mysqli->prepare("
    SELECT r.id, r.name, r.email, e.name AS event_name, e.event_date, r.date_registered
    FROM registrations r
    JOIN events e ON r.event_id = e.id
    WHERE r.id = ?
");
$stmt->bind_param('i', $id);
$stmt->execute();
$registration = $stmt->get_result()->fetch_assoc();

if (!$registration) {
    header('Location: dashboard.php');
    exit;
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Registration</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
<h1>Registration Details</h1>
<p><strong>Name:</strong> <?php echo htmlspecialchars($registration['name']); ?></p>
<p><strong>Email:</strong> <?php echo htmlspecialchars($registration['email']); ?></p>
<p><strong>Event:</strong> <?php echo htmlspecialchars($registration['event_name']); ?></p>
<p><strong>Event Date:</strong> <?php echo date('F j, Y', strtotime($registration['event_date'])); ?></p>
<p><strong>Registered On:</strong> <?php echo date('F j, Y H:i', strtotime($registration['date_registered'])); ?></p>
<p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>

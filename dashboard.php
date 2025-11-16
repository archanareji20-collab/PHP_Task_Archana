<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}

// Fetch all registrations
$result = $mysqli->query("
    SELECT r.id, r.name, r.email, e.name AS event_name, e.event_date, r.date_registered
    FROM registrations r
    JOIN events e ON r.event_id = e.id
    ORDER BY r.date_registered DESC
");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../assets/style.css">
<style>
table { border-collapse: collapse; width: 100%; }
th, td { padding: 8px; border: 1px solid #ccc; text-align: left; }
th { background: #eee; }
</style>
</head>
<body>
<div class="container">
<h1>Admin Dashboard</h1>
<p><a href="logout.php">Logout</a> | <a href="../index.php">Back to events</a></p>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Event</th>
    <th>Date Registered</th>
    <th>Action</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['email']); ?></td>
    <td><?php echo htmlspecialchars($row['event_name']); ?></td>
    <td><?php echo date('F j, Y', strtotime($row['date_registered'])); ?></td>
    <td>
        <a href="view.php?id=<?php echo $row['id']; ?>">View</a> | 
        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</div>
</body>
</html>

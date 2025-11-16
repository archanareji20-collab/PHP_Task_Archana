<?php
require_once 'config.php';
$result = $mysqli->query("SELECT id, name, description, event_date FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Events - Home</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
<h1>Upcoming Events</h1>
<a class="admin-link" href="admin/login.php">Admin</a>
<div class="events">
<?php while ($row = $result->fetch_assoc()): ?>
<div class="event">
<h2><?php echo htmlspecialchars($row['name']); ?></h2>
<p class="date"><?php echo date('F j, Y', strtotime($row['event_date'])); ?></p>
<p><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
<a class="btn" href="register.php?event_id=<?php echo $row['id']; ?>">Register</a>
</div>
<?php endwhile; ?>
<?php if ($result->num_rows === 0): ?>
<p>No upcoming events.</p>
<?php endif; ?>
</div>
</div>
</body>
</html>

<?php
require_once 'config.php';

// Enable error reporting (for debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$event = null;
$errors = [];

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $event_id = (int) ($_POST['event_id'] ?? 0);

    // Validate inputs
    if ($name === '') $errors[] = 'Name is required.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if ($event_id <= 0) $errors[] = 'Invalid event.';

    // If no errors, save registration
    if (empty($errors)) {
        $stmt = $mysqli->prepare('INSERT INTO registrations (name, email, event_id) VALUES (?, ?, ?)');
        $stmt->bind_param('ssi', $name, $email, $event_id);
        if ($stmt->execute()) {
            // Redirect to success page
            header('Location: success.php?reg_id=' . $stmt->insert_id);
            exit;
        } else {
            $errors[] = 'Database error: ' . $mysqli->error;
        }
    }

    // Fetch event info again (needed to display form after POST errors)
    $stmt2 = $mysqli->prepare('SELECT id, name, event_date FROM events WHERE id = ?');
    $stmt2->bind_param('i', $event_id);
    $stmt2->execute();
    $event = $stmt2->get_result()->fetch_assoc();
}

// If GET request, fetch event by ID
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['event_id'])) {
        header('Location: index.php');
        exit;
    }

    $event_id = (int) $_GET['event_id'];
    $stmt = $mysqli->prepare('SELECT id, name, event_date FROM events WHERE id = ?');
    $stmt->bind_param('i', $event_id);
    $stmt->execute();
    $event = $stmt->get_result()->fetch_assoc();

    if (!$event) {
        header('Location: index.php');
        exit;
    }
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register - <?php echo htmlspecialchars($event['name']); ?></title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
<h1>Register for: <?php echo htmlspecialchars($event['name']); ?></h1>

<?php if (!empty($errors)): ?>
<div class="errors">
    <?php foreach ($errors as $e): ?>
        <p><?php echo htmlspecialchars($e); ?></p>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<form method="post" action="register.php">
    <input type="hidden" name="event_id" value="<?php echo htmlspecialchars($event['id']); ?>">
    
    <label>Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>

    <label>Event</label>
    <input type="text" value="<?php echo htmlspecialchars($event['name']); ?>" disabled>

    <button type="submit">Submit</button>
</form>

<p><a href="index.php">Back to events</a></p>
</div>
</body>
</html>

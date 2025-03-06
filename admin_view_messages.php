<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location:admin_login.php');
}

$admin_id = $_SESSION['admin_id'];

// Fetch all messages that haven't been replied to yet
$query = "SELECT * FROM chat_messages WHERE admin_reply IS NULL ORDER BY timestamp DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Messages</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <h1>Messages from Users</h1>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="message">
            <p><strong>User <?php echo $row['user_id']; ?>:</strong> <?php echo $row['message']; ?></p>
            <p><a href="response_query.php?message_id=<?php echo $row['id']; ?>">Respond to this message</a></p>
        </div>
    <?php } ?>

</body>
</html>

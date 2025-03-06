<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location:admin_login.php');
}

$admin_id = $_SESSION['admin_id'];
$message_id = $_GET['message_id'];  // Get the message ID from the query string

// Handle admin reply
if (isset($_POST['send_response'])) {
    $admin_reply = mysqli_real_escape_string($conn, $_POST['admin_reply']);

    if (empty($admin_reply)) {
        $error_message = "Please provide a response.";
    } else {
        // Update the message in the chat_messages table with the admin's reply
        $query = "UPDATE chat_messages SET admin_reply = '$admin_reply' WHERE id = '$message_id'";
        mysqli_query($conn, $query) or die('Response failed.');
        $success_message = "Response sent successfully!";
    }
}

// Fetch the user's message to which the admin will reply
$query = "SELECT * FROM chat_messages WHERE id = '$message_id'";
$result = mysqli_query($conn, $query);
$message_data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Respond to User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>

    <h1>Respond to User Message</h1>

    <?php if (isset($success_message)) { echo "<p>$success_message</p>"; } ?>
    <?php if (isset($error_message)) { echo "<p>$error_message</p>"; } ?>

    <div class="message">
        <p><strong>User Message:</strong> <?php echo $message_data['message']; ?></p>
    </div>

    <form method="post" action="">
        <textarea name="admin_reply" placeholder="Your response..." required></textarea><br>
        <input type="submit" name="send_response" value="Send Response">
    </form>
</body>
</html>

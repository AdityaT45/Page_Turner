<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($user_id)) {
    header('location:login.php');
}

// Send message
if (isset($_POST['send_msg'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if (empty($message)) {
        $message_error = "Please enter a message.";
    } else {
        // Insert message into the chat_messages table with 'user' sender
        $query = "INSERT INTO chat_messages (user_id, message, sender) VALUES ('$user_id', '$message', 'user')";
        if (mysqli_query($conn, $query)) {
            // After successfully sending the message, redirect to the same page to avoid resubmission
            header("Location: submit_query.php");
            exit;
        } else {
            $message_error = "Error sending message. Please try again.";
        }
    }
}

// Fetch chat history between the user and admin
$query = "SELECT * FROM chat_messages WHERE user_id = '$user_id' ORDER BY timestamp ASC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Query</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'index_header.php'; ?>

    <h1>Chat with Admin</h1>

    <?php if (isset($message_error)) { echo "<p>$message_error</p>"; } ?>

    <div class="chat-container">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="message <?php echo $row['sender'] == 'user' ? 'user-message' : 'admin-message'; ?>">
                <p><strong><?php echo ucfirst($row['sender']); ?>:</strong> <?php echo $row['message']; ?></p>
                <?php if ($row['admin_reply']) { ?>
                    <p><strong>Admin Reply:</strong> <?php echo $row['admin_reply']; ?></p>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <form method="post" action="">
        <textarea name="message" placeholder="Your message..." required></textarea><br>
        <input type="submit" name="send_msg" value="Send Message">
    </form>

</body>
</html>

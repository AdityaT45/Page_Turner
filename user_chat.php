<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if (!isset($user_id)) {
  header('location:login.php');
}

// Fetch the chat messages between user and admin
$query = mysqli_query($conn, "SELECT * FROM chat_messages WHERE user_id = '$user_id' ORDER BY timestamp ASC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>User Chat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      text-align: center;
    }

    .chat-container {
      width: 60%;
      margin: 20px auto;
      padding: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      height: 400px;
      overflow-y: scroll;
    }

    .chat-box {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .message {
      padding: 10px;
      border-radius: 10px;
      max-width: 80%;
      word-wrap: break-word;
    }

    .user-message {
      background-color: #e1ffc7;
      align-self: flex-start;
    }

    .admin-message {
      background-color: #f1f1f1;
      align-self: flex-end;
    }

    .chat-form {
      display: flex;
      gap: 10px;
      margin-top: 20px;
    }

    .chat-form input {
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ddd;
      width: 80%;
    }

    .chat-form button {
      padding: 10px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .chat-form button:hover {
      background-color: #218838;
    }

    .back-button {
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 20px;
    }

    .back-button:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>

  <?php include 'index_header.php'; ?>

  <div class="chat-container">
    <h2>Chat with Admin</h2>
    <div class="chat-box">
      <?php while ($row = mysqli_fetch_assoc($query)) { ?>
        <div class="message <?php echo ($row['sender'] == 'user') ? 'user-message' : 'admin-message'; ?>">
          <p><strong><?php echo ucfirst($row['sender']); ?>:</strong> <?php echo $row['message']; ?></p>
          <p><small><?php echo date('Y-m-d H:i:s', strtotime($row['timestamp'])); ?></small></p>
        </div>
      <?php } ?>
    </div>
    <form class="chat-form" action="submit_query.php" method="post">
      <input type="text" name="message" placeholder="Type a message..." required>
      <button type="submit" name="send_message">Send</button>
    </form>
    <form action="index.php" method="post">
      <input type="submit" class="back-button" name="back" value="Back to Home">
    </form>
  </div>

</body>

</html>

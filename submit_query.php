<?php
include 'config.php';
session_start();

if (isset($_POST['submit_query'])) {
    $user_id = $_SESSION['user_id'] ?? null;
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if ($user_id) {
        $stmt = $conn->prepare("INSERT INTO queries (user_id, subject, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $subject, $message);
        $stmt->execute();
        $success = "Query submitted successfully!";
    } else {
        $error = "Please login to submit a query.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Query</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #fdfce5
            font-family: 'Segoe UI', sans-serif;
        }
        .query-form {
            max-width: 600px;
            background: #fff;
            margin: 50px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }
        .query-form h3 {
            color: #0f3859;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .btn-theme {
            background-color: #0f3859;
            color: white;
            border: none;
        }
      
        .message-box {
            text-align: center;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
        }
        .message-success {
            background: #d1f7e2;
            color: #218838;
        }
        .message-error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body style="background-color:#fdfce5">

<?php include 'index_header.php'; ?>

<div class="query-form">
    <h3>Submit Your Query</h3>

    <?php if (isset($success)): ?>
        <div class="message-box message-success"><?= $success ?></div>
    <?php elseif (isset($error)): ?>
        <div class="message-box message-error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="subject" class="form-label">Subject:</label>
            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter subject" required>
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">Your Message:</label>
            <textarea name="message" id="message" rows="5" class="form-control" placeholder="Describe your issue..." required></textarea>
        </div>

        <button type="submit" name="submit_query" class="btn btn-theme w-100">Submit Query</button>
    </form>
</div>

</body>
</html>

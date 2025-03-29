<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed - Thank You</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #fdfce5; }
        .container { margin-top: 50px; text-align: center; }
        .thankyou-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .thankyou-box h1 { color: #0f3859; }
        .thankyou-box p { font-size: 18px; margin-top: 10px; }
        .btn-home {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-home:hover { background: #0056b3; }
    </style>
</head>
<body>

<div class="container">
    <div class="thankyou-box">
        <h1>🎉 Thank You for Your Order! 🎉</h1>
        <p>Your order has been placed successfully. We will process it soon.</p>
        <a href="index.php" class="btn btn-home mt-3">Back to Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

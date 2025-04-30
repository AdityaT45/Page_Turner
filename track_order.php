<?php
session_start();
include('config.php'); // Assuming you have a database connection file

// Check if the user is logged in, otherwise redirect
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Get the logged-in user's ID

// Fetch order details from the database based on user_id
$query = "SELECT * FROM confirm_order WHERE user_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id); // Bind user_id as an integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
} else {
    echo "No orders found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fdfce5;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            margin-top: 20px;
            color: #0f3859;
        }
        .order-summary {
            background: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .order-summary h3 {
            color: #333;
        }
        .order-summary p {
            font-size: 16px;
            color: #555;
        }

        /* Order Tracker */
        .tracker {
            display: flex;
            justify-content: space-between;
            margin: 30px auto;
            width: 70%;
            padding: 10px;
        }
        .tracker-step {
            position: relative;
            flex: 1;
            text-align: center;
            color: #fff;
            font-weight: bold;
        }
        .tracker-step .circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: gray;
            margin: 0 auto;
            line-height: 40px;
            font-size: 18px;
        }
        .tracker-step.completed .circle {
            background-color: #4caf50;
        }
        .tracker-step.in-progress .circle {
            background-color: #ffa500;
        }
        .tracker-step .label {
            margin-top: 10px;
            font-size: 14px;
        }

        /* Buttons */
        .track-btn {
            background-color: #0f3859;
            padding: 12px 20px;
            border-radius: 5px;
            color: white;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        .track-btn:hover {
            background-color: #333;
        }

    </style>
</head>
<body>

<h1>Track Your Order</h1>

<!-- Order Summary Section -->
<div class="order-summary">
    <h3>Order Details</h3>
    <p><strong>Order Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
    <p><strong>Order ID:</strong> <?= htmlspecialchars($order['id']) ?></p>
    <p><strong>Books Ordered:</strong> <?= htmlspecialchars($order['total_books']) ?> Books</p>
    <p><strong>Total Price:</strong> ₹<?= htmlspecialchars($order['total_price']) ?></p>
    <p><strong>Payment Status:</strong> <?= htmlspecialchars($order['payment_status']) ?></p>
</div>

<!-- Order Progress Tracker -->
<div class="tracker">
    <!-- Pending Status -->
    <div class="tracker-step <?= ($order['order_status'] == 'Pending') ? 'in-progress' : ($order['order_status'] == 'Shipped' ? 'completed' : '') ?>">
        <div class="circle"><?= ($order['order_status'] == 'Pending') ? '1' : '✔' ?></div>
        <div class="label">Pending</div>
    </div>

    <!-- Shipped Status -->
    <div class="tracker-step <?= ($order['order_status'] == 'Shipped') ? 'in-progress' : ($order['order_status'] == 'Delivered' ? 'completed' : '') ?>">
        <div class="circle"><?= ($order['order_status'] == 'Shipped') ? '2' : '✔' ?></div>
        <div class="label">Shipped</div>
    </div>

    <!-- Delivered Status -->
    <div class="tracker-step <?= ($order['order_status'] == 'Delivered') ? 'completed' : '' ?>">
        <div class="circle"><?= ($order['order_status'] == 'Delivered') ? '3' : '✔' ?></div>
        <div class="label">Delivered</div>
    </div>
</div>



</body>
</html>

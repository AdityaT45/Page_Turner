<?php
include 'config.php';
session_start();

// Check if the delivery staff is logged in
if (!isset($_SESSION['delivery_staff_id'])) {
    header('location: ds_login.php');
    exit();
}

// Get the order ID from URL
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die("Invalid order ID.");
}

$order_id = mysqli_real_escape_string($conn, $_GET['order_id']);

// Fetch order details
$query = "SELECT * FROM confirm_order WHERE id = '$order_id'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if (mysqli_num_rows($result) == 0) {
    die("Order not found.");
}

$order = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="./css/admin.css">
    <style>
        body {
            background-color: lightgrey;
        }
        .container {
            width: 60%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .btn-back {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background-color: grey;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-back:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body style="background-color:#fdfce5">

<?php include 'ds_header.php'; ?>

<div class="container">
    <h2>Order Details</h2>
    
    <table>
        <tr>
            <th>Order ID</th>
            <td><?php echo $order['id']; ?></td>
        </tr>
        <tr>
            <th>Customer Name</th>
            <td><?php echo $order['name']; ?></td>
        </tr>
        <tr>
            <th>Contact Number</th>
            <td><?php echo $order['number']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $order['email']; ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo $order['address']; ?></td>
        </tr>
        <tr>
            <th>Taluka</th>
            <td><?php echo $order['taluka']; ?></td>
        </tr>
        <tr>
            <th>District</th>
            <td><?php echo $order['district']; ?></td>
        </tr>
        <tr>
            <th>Total Books</th>
            <td><?php echo $order['total_books']; ?></td>
        </tr>
        <tr>
            <th>Total Price</th>
            <td>₹<?php echo $order['total_price']; ?></td>
        </tr>
        <tr>
            <th>Order Date</th>
            <td><?php echo $order['order_date']; ?></td>
        </tr>
        <tr>
            <th>Payment ID</th>
            <td><?php echo $order['payment_id']; ?></td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td style="color: <?php echo ($order['payment_status'] == 'paid') ? 'green' : 'red'; ?>;">
                <?php echo ucfirst($order['payment_status']); ?>
            </td>
        </tr>
        <tr>
            <th>Order Status</th>
            <td style="color: <?php echo ($order['order_status'] == 'delivered') ? 'green' : 'red'; ?>;">
                <?php echo ucfirst($order['order_status']); ?>
            </td>
        </tr>
    </table>

    <a href="ds_assigned_orders.php" class="btn-back">Back to Orders</a>
</div>

</body>
</html>

<?php
session_start();
include 'config.php'; // Database connection file

// Check if payment details are received
if (!isset($_POST['razorpay_payment_id']) || !isset($_SESSION['order_id'])) {
    die('Invalid access!');
}

$payment_id = $_POST['razorpay_payment_id'];
$order_id = $_SESSION['order_id'];
$payment_status = "Success";

// Update payment status in database
$sql = "UPDATE orders SET payment_id = ?, payment_status = ? WHERE order_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $payment_id, $payment_status, $order_id);
if ($stmt->execute()) {
    unset($_SESSION['order_id']); // Clear session order ID
} else {
    die("Database update failed: " . $stmt->error);
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        .container { max-width: 500px; margin: auto; background: #f8f8f8; padding: 20px; border-radius: 10px; }
        h2 { color: green; }
        .btn { display: inline-block; padding: 10px 20px; margin-top: 20px; text-decoration: none; background: green; color: white; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Payment Successful!</h2>
        <p>Thank you for your purchase.</p>
        <p><strong>Payment ID:</strong> <?php echo htmlspecialchars($payment_id); ?></p>
        <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order_id); ?></p>
        <a href="index.php" class="btn">Go to Home</a>
    </div>
</body>
</html>

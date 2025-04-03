<?php
include 'config.php';
session_start();

// Check if the delivery staff is logged in
if (!isset($_SESSION['delivery_staff_id'])) {
    header('location: ds_login.php');
    exit();
}

// Check if order_id is passed in the URL
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die("Invalid order ID.");
}

$order_id = mysqli_real_escape_string($conn, $_GET['order_id']);

// Update the order status to "delivered"
$update_query = "UPDATE confirm_order SET order_status = 'delivered' WHERE id = '$order_id'";
if (mysqli_query($conn, $update_query)) {
    echo "<script>alert('Order marked as delivered successfully!'); window.location.href = 'ds_assigned_orders.php';</script>";
} else {
    echo "<script>alert('Failed to update order status. Please try again!'); window.location.href = 'ds_assigned_orders.php';</script>";
}
?>

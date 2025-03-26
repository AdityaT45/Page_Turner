<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit;
}

echo "<h1>Payment Successful!</h1>";
echo "<p>Your order has been placed successfully.</p>";
echo "<a href='index.php'>Go to Home</a>";
?>

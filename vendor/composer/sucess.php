<?php
require('config.php'); // Database connection

if (isset($_GET['payment_id'])) {
    $payment_id = $_GET['payment_id'];
    $user_id = $_SESSION['user_id']; 

    // Store payment details in the database
    $query = "INSERT INTO payments (user_id, payment_id, amount, status) VALUES ('$user_id', '$payment_id', '1000', 'success')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "Payment Successful! Your Payment ID is: " . $payment_id;
} else {
    echo "Payment failed!";
}
?>

<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

$user_id = $_SESSION['user_id'];

// Ensure Razorpay payment ID is received
if (!isset($_POST['razorpay_payment_id'])) {
    die("Payment ID missing");
}

$payment_id = $_POST['razorpay_payment_id'];
$payment_status = "success"; // Assuming success

// Fetch User Details
$query = "SELECT * FROM users_info WHERE Id = '$user_id'";
$result = $conn->query($query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("User details not found");
}

$user = mysqli_fetch_assoc($result);

// Verify column names exist in database
$full_name = $user['name'] . ' ' . $user['surname'];
$email = $user['email'];
$number = $user['mobile'] ?? ''; // Prevents "Undefined array key" error
$address = $user['address'] ?? '';
$district = $user['district'] ?? '';
$taluka = $user['taluka'] ?? '';

$grand_total = 0;
$cart_items = [];
$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");

if (mysqli_num_rows($cart_query) > 0) {
    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
        $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
        $grand_total += $total_price;
        $cart_items[] = $fetch_cart['name'] . " x " . $fetch_cart['quantity'];
    }
}

$total_books = implode(", ", $cart_items);
$order_date = date('Y-m-d');

// Insert Order into Database
$insert_order = "INSERT INTO confirm_order (user_id, name, number, email, address, district, taluka, total_books, total_price, order_date, payment_id, payment_status) 
VALUES ('$user_id', '$full_name', '$number', '$email', '$address', '$district', '$taluka', '$total_books', '$grand_total', '$order_date', '$payment_id', '$payment_status')";

if ($conn->query($insert_order)) {
    // Clear cart after successful order
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'");

    echo "success"; // Sent to frontend
} else {
    echo "Error saving order: " . $conn->error;
}
?>

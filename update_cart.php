<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart_id = $_POST['cart_id'];
    $update_quantity = $_POST['update_quantity'];
    $book_price = $_POST['book_price'];
    $total_price = $book_price * $update_quantity;

    $update_query = "UPDATE `cart` SET `quantity`='$update_quantity', `total`='$total_price' WHERE `id`='$cart_id'";
    mysqli_query($conn, $update_query) or die('Query Failed');

    echo "Success";
}
?>

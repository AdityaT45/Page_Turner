<?php
session_start();
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $staff_id = $_POST['staff_id'];

    // Validate inputs
    if (empty($order_id) || empty($staff_id)) {
        die("Invalid data provided.");
    }

    // Update order table with assigned delivery staff
    $update_query = "UPDATE confirm_order SET delivery_staff_id = '$staff_id', order_status = 'Assigned' WHERE id = '$order_id'";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>
                alert('Delivery staff assigned successfully.');
                window.location.href = 'admin_orders.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to assign delivery staff.');
                window.history.back();
              </script>";
    }
} else {
    header("Location: admin_orders.php");
    exit();
}
?>

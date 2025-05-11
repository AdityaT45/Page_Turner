<?php 
include 'config.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['delivery_staff_id'])) {
    header('location: ds_login.php');
    exit(); // Prevent further execution
}

$ds_id = mysqli_real_escape_string($conn, $_SESSION['delivery_staff_id']); // Secure ID

// Fetch Assigned Orders
$assigned_orders_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM confirm_order WHERE delivery_staff_id = '$ds_id'") or die(mysqli_error($conn));
$assigned_orders = mysqli_fetch_assoc($assigned_orders_query)['total'];


// Fetch Delivered Orders
$delivered_orders_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM confirm_order WHERE delivery_staff_id = '$ds_id' AND order_status = 'delivered'") or die(mysqli_error($conn));
$delivered_orders = mysqli_fetch_assoc($delivered_orders_query)['total'];

// Fetch Earnings
$earnings_query = mysqli_query($conn, "SELECT SUM(total_price) AS total FROM confirm_order WHERE delivery_staff_id = '$ds_id' AND order_status = 'delivered'") or die(mysqli_error($conn));
$earnings = mysqli_fetch_assoc($earnings_query)['total'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Staff Dashboard</title>

</head>
<body style="background-color:#fdfce5">
    <?php include 'ds_header.php'; ?>
    <br>

    <div class="main_box">
        <!-- Assigned Orders -->
        <div class="card text-center" style="width: 15rem;">
          
            <div class="card-body ">
                <h5 class="card-title">Assigned Orders</h5>
                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #007bff;">
                    <?php echo $assigned_orders; ?>
                </p>
                <a href="ds_assigned_orders.php" class="btn btn-primary">View Orders</a>
            </div>
        </div>


        <!-- Delivered Orders -->
        <div class="card" style="width: 15rem;">
         
            <div class="card-body">
                <h5 class="card-title">Delivered Orders</h5>
                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #28a745;">
                    <?php echo $delivered_orders; ?>
                </p>
                <a href="ds_delivered_orders.php" class="btn btn-primary">View Delivered</a>
            </div>
        </div>

        <!-- Earnings -->
        <div class="card " style="width: 15rem;">
           
            <div class="card-body">
                <h5 class="card-title">Total Earnings (₹)</h5>
                <p class="card-text" style="font-size: 20px; font-weight: bold; color: #007bff;">
                    ₹<?php echo $earnings; ?>
                </p>
                <a href="ds_earnings.php" class="btn btn-primary">View Earnings</a>
            </div>
        </div>

        <!-- Profile -->
        <div class="card" style="width: 15rem;">
           
            <div class="card-body">
                <h5 class="card-title">Manage Profile</h5>
                <p class="card-text">Update your personal details.</p>
                <a href="ds_profile.php" class="btn btn-primary">Edit Profile</a>
            </div>
        </div>
    </div>

    <br><br>
</body>
</html>

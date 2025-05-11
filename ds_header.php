<?php
include 'config.php';

// Ensure delivery staff is logged in
if (!isset($_SESSION['delivery_staff_id'])) {
    header('location: ds_login.php');
    exit();
}

// Fetch delivery staff details
$ds_id = mysqli_real_escape_string($conn, $_SESSION['delivery_staff_id']);
$query = mysqli_query($conn, "SELECT name FROM delivery_staff WHERE id = '$ds_id'") or die(mysqli_error($conn));
$ds_data = mysqli_fetch_assoc($query);
$ds_name = $ds_data['name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Staff Header</title>
    <link rel="stylesheet" href="./css/admin.css">
    <style>
        .header {
            background-color: #092a42;
            color: white;
            padding: 15px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .logo {
            font-size: 22px;
            font-weight: bold;
        }
        .header .menu a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }
        .header .menu a:hover {
            text-decoration: underline;
        }
        .logout-btn {
            background-color: red;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo">🚚 Delivery Staff Panel</div>
    
    <div class="menu">
        <a href="ds_dashboard.php">Dashboard</a>
        <a href="ds_assigned_orders.php">Assigned Orders</a>
  
        <a href="ds_delivered_orders.php">Delivered Orders</a>
        <a href="ds_profile.php">Profile</a>
    </div>
    
    <div>
        <span>Welcome, <strong><?php echo $ds_name; ?></strong></span>
        <a href="ds_logout.php"><button class="logout-btn">Logout</button></a>
    </div>
</div>

</body>
</html>

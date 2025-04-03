<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: admin_login.php');
    exit();
}

// Fetch Order ID from URL
if (!isset($_GET['order_id'])) {
    die('Order ID is missing.');
}

$order_id = intval($_GET['order_id']);

// Fetch Order Details
$order_query = "
    SELECT co.*, ui.name, ui.surname, ui.email, ui.address, ui.district, ui.taluka, ui.state, ui.pincode 
    FROM confirm_order co
    JOIN users_info ui ON co.user_id = ui.id
    WHERE co.id = $order_id
";
$order_result = mysqli_query($conn, $order_query);
if (mysqli_num_rows($order_result) == 0) {
    die('Order not found.');
}

$order = mysqli_fetch_assoc($order_result);

// Handle Order Status Update
if (isset($_POST['update_status'])) {
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);
    $update_query = "UPDATE confirm_order SET order_status = '$new_status' WHERE id = $order_id";
    mysqli_query($conn, $update_query) or die(mysqli_error($conn));
    header("Location: admin_order_details.php?order_id=$order_id&updated=1");
    exit();
}

// Handle Order Deletion
if (isset($_POST['delete_order'])) {
    $delete_query = "DELETE FROM confirm_order WHERE id = $order_id";
    mysqli_query($conn, $delete_query) or die(mysqli_error($conn));
    header("Location: admin_orders.php?deleted=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .container { width: 90%; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; }
        .btn { padding: 7px 15px; border: none; cursor: pointer; }
        .btn-update { background: green; color: white; }
        .btn-delete { background: red; color: white; }
        .btn:hover { opacity: 0.8; }
        .form-group { margin: 10px 0; }
    </style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="container">
    <h2>Order Details</h2>

    <!-- Display Order Information -->
    <h3>Order Information</h3>
    <table>
        <tr><th>Order ID</th><td><?php echo $order['id']; ?></td></tr>
        <tr><th>Order Date</th><td><?php echo $order['order_date']; ?></td></tr>
        <tr><th>Total Price</th><td>₹<?php echo number_format($order['total_price'], 2); ?></td></tr>
        <tr><th>Payment Status</th><td><?php echo ucfirst($order['payment_status']); ?></td></tr>
        <tr><th>Order Status</th><td><?php echo ucfirst($order['order_status']); ?></td></tr>
    </table>

    <!-- Display User Information -->
    <h3>User Information</h3>
    <table>
        <tr><th>Name</th><td><?php echo $order['name'] . ' ' . $order['surname']; ?></td></tr>
        <tr><th>Email</th><td><?php echo $order['email']; ?></td></tr>
        <tr><th>Address</th><td><?php echo $order['address']; ?></td></tr>
        <tr><th>District</th><td><?php echo $order['district']; ?></td></tr>
        <tr><th>Taluka</th><td><?php echo $order['taluka']; ?></td></tr>
        <tr><th>State</th><td><?php echo $order['state']; ?></td></tr>
        <tr><th>Pincode</th><td><?php echo $order['pincode']; ?></td></tr>
    </table>

    <!-- Update Order Status -->
    <h3>Update Order Status</h3>
    <form method="POST">
        <div class="form-group">
            <select name="status">
                <option value="pending" <?php echo ($order['order_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="assigned" <?php echo ($order['order_status'] == 'assigned') ? 'selected' : ''; ?>>Assigned</option>
                <option value="delivered" <?php echo ($order['order_status'] == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
            </select>
            <button type="submit" name="update_status" class="btn btn-update">Update Status</button>
        </div>
    </form>

    <!-- Delete Order -->
    <h3>Delete Order</h3>
    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
        <button type="submit" name="delete_order" class="btn btn-delete">Delete Order</button>
    </form>
</div>

</body>
</html>

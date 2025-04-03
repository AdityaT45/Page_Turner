<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: admin_login.php');
    exit();
}

// Assign Delivery Staff
if (isset($_POST['assign_delivery'])) {
    $order_id = $_POST['order_id'];
    $delivery_staff_id = $_POST['delivery_staff'];

    mysqli_query($conn, "UPDATE confirm_order SET delivery_staff_id = '$delivery_staff_id', order_status = 'assigned' WHERE id = '$order_id'")
        or die(mysqli_error($conn));

    header('location: manage_orders.php');
    exit();
}

// Delete Order
if (isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'];
    mysqli_query($conn, "DELETE FROM confirm_order WHERE id = '$order_id'")
        or die(mysqli_error($conn));

    header('location: manage_orders.php');
    exit();
}

// Fetch Orders with Search & Filters
$search_query = "";
$filter_query = "";

if (!empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $search_query = "WHERE confirm_order.id LIKE '%$search%' OR confirm_order.name LIKE '%$search%' OR confirm_order.payment_id LIKE '%$search%'";
}

if (!empty($_GET['filter_status']) && $_GET['filter_status'] !== 'all') {
    $filter_status = mysqli_real_escape_string($conn, $_GET['filter_status']);
    $filter_query = $search_query ? "AND confirm_order.order_status = '$filter_status'" : "WHERE confirm_order.order_status = '$filter_status'";
}

// Fetch Orders with Delivery Staff Info
$order_query = "
    SELECT confirm_order.*, delivery_staff.name AS delivery_staff_name, confirm_order.taluka, confirm_order.district
    FROM confirm_order 
    LEFT JOIN delivery_staff ON confirm_order.delivery_staff_id = delivery_staff.id
    $search_query $filter_query 
    ORDER BY confirm_order.order_date DESC
";

$orders = mysqli_query($conn, $order_query) or die(mysqli_error($conn));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 95%; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #007bff; color: white; }
        select, input { padding: 5px; }
        .btn { padding: 5px 10px; border: none; cursor: pointer; }
        .btn-assign { background: blue; color: white; }
        .btn-delete { background: red; color: white; }
        .btn-invoice { background: orange; color: white; }
        .btn:hover { opacity: 0.8; }
        .search-box { margin-bottom: 20px; display: flex; gap: 10px; }
    </style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="container">
    <h2>Manage Orders</h2>

    <!-- Search & Filter -->
    <div class="search-box">
        <form method="GET">
            <input type="text" name="search" placeholder="Search by Order ID, Customer Name, or Payment ID">
            <select name="filter_status">
                <option value="all">All Orders</option>
                <option value="pending">Pending</option>
                <option value="assigned">Assigned</option>
                <option value="delivered">Delivered</option>
            </select>
            <button type="submit" class="btn">Search</button>
        </form>
    </div>

    <!-- Orders Table -->
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Address</th>
            <th>Taluka</th>
            <th>District</th>
            <th>Total Books</th>
            <th>Total Price</th>
            <th>Payment ID</th>
            <th>Status</th>
            <th>Delivery Staff</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($orders)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td><?php echo $row['taluka']; ?></td>
                <td><?php echo $row['district']; ?></td>
                <td><?php echo $row['total_books']; ?></td>
                <td>₹<?php echo $row['total_price']; ?></td>
                <td><?php echo $row['payment_id']; ?></td>
                <td style="color: 
                    <?php 
                        if ($row['order_status'] == 'delivered') { 
                            echo 'green'; 
                        } elseif ($row['order_status'] == 'assigned') { 
                            echo '#FFD700';  // Yellow
                        } else { 
                            echo 'red'; 
                        } 
                    ?>;">
                    <?php echo ucfirst($row['order_status']); ?>
                </td>
                <td><?php echo !empty($row['delivery_staff_name']) ? $row['delivery_staff_name'] : 'Not Assigned'; ?></td>
                <td>
                    <!-- Assign Delivery -->
                    <a href="assign_delivery.php?order_id=<?= $row['id']; ?>" class="btn btn-assign">Assign Delivery</a>

                    <!-- Print Invoice (Only for Assigned Orders) -->
                    <?php if ($row['order_status'] == 'assigned') { ?>
                        <a href="print_invoice.php?order_id=<?php echo $row['id']; ?>" class="btn btn-invoice">Print Invoice</a>
                    <?php } ?>

                    <!-- Delete Order -->
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_order" class="btn btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>

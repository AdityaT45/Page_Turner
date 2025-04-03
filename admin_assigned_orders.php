<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: admin_login.php');
    exit();
}

// Fetch only Assigned Orders
$order_query = "
    SELECT confirm_order.*, delivery_staff.name AS delivery_staff_name, confirm_order.taluka, confirm_order.district
    FROM confirm_order 
    LEFT JOIN delivery_staff ON confirm_order.delivery_staff_id = delivery_staff.id
    WHERE confirm_order.order_status = 'assigned'
    ORDER BY confirm_order.order_date DESC
";

$orders = mysqli_query($conn, $order_query) or die(mysqli_error($conn));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Orders</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 95%; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #007bff; color: white; }
        .btn { padding: 5px 10px; border: none; cursor: pointer; }
        .btn-invoice { background: orange; color: white; }
        .btn-delete { background: red; color: white; }
        .btn:hover { opacity: 0.8; }
    </style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="container">
    <h2>Assigned Orders</h2>

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
                <td style="color: #FFD700;"><?php echo ucfirst($row['order_status']); ?></td>
                <td><?php echo !empty($row['delivery_staff_name']) ? $row['delivery_staff_name'] : 'Not Assigned'; ?></td>
                <td>
                    <!-- Print Invoice -->
                    <a href="print_invoice.php?order_id=<?php echo $row['id']; ?>" class="btn btn-invoice">Print Invoice</a>

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

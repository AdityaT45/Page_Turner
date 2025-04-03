<?php
session_start();
include 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all orders along with assigned delivery staff name
$query = "
    SELECT o.*, d.name AS delivery_staff_name, o.order_status
    FROM confirm_order o
    LEFT JOIN delivery_staff d ON o.delivery_staff_id = d.id
    ORDER BY o.order_date DESC
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="container-fluid">
    <h2 class="text-center">Manage Orders</h2>
    <div class="table-responsive">
        <table class="table table-bordered text-center mt-4">
            <thead>
                <tr>
                    <th>O ID</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Total Books</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th>Payment ID</th>
                    <th>Payment Status</th>
                    <!-- <th>Order Status</th> -->
                    <th>Delivery Staff</th>
                    <th>Assign Delivery</th>
                    <th>Print Invoice</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['user_id']; ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= $row['number']; ?></td>
                        <td><?= htmlspecialchars($row['email']); ?></td>
                        <td><?= htmlspecialchars($row['address']); ?></td>
                        <td><?= $row['total_books']; ?></td>
                        <td>₹<?= $row['total_price']; ?></td>
                        <td><?= $row['order_date']; ?></td>
                        <td><?= $row['payment_id']; ?></td>
                        <td><?= $row['payment_status']; ?></td>
                        
                        <!-- ✅ Order Status -->
                        <!-- <td>
                            <form action="update_order_status.php" method="POST">
                                <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                                <select name="order_status" class="form-select">
                                    <option value="Pending" <?= ($row['order_status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Processing" <?= ($row['order_status'] == 'Processing') ? 'selected' : ''; ?>>Processing</option>
                                    <option value="Shipped" <?= ($row['order_status'] == 'Shipped') ? 'selected' : ''; ?>>Shipped</option>
                                    <option value="Delivered" <?= ($row['order_status'] == 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
                                    <option value="Cancelled" <?= ($row['order_status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-update mt-2">Update</button>
                            </form>
                        </td> -->

                        <!-- ✅ Delivery Staff Name -->
                        <td>
                            <?= ($row['delivery_staff_name']) ? $row['delivery_staff_name'] : "<span style='color: red;'>Not Assigned</span>"; ?>
                        </td>

                        <!-- ✅ Assign Delivery Staff Button -->
                        <td>
                            <a href="assign_delivery.php?order_id=<?= $row['id']; ?>" class="btn btn-sm btn-success ">
                                Assign Delivery
                            </a>
                        </td>

                        <td>
                            <a href="print_invoice.php?order_id=<?= $row['id']; ?>" target="_blank" class="btn btn-sm btn-primary">
                                Print Invoice
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

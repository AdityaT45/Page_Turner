<?php
session_start();
include 'config.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch all orders from confirm_order table
$query = "SELECT * FROM confirm_order ORDER BY order_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Orders</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            text-align: center;
        }
        h2 {
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #0f3859;
            color: white;
        }
        td {
            text-align: center;
        }
        .edit, .delete, .add {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }
        .edit { background: #007bff; color: white; }
        .edit:hover { background: #0056b3; }
        .delete { background: #dc3545; color: white; }
        .delete:hover { background: #a71d2a; }
        .add { background: #28a745; color: white; }
        .add:hover { background: #1e7e34; }
        form {
            background: white;
            padding: 15px;
            width: 50%;
            margin: 20px auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: none;
        }
        input {
            width: 90%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .save {
            background: #0f3859;
            color: white;
            cursor: pointer;
            border: none;
            width: 100%;
        }
        .save:hover {
            background: #092a42;
        }
        body { background-color: #fdfce5; }
        .container { margin-top: 30px; }
        .table-responsive { max-width: 100%; overflow-x: auto; }
        table { background: white; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); }
        th { background: #0f3859; color: white; }
        .btn-update { background: #007bff; color: white; }
        .btn-update:hover { background: #0056b3; }
        td { vertical-align: middle; }
        .table-responsive {
    overflow-x: auto;
    max-width: 100%;
}

table {
    width: 100%;
    /* table-layout: fixed; Ensures equal column spacing */
    word-wrap: break-word; /* Prevents text overflow */
}
    </style>
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
                    <th>Update Status</th>
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
                        <td>
                            <form action="update_payment_status.php" method="POST">
                                <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                                <select name="payment_status" class="form-select">
                                    <option value="Pending" <?= ($row['payment_status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Completed" <?= ($row['payment_status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                    <option value="Failed" <?= ($row['payment_status'] == 'Failed') ? 'selected' : ''; ?>>Failed</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-update mt-2">Update</button>
                            </form>
                        </td>

                        <!-- ✅ Assign Delivery Staff Button -->
                        <td>
    <a href="assign_delivery.php?order_id=<?= $row['id']; ?>" class="btn btn-sm btn-success">
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

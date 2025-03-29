<?php
session_start();
include 'config.php'; // Database connection

// Check if admin is logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}

// Get order details
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details
    $order_query = mysqli_query($conn, "SELECT * FROM confirm_order WHERE id = $order_id");
    $order = mysqli_fetch_assoc($order_query);

    if (!$order) {
        die("Order not found.");
    }

    $order_address = $order['address']; // Example: "Pune, Maharashtra"
    $order_dist = "";
    $order_tal = "";

    // Extract District and Taluka from the address
    $address_parts = explode(",", $order_address);
    if (count($address_parts) >= 2) {
        $order_dist = trim($address_parts[0]); // First part = District
        $order_tal = trim($address_parts[1]); // Second part = Taluka
    }

    // Fetch Delivery Staff matching the District & Taluka
    $staff_query = mysqli_query($conn, "SELECT * FROM delivery_staff WHERE district = '$order_dist' AND taluka = '$order_tal' AND status = 'Active'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Delivery Staff</title>
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
        .container {
            background: white;
            padding: 20px;
            width: 50%;
            margin: 30px auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .btn-assign {
            background: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-assign:hover {
            background: #1e7e34;
        }
        .form-select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Assign Delivery Staff for Order ID: <?= $order_id; ?></h2>

    <p><strong>Order Address:</strong> <?= $order_address; ?></p>
    <p><strong>District:</strong> <?= $order_dist; ?></p>
    <p><strong>Taluka:</strong> <?= $order_tal; ?></p>

    <?php if (mysqli_num_rows($staff_query) > 0) { ?>
        <form action="assign_delivery_process.php" method="POST">
            <input type="hidden" name="order_id" value="<?= $order_id; ?>">

            <label for="staff">Select Delivery Staff:</label>
            <select name="staff_id" class="form-select" required>
                <option value="">-- Select Staff --</option>
                <?php while ($staff = mysqli_fetch_assoc($staff_query)) { ?>
                    <option value="<?= $staff['id']; ?>">
                        <?= $staff['name']; ?> (<?= $staff['phone']; ?>)
                    </option>
                <?php } ?>
            </select>

            <button type="submit" class="btn btn-assign mt-3">Assign Staff</button>
        </form>
    <?php } else { ?>
        <p style="color: red;">No delivery staff available in this district and taluka.</p>
    <?php } ?>
</div>

</body>
</html>

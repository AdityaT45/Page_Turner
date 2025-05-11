<?php
include 'config.php';
session_start();

// Check if delivery staff is logged in
if (!isset($_SESSION['delivery_staff_id'])) {
    header('location: ds_login.php');
    exit();
}

$ds_id = mysqli_real_escape_string($conn, $_SESSION['delivery_staff_id']);

// Define earnings per order (Change this as needed)
$fixed_earning_per_order = 50; // Example: ₹50 per delivered order

// Fetch delivered orders assigned to this delivery staff
$query = "SELECT * FROM confirm_order WHERE delivery_staff_id = '$ds_id' AND order_status = 'delivered'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Calculate total earnings
$total_orders = mysqli_num_rows($result);
$total_earnings = $total_orders * $fixed_earning_per_order;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Earnings</title>
    <link rel="stylesheet" href="./css/admin.css">
    <style>
        body {
            background-color: lightgrey;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .total-box {
            font-size: 18px;
            font-weight: bold;
            padding: 10px;
            text-align: right;
        }
    </style>
</head>
<body style="background-color:#fdfce5">

<?php include 'ds_header.php'; ?>

<div class="container">
    <h2>My Earnings</h2>
    
    <p class="total-box">Total Earnings: ₹<?php echo number_format($total_earnings, 2); ?></p>
    
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>District</th>
            <th>Taluka</th>
            <th>Total Price</th>
            <th>Earnings</th>
        </tr>

        <?php
        if ($total_orders > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['district'] . "</td>";
                echo "<td>" . $row['taluka'] . "</td>";
                echo "<td>₹" . $row['total_price'] . "</td>";
                echo "<td>₹" . $fixed_earning_per_order . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No earnings yet</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

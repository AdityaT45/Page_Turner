<?php
include 'config.php';
session_start();

// Check if the delivery staff is logged in
if (!isset($_SESSION['delivery_staff_id'])) {
    header('location: ds_login.php');
    exit();
}

// Get the delivery staff ID from the session
$ds_id = mysqli_real_escape_string($conn, $_SESSION['delivery_staff_id']);

// Fetch assigned orders for this delivery staff
$query = "SELECT * FROM confirm_order WHERE delivery_staff_id = '$ds_id'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Orders</title>
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
        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-deliver {
            background-color: green;
            color: white;
        }
        .btn-view {
            background-color: blue;
            color: white;
        }
        .btn:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>

<?php include 'ds_header.php'; ?>

<div class="container">
    <h2>Assigned Orders</h2>
    
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Taluka</th>  <!-- ✅ Added Taluka -->
            <th>District</th> <!-- ✅ Added District -->
            <th>Total Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>"; 
                echo "<td>" . $row['address'] . "</td>"; 
                echo "<td>" . $row['taluka'] . "</td>";  // ✅ Display Taluka
                echo "<td>" . $row['district'] . "</td>"; // ✅ Display District
                echo "<td>₹" . $row['total_price'] . "</td>";
                echo "<td style='color: " . ($row['order_status'] == 'delivered' ? 'green' : 'red') . ";'>" . ucfirst($row['order_status']) . "</td>";
                echo "<td>
                        <a href='ds_order_details.php?order_id=" . $row['id'] . "' class='btn btn-view'>View</a> 
                        <a href='ds_mark_delivered.php?order_id=" . $row['id'] . "' class='btn btn-deliver'>Mark as Delivered</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No assigned orders</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

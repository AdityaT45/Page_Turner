<?php
include 'config.php';
session_start();

// Check if the staff member is logged in
if (!isset($_SESSION['staff_id'])) {
    header('location: ms_login.php');
    exit();
}

// Fetch data
$total_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM book_info"))['count'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM users_info"))['count'];
$total_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM confirm_order"))['count'];
$pending_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM confirm_order WHERE order_status = 'pending'"))['count'];
$assigned_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM confirm_order WHERE order_status = 'assigned'"))['count'];
$delivered_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM confirm_order WHERE order_status = 'delivered'"))['count'];
$total_earnings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_price) AS earnings FROM confirm_order WHERE order_status = 'delivered'"))['earnings'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 20px auto;
            background: white;
            padding: 20px;
        }
        .dashboard-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .card {
            width: 23%;
            background: rgba(224, 240, 255, 0.76);
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
                height: auto;
        }
        .card h3 {
            font-size: 18px;
        }
        .card p {
            font-size: 22px;
            color: #007bff;
            font-weight: bold;
        }
        .manage-btn {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .manage-btn:hover {
            background-color: #0056b3;
        }
        canvas {
            margin-top: 30px;
        }
    </style>
</head>
<body style="background-color:#fdfce5">

<?php include 'ms_header.php'; ?>

<div class="container">
    <h2>Staff Dashboard</h2>

    <div class="dashboard-cards">
        <div class="card">
            <h3>Manage Books</h3>
            <p><?php echo $total_books; ?></p>
            <button class="manage-btn" onclick="location.href='ms_add_books.php'">Add Book</button>
            <button class="manage-btn" onclick="location.href='ms_manage_books.php'">Manage Books</button>
        </div>

        <div class="card">
            <h3>Manage Users</h3>
            <p><?php echo $total_users; ?></p>
            <button class="manage-btn" onclick="location.href='ms_manage_users.php'">Manage Users</button>
        </div>

        <div class="card" style="background:rgba(255, 218, 240, 0.76);">
            <h3>Total Orders</h3>
            <p><?php echo $total_orders; ?></p>
            <button class="manage-btn" onclick="location.href='ms_manage_orders.php'">Manage</button>
        </div>

        <div class="card" style="background:rgba(255, 255, 188, 0.76);">
            <h3>Pending Orders</h3>
            <p><?php echo $pending_orders; ?></p>
            <button class="manage-btn" onclick="location.href='ms_pending_orders.php'">Manage</button>
        </div>

        <div class="card">
            <h3>Assigned Orders</h3>
            <p><?php echo $assigned_orders; ?></p>
            <button class="manage-btn" onclick="location.href='ms_assigned_orders.php'">Manage</button>
        </div>

        <div class="card" style="background:rgba(188, 255, 198, 0.76);">
            <h3>Delivered Orders</h3>
            <p><?php echo $delivered_orders; ?></p>
            <button class="manage-btn" onclick="location.href='ms_delivered_orders.php'">Manage</button>
        </div>

        <div class="card" style="background:rgba(255, 232, 188, 0.76);">
            <h3>Total Earnings</h3>
            <p>₹<?php echo number_format($total_earnings, 2); ?></p>
            <button class="manage-btn" onclick="location.href='ms_earnings_report.php'">View Report</button>
        </div>
    </div>

    <h3>Order Overview</h3>
    <canvas id="orderChart"></canvas>
</div>

<script>
    var ctx = document.getElementById('orderChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total Orders', 'Pending', 'Assigned', 'Delivered'],
            datasets: [{
                label: 'Order Count',
                data: [<?php echo $total_orders; ?>, <?php echo $pending_orders; ?>, <?php echo $assigned_orders; ?>, <?php echo $delivered_orders; ?>],
                backgroundColor: ['blue', 'red', 'orange', 'green']
            }]
        }
    });
</script>

</body>
</html>

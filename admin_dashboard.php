<?php
include 'config.php';
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('location: admin_login.php');
    exit();
}

// Fetch order statistics
$total_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM confirm_order"))['count'];
$pending_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM confirm_order WHERE order_status = 'pending'"))['count'];
$assigned_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM confirm_order WHERE order_status = 'assigned'"))['count'];
$delivered_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM confirm_order WHERE order_status = 'delivered'"))['count'];

// Fetch total earnings
$total_earnings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_price) AS earnings FROM confirm_order WHERE order_status = 'delivered'"))['earnings'] ?? 0;

// Fetch recent orders (latest 5)
$recent_orders = mysqli_query($conn, "SELECT * FROM confirm_order ORDER BY order_date DESC LIMIT 5");

// Fetch delivery staff activity
$staff_list = mysqli_query($conn, "SELECT * FROM delivery_staff ORDER BY status DESC");

// Fetch top-selling books (by order count)
$top_books = mysqli_query($conn, "SELECT name, COUNT(*) AS order_count FROM confirm_order GROUP BY name ORDER BY order_count DESC LIMIT 5");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .card {
            width: 23%;
            padding: 20px;
            background:rgba(224, 240, 255, 0.76);
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    position: relative;
    height: inherit;
            
        }
        .card h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
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
        canvas {
            margin-top: 20px;
        }

        .dashboard-cards {
    display: flex;
    justify-content: space-between;
    flex-wrap: nowrap; /* Prevents wrapping */
    overflow-x: auto; /* Adds horizontal scrolling if needed */
    padding-bottom: 10px;
}





/* Style for Manage Button */
.manage-btn {
    margin-top: 10px;
    padding: 5px 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}

.manage-btn:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>

<?php include 'admin_header.php'; ?>


<div class="container"><h2>Admin Dashboard</h2></div>
<div class="container">
  

    <div class="dashboard-cards">
     <?php
                // Fetch total books count
                $total_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS count FROM book_info"))['count'];
                ?>

        <div class="card">
            <h3>Manage Books</h3>
            <p><?php echo $total_books; ?></p>
            <button class="manage-btn" onclick="location.href='admin_add_book.php'">Add Book</button>
            <button class="manage-btn" onclick="location.href='admin_manage_books.php'">Manage Books</button>
        </div>




        <?php

        // Fetch total number of delivery staff
        $query = mysqli_query($conn, "SELECT COUNT(*) AS total_staff FROM staff");
        $result = mysqli_fetch_assoc($query);
        $total_staff = $result['total_staff'];
        ?>
        <div class="card">
            <h3>Manage Staff Member</h3>
            <p> <?php echo $total_staff; ?></p>
            <button class="manage-btn" onclick="location.href='admin_add_staff.php'">Add Staff</button>
            <button class="manage-btn" onclick="location.href='admin_manage_staff.php'">Manage Staff</button>
        </div>




        <?php
        include 'config.php';

        // Fetch total number of delivery staff
        $query = mysqli_query($conn, "SELECT COUNT(*) AS total_staff FROM delivery_staff");
        $result = mysqli_fetch_assoc($query);
        $total_staff = $result['total_staff'];
        ?>
        <div class="card">
            <h3>Manage Delivery Staff</h3>
            <p><?php echo $total_staff; ?></p>
            <button class="manage-btn" onclick="location.href='admin_add_delivery_staff.php'">Add Delivery Staff</button>
            <button class="manage-btn" onclick="location.href='admin_manage_delivery_staff.php'">Manage Delivery Staff</button>
        </div>

        <?php

        // Fetch total number of users
        $query = mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM users_info");
        $result = mysqli_fetch_assoc($query);
        $total_users = $result['total_users'];

        ?>
        <div class="card">
            <h3>Manage Users</h3>
            <p>Total Users: <?php echo $total_users; ?></p>
            
            <button class="manage-btn" onclick="location.href='admin_manage_users.php'">Manage Users</button>
        </div>


    
</div>



    <!-- Summary Cards -->
    <div class="dashboard-cards">
    <div class="card" Style=" background:rgba(255, 218, 240, 0.76);">
        <h3>Total Orders</h3>
        <p><?php echo $total_orders; ?></p>
        <button class="manage-btn" onclick="location.href='admin_manage_orders.php'">Manage</button>
    </div>
    <div class="card" Style=" background:rgba(255, 255, 188, 0.76);">
        <h3>Pending Orders</h3>
        <p><?php echo $pending_orders; ?></p>
        <button class="manage-btn" onclick="location.href='admin_pending_orders.php'">Manage</button>
    </div>
    <div class="card">
        <h3>Assigned Orders</h3>
        <p><?php echo $assigned_orders; ?></p>
        <button class="manage-btn" onclick="location.href='admin_assigned_orders.php'">Manage</button>
    </div>
    <div class="card" Style=" background:rgba(188, 255, 198, 0.76);">
        <h3>Delivered Orders</h3>
        <p><?php echo $delivered_orders; ?></p>
        <button class="manage-btn" onclick="location.href='admin_delivered_orders.php'">Manage</button>
    </div>
    <div class="card" Style=" background:rgba(255, 232, 188, 0.76);">
        <h3>Total Earnings</h3>
        <p>₹<?php echo number_format($total_earnings, 2); ?></p>
        <button class="manage-btn" onclick="location.href='admin_earnings_report.php'">View Report</button>
    </div>
</div>




   

    <!-- Recent Orders -->
    <h3>Recent Orders</h3>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($recent_orders)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td>₹<?php echo $row['total_price']; ?></td>
                <td style="color: <?php echo ($row['order_status'] == 'delivered') ? 'green' : 'red'; ?>;">
                    <?php echo ucfirst($row['order_status']); ?>
                </td>
                <td><?php echo $row['order_date']; ?></td>
                <td>
                    <a href="admin_order_details.php?order_id=<?php echo $row['id']; ?>" class="btn btn-view">View</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <!-- Top-Selling Books -->
    <h3>Top-Selling Books</h3>
    <table>
        <tr>
            <th>Book Name</th>
            <th>Orders</th>
        </tr>
        <?php while ($book = mysqli_fetch_assoc($top_books)) { ?>
            <tr>
                <td><?php echo $book['name']; ?></td>
                <td><?php echo $book['order_count']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <!-- Delivery Staff Status -->
    <h3>Delivery Staff</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
        <?php while ($staff = mysqli_fetch_assoc($staff_list)) { ?>
            <tr>
                <td><?php echo $staff['id']; ?></td>
                <td><?php echo $staff['name']; ?></td>
                <td><?php echo $staff['email']; ?></td>
                <td style="color: <?php echo ($staff['status'] == 'active') ? 'green' : 'red'; ?>;">
                    <?php echo ucfirst($staff['status']); ?>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>
<div class="container " Style=" width:50%">
<div class="row">
    <div class="col-6">
         <!-- Chart for Orders -->
    <h3>Order Statistics</h3>
    <canvas id="orderChart"></canvas>
    </div>
    <div class="col-6"></div>
</div>
</div>

<script>
    var ctx = document.getElementById('orderChart').getContext('2d');
    var orderChart = new Chart(ctx, {
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
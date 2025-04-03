<?php
session_start();
include 'config.php'; // Database connection

// Pagination setup
$limit = 10; // Number of orders per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page, default to 1
$offset = ($page - 1) * $limit; // Calculate offset for SQL query

// Fetch orders for earnings and details
$sql = "SELECT * FROM confirm_order LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Count total records for pagination
$countQuery = "SELECT COUNT(*) FROM confirm_order";
$countResult = $conn->query($countQuery);
$totalRecords = $countResult->fetch_row()[0];
$totalPages = ceil($totalRecords / $limit); // Calculate total pages

// Calculate total earnings
$totalEarningsQuery = "SELECT SUM(total_price) FROM confirm_order WHERE payment_status = 'Completed'";
$totalEarningsResult = $conn->query($totalEarningsQuery);
$totalEarnings = $totalEarningsResult->fetch_row()[0] ?: 0; // If no earnings, set it to 0

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Earnings</title>
    <style>
        /* Add your existing styles here */
        .container {
            width: 95%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            padding: 8px 16px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
        }
        .pagination a:hover {
            background-color: #0056b3;
        }
        .pagination .active {
            background-color: #28a745;
        }
        .total-earnings {
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php include 'admin_header.php'; ?>

<div class="container">
    <h2>Admin Earnings</h2>
    
    <!-- Display Total Earnings -->
    <div class="total-earnings">
        <strong>Total Earnings (Completed Orders): </strong> ₹<?php echo number_format($totalEarnings, 2); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Total Books</th>
                <th>Total Price</th>
                <th>Order Date</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>District</th>
                <th>Taluka</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo $row['total_books']; ?></td>
                    <td>₹<?php echo number_format($row['total_price'], 2); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row['order_date'])); ?></td>
                    <td>
                        <?php 
                        if ($row['payment_status'] == 'Completed') {
                            echo '<span style="color: green;">Completed</span>';
                        } else {
                            echo '<span style="color: red;">Pending</span>';
                        }
                        ?>
                    </td>
                    <td><?php echo $row['order_status']; ?></td>
                    <td><?php echo $row['district']; ?></td>
                    <td><?php echo $row['taluka']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($page > 1) { ?>
            <a href="admin_earnings.php?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
        <?php } ?>

        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="admin_earnings.php?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>

        <?php if ($page < $totalPages) { ?>
            <a href="admin_earnings.php?page=<?php echo $page + 1; ?>">Next &raquo;</a>
        <?php } ?>
    </div>
</div>

</body>
</html>

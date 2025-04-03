<?php
session_start();
include 'config.php'; // Database connection

// Pagination setup
$limit = 10; // Number of orders per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page, default to 1
$offset = ($page - 1) * $limit; // Calculate offset for SQL query

// Delete staff member
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $deleteQuery = "DELETE FROM delivery_staff WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Delivery staff deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete staff.";
    }
    header("Location: admin_manage_delivery_staff.php");
    exit();
}

// Fetch all delivery staff members with limit and offset for pagination
$sql = "SELECT * FROM delivery_staff LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Count total records for pagination
$countQuery = "SELECT COUNT(*) FROM delivery_staff";
$countResult = $conn->query($countQuery);
$totalRecords = $countResult->fetch_row()[0];
$totalPages = ceil($totalRecords / $limit); // Calculate total pages

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Delivery Staff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 95%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto; /* Fix table overflow issue */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .table-wrapper {
            width: 100%;
            overflow-x: auto; /* Add horizontal scroll if needed */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap; /* Prevent text from wrapping */
            table-layout: fixed; /* Fix column width issue */
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
            word-wrap: break-word; /* Allows text to wrap */
            max-width: 150px; /* Adjust this to fit your design */
            overflow: hidden;
            text-overflow: ellipsis; /* Adds '...' for overflow text */
            white-space: normal; /* Allows wrapping instead of a single line */
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-align: center;
        }
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            transition: background-color 0.3s ease;
        }
        .delete-btn:hover {
            background-color: #c0392b;
        }
        .toggle-btn-active {
            background-color: #2ecc71;
            color: white;
        }
        .toggle-btn-inactive {
            background-color: #f39c12;
            color: white;
        }
        .toggle-btn:hover {
            background-color: #27ae60;
        }
        .alert {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
        }
        .alert-success {
            background-color: #28a745;
            color: white;
        }
        .alert-error {
            background-color: #dc3545;
            color: white;
        }
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 20px;
            }
            table, th, td {
                font-size: 14px;
            }
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
    </style>
</head>

<body>

<?php include 'admin_header.php'; ?>

<div class="container">
    <h2>Manage Delivery Staff</h2>

    <!-- Display messages -->
    <?php if(isset($_SESSION['success'])) { ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php } ?>
    <?php if(isset($_SESSION['error'])) { ?>
        <div class="alert alert-error">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php } ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>District</th>
                <th>Taluka</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['district']); ?></td>
                    <td><?php echo htmlspecialchars($row['taluka']); ?></td>
                    <td>
                        <?php 
                        // Change button color based on status
                        if ($row['status'] == 'Active') {
                            echo '<button class="btn toggle-btn-active" onclick="toggleStatus(' . $row['id'] . ')">Deactivate</button>';
                        } else {
                            echo '<button class="btn toggle-btn-inactive" onclick="toggleStatus(' . $row['id'] . ')">Activate</button>';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="admin_manage_delivery_staff.php?delete=<?php echo $row['id']; ?>" 
                           class="btn delete-btn" onclick="return confirm('Are you sure?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($page > 1) { ?>
            <a href="admin_manage_delivery_staff.php?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
        <?php } ?>

        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="admin_manage_delivery_staff.php?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
        <?php } ?>

        <?php if ($page < $totalPages) { ?>
            <a href="admin_manage_delivery_staff.php?page=<?php echo $page + 1; ?>">Next &raquo;</a>
        <?php } ?>
    </div>
</div>

<script>
function toggleStatus(id) {
    let confirmation = confirm("Are you sure you want to change the status?");
    if (confirmation) {
        window.location.href = "toggle_status.php?id=" + id;
    }
}
</script>

</body>
</html>

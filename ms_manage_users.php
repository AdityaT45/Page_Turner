<?php 
ob_start();
session_start();
include 'config.php';

// Redirect if managing staff not logged in
if (!isset($_SESSION['ms_id'])) {
    header("Location: ms_login.php");
    exit();
}

// Fetch total number of users
$query = mysqli_query($conn, "SELECT COUNT(*) AS total_users FROM users_info");
$result = mysqli_fetch_assoc($query);
$total_users = $result['total_users'];

// Pagination setup
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch users for the current page
$sql = "SELECT id, name, surname, email, user_type FROM users_info LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);

// Fetch total number of pages
$total_pages = ceil($total_users / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users (Staff)</title>
    <style>
        /* Your same styles */
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .container { width: 95%; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); overflow-x: auto; }
        h2 { text-align: center; margin-bottom: 20px; }
        .table-wrapper { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; white-space: nowrap; table-layout: fixed; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; font-size: 14px; }
        th { background-color: #007bff; color: white; }
        .action-btn { padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; color: white; }
        .delete-btn { background-color: #dc3545; }
        .delete-btn:hover { background-color: #b32a37; }
        .pagination { text-align: center; margin-top: 20px; }
        .pagination a { padding: 8px 16px; margin: 0 5px; text-decoration: none; background-color: #007bff; color: white; border-radius: 5px; }
        .pagination a:hover { background-color: #0056b3; }
        .alert { padding: 10px; margin: 10px 0; border-radius: 5px; text-align: center; }
        .alert-success { background-color: #28a745; color: white; }
        .alert-error { background-color: #dc3545; color: white; }
    </style>
</head>
<body>

<?php include 'ms_header.php'; ?>

<div class="container">
    <h2>Manage Users</h2>

    <!-- Display success or error messages -->
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php } ?>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name'] . ' ' . $row['surname']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_type']); ?></td>
                        <td>
                            <?php if ($row['user_type'] == 'User') { ?>
                                <a href="ms_manage_users.php?delete=<?php echo $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a href="ms_manage_users.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php } ?>
    </div>

</div>

<?php
// Delete user functionality
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users_info WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "User deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete user.";
    }
    header("Location: ms_manage_users.php");
    exit();
}
?>

</body>
</html>
<?php ob_end_flush(); ?>

<?php
include 'config.php';
session_start();

// Check if admin is logged in
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
    exit;
}

// Fetch all staff members
$staff_query = mysqli_query($conn, "SELECT * FROM staff ORDER BY created_at DESC");

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
        .action-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }
        .edit-btn {
            background-color: #28a745;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .delete-btn:hover {
            background-color: #b32a37;
        }
        .add-btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 10px;
        }
        .add-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'admin_header.php'; ?>

<div class="container">
    <h2>Manage Delivery Staff</h2>
    <a href="admin_add_staff.php" class="add-btn" style="background-color:green">Add Staff</a>
    <div class="table-wrapper">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <?php
            if (mysqli_num_rows($staff_query) > 0) {
                while ($staff = mysqli_fetch_assoc($staff_query)) {
                    echo "<tr>
                            <td>{$staff['id']}</td>
                            <td>{$staff['name']}</td>
                            <td>{$staff['email']}</td>
                            <td>{$staff['created_at']}</td>
                            <td>
                                <a href='admin_edit_staff.php?id={$staff['id']}' class='action-btn edit-btn'>Edit</a>
                                <a href='admin_delete_staff.php?id={$staff['id']}' class='action-btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this staff member?\")'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No Staff Found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>

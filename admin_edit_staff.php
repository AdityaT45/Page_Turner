<?php
include 'config.php';
session_start();

// Check if admin is logged in
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
    exit;
}

// Get staff ID from URL
if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];
    $staff_query = mysqli_query($conn, "SELECT * FROM staff WHERE id = '$staff_id'");
    $staff = mysqli_fetch_assoc($staff_query);
    
    if (!$staff) {
        echo "Staff member not found.";
        exit;
    }
} else {
    header('location:admin_manage_staff.php');
    exit;
}

// Update staff details
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $staff['password']; // Update password only if provided

    $update_query = "UPDATE staff SET name = '$name', email = '$email', password = '$password' WHERE id = '$staff_id'";
    
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Staff details updated successfully!'); window.location.href='admin_manage_staff.php';</script>";
    } else {
        echo "<script>alert('Failed to update staff details.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
        }
        .btn:hover {
            background: #0056b3;
        }
        .cancel-btn {
            background: #dc3545;
            text-align: center;
        }
        .cancel-btn:hover {
            background: #b32a37;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Staff Member</h2>
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $staff['name']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $staff['email']; ?>" required>

        <label for="password">New Password (leave blank to keep current password):</label>
        <input type="password" name="password" id="password">

        <button type="submit" name="update" class="btn">Update Staff</button>
        <a href="admin_manage_staff.php" class="btn cancel-btn">Cancel</a>
    </form>
</div>

</body>
</html>

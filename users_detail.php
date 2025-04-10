<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('location:login.php');
    exit();
}

// Update User
if (isset($_POST['update_user'])) {
    $update_id = $_POST['update_id'];
    $update_name = $_POST['update_name'];
    $update_sname = $_POST['update_sname'];
    $update_uname = $_POST['update_uname'];
    $update_email = $_POST['update_email'];
    $update_password = $_POST['update_password'];
    $update_user_type = $_POST['update_user_type'];

    mysqli_query($conn, "UPDATE `users_info` SET name='$update_name', surname='$update_sname', username='$update_uname', email='$update_email', password='$update_password', user_type='$update_user_type' WHERE Id='$update_id'") or die('Query failed');

    header('location:users_detail.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fdfce5;
            text-align: center;
        }
        h2 {
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #0f3859;
            color: white;
        }
        td {
            text-align: center;
        }
        .edit, .delete {
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }
        .edit { background: #007bff; color: white; }
        .edit:hover { background: #0056b3; }
        .delete { background: #dc3545; color: white; }
        .delete:hover { background: #a71d2a; }
        form {
            background: white;
            padding: 15px;
            width: 50%;
            margin: 20px auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: none;
        }
        input, select {
            width: 90%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .save {
            background: #0f3859;
            color: white;
            cursor: pointer;
            border: none;
            width: 100%;
            padding: 10px;
        }
        .save:hover {
            background: #092a42;
        }
    </style>
</head>

<body>
<?php include 'admin_header.php'; ?>

    <h2>User Details</h2>
    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>User Type</th>
            <th>Actions</th>
        </tr>

        <?php
        $select_user = mysqli_query($conn, "SELECT * FROM users_info") or die('Query failed');
        if (mysqli_num_rows($select_user) > 0) {
            while ($fetch_user = mysqli_fetch_assoc($select_user)) {
                ?>
                <tr>
                    <td><?php echo $fetch_user['Id']; ?></td>
                    <td><?php echo $fetch_user['name'] . " " . $fetch_user['surname']; ?></td>
                    <td><?php echo $fetch_user['username']; ?></td>
                    <td><?php echo $fetch_user['email']; ?></td>
                    <td style="color:<?php echo ($fetch_user['user_type'] == 'Admin') ? 'red' : 'blue'; ?>;">
                        <?php echo $fetch_user['user_type']; ?>
                    </td>
                    <td>
                        <button class="edit" onclick="openEditForm('<?php echo $fetch_user['Id']; ?>', '<?php echo $fetch_user['name']; ?>', '<?php echo $fetch_user['surname']; ?>', '<?php echo $fetch_user['username']; ?>', '<?php echo $fetch_user['email']; ?>', '<?php echo $fetch_user['password']; ?>', '<?php echo $fetch_user['user_type']; ?>')">Edit</button>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="6">No users found</td></tr>';
        }
        ?>
    </table>

    <form id="editUserForm" method="POST">
        <h3>Edit User</h3>
        <input type="hidden" name="update_id" id="update_id">
        <input type="text" name="update_name" id="update_name" placeholder="Enter Name" required>
        <input type="text" name="update_sname" id="update_sname" placeholder="Enter Surname" required>
        <input type="text" name="update_uname" id="update_uname" placeholder="Enter Username" required>
        <input type="email" name="update_email" id="update_email" placeholder="Enter Email" required>
        <input type="password" name="update_password" id="update_password" placeholder="Enter Password" required>
        <select name="update_user_type" id="update_user_type" required>
            <option value="User">User</option>
            <option value="Admin">Admin</option>
        </select>
        <input type="submit" name="update_user" value="Update" class="save">
    </form>

    <script>
        function openEditForm(id, name, surname, username, email, password, userType) {
            document.getElementById("update_id").value = id;
            document.getElementById("update_name").value = name;
            document.getElementById("update_sname").value = surname;
            document.getElementById("update_uname").value = username;
            document.getElementById("update_email").value = email;
            document.getElementById("update_password").value = password;
            document.getElementById("update_user_type").value = userType;
            document.getElementById("editUserForm").style.display = "block";
        }
    </script>

</body>

</html>

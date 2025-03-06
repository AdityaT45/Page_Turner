<?php
session_start();
include 'config.php'; // Database connection

if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}

// DELETE staff
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM staff WHERE id=$id");
    header("Location: manage_staff.php");
}

// UPDATE staff
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = "UPDATE staff SET name='$name', email='$email', password='$password' WHERE id=$id";
    } else {
        $sql = "UPDATE staff SET name='$name', email='$email' WHERE id=$id";
    }

    mysqli_query($conn, $sql);
    header("Location: manage_staff.php");
}

// ADD staff
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_staff'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO staff (name, email, password) VALUES ('$name', '$email', '$password')";
    mysqli_query($conn, $sql);
    header("Location: manage_staff.php");
}

// FETCH staff members
$result = mysqli_query($conn, "SELECT * FROM staff");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
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
        .edit, .delete, .add {
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
        .add { background: #28a745; color: white; }
        .add:hover { background: #1e7e34; }
        form {
            background: white;
            padding: 15px;
            width: 50%;
            margin: 20px auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            display: none;
        }
        input {
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
        }
        .save:hover {
            background: #092a42;
        }
    </style>
</head>
<body>
<?php include 'admin_header.php'; ?>
<h2>Manage Staff</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['created_at']; ?></td>
            <td>
                <button class="edit" onclick="editStaff(<?= $row['id']; ?>, '<?= $row['name']; ?>', '<?= $row['email']; ?>')">Edit</button>
                <a href="manage_staff.php?delete=<?= $row['id']; ?>" class="delete" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

<button class="add" onclick="document.getElementById('addForm').style.display='block'">Add Staff</button>

<!-- Add Staff Form -->
<form id="addForm" method="post">
    <h3>Add Staff</h3>
    <input type="hidden" name="add_staff" value="1">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" class="save">Add Staff</button>
</form>

<!-- Edit Staff Form -->
<form id="editForm" method="post">
    <h3>Edit Staff</h3>
    <input type="hidden" name="update_id" id="update_id">
    <input type="text" name="name" id="edit_name" placeholder="Name" required>
    <input type="email" name="email" id="edit_email" placeholder="Email" required>
    <input type="password" name="password" id="edit_password" placeholder="New Password (Leave blank if unchanged)">
    <button type="submit" class="save">Update Staff</button>
</form>

<script>
    function editStaff(id, name, email) {
        document.getElementById('editForm').style.display = 'block';
        document.getElementById('update_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
    }
</script>

</body>
</html>

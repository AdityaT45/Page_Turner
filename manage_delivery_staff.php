<?php
session_start();
include 'config.php'; // Database connection

if (!isset($_SESSION['admin_name'])) {
    header("Location: admin_login.php");
    exit();
}

// DELETE delivery staff
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM delivery_staff WHERE id=$id");
    header("Location: manage_delivery_staff.php");
}

// UPDATE delivery staff
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $id = $_POST['update_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $sql = "UPDATE delivery_staff SET name='$name', email='$email', password='$password' WHERE id=$id";
    } else {
        $sql = "UPDATE delivery_staff SET name='$name', email='$email' WHERE id=$id";
    }

    mysqli_query($conn, $sql);
    header("Location: manage_delivery_staff.php");
}

// ADD delivery staff
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_staff'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO delivery_staff (name, email, password) VALUES ('$name', '$email', '$password')";
    mysqli_query($conn, $sql);
    header("Location: manage_delivery_staff.php");
}

// FETCH delivery staff members
$result = mysqli_query($conn, "SELECT * FROM delivery_staff");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Delivery Staff</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body style="background-color:#fdfce5">
<?php include 'admin_header.php'; ?>

<div class="container mt-4">
    <h2 class="text-center">Manage Delivery Staff</h2>
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addStaffModal">Add Delivery Staff</button>

    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['created_at']; ?></td>
                    <td>
                        <button class="btn btn-primary" 
                            onclick="editStaff(<?= $row['id']; ?>, '<?= $row['name']; ?>', '<?= $row['email']; ?>')" 
                            data-bs-toggle="modal" data-bs-target="#editStaffModal">Edit</button>
                        <a href="manage_delivery_staff.php?delete=<?= $row['id']; ?>" class="btn btn-danger" 
                           onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- ADD STAFF MODAL -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStaffLabel">Add Delivery Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="hidden" name="add_staff" value="1">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Add Delivery Staff</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- EDIT STAFF MODAL -->
<div class="modal fade" id="editStaffModal" tabindex="-1" aria-labelledby="editStaffLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStaffLabel">Edit Delivery Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" id="edit_name" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="edit_email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" id="edit_password" 
                               placeholder="New Password (Leave blank if unchanged)">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Delivery Staff</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editStaff(id, name, email) {
        document.getElementById('update_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

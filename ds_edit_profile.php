<?php
include 'config.php';
session_start();

// Check if the delivery staff is logged in
if (!isset($_SESSION['delivery_staff_id'])) {
    header('location: ds_login.php');
    exit();
}

$ds_id = mysqli_real_escape_string($conn, $_SESSION['delivery_staff_id']);

// Fetch delivery staff details
$query = "SELECT * FROM delivery_staff WHERE id = '$ds_id'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
    $staff = mysqli_fetch_assoc($result);
} else {
    echo "<p style='color: red; text-align: center;'>Profile not found!</p>";
    exit();
}

// Handle form submission
if (isset($_POST['update_profile'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $taluka = mysqli_real_escape_string($conn, $_POST['taluka']);

    $update_query = "UPDATE delivery_staff SET name='$name', phone='$phone', district='$district', taluka='$taluka' WHERE id='$ds_id'";

    if (mysqli_query($conn, $update_query)) {
        $success = "Profile updated successfully!";
        header("refresh:2; url=ds_profile.php"); // Redirect after 2 seconds
    } else {
        $error = "Failed to update profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="./css/admin.css">
    <style>
        body {
            background-color: lightgrey;
        }
        .profile-container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .profile-container h2 {
            color: #007bff;
        }
        .profile-info {
            text-align: left;
            margin: 20px 0;
        }
        .profile-info label {
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        .profile-info input {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .save-btn {
            display: inline-block;
            padding: 10px 15px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            border: none;
            cursor: pointer;
        }
        .save-btn:hover {
            background: #218838;
        }
        .message {
            color: green;
            font-size: 16px;
            margin-top: 10px;
        }
        .error {
            color: red;
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php include 'ds_header.php'; ?>

<div class="profile-container">
    <h2>Edit Profile</h2>

    <?php if (isset($success)) { echo "<p class='message'>$success</p>"; } ?>
    <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

    <form method="POST">
        <div class="profile-info">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $staff['name']; ?>" required>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo $staff['phone']; ?>" required>

            <label>District:</label>
            <input type="text" name="district" value="<?php echo $staff['district']; ?>" required>

            <label>Taluka:</label>
            <input type="text" name="taluka" value="<?php echo $staff['taluka']; ?>" required>

            <button type="submit" name="update_profile" class="save-btn">Save Changes</button>
        </div>
    </form>
</div>

</body>
</html>

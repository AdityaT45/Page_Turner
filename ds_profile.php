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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Staff Profile</title>
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
        .profile-info p {
            font-size: 18px;
            margin: 8px 0;
        }
        .edit-btn {
            display: inline-block;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .edit-btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body style="background-color:#fdfce5">

<?php include 'ds_header.php'; ?>

<div class="profile-container">
    <h2>Delivery Staff Profile</h2>
    
    <div class="profile-info">
        <p><strong>Name:</strong> <?php echo $staff['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $staff['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $staff['phone']; ?></p>
        <p><strong>District:</strong> <?php echo $staff['district']; ?></p>
        <p><strong>Taluka:</strong> <?php echo $staff['taluka']; ?></p>
        <p><strong>Status:</strong> 
            <span style="color: <?php echo ($staff['status'] == 'active') ? 'green' : 'red'; ?>;">
                <?php echo ucfirst($staff['status']); ?>
            </span>
        </p>
    </div>

    <a href="ds_edit_profile.php" class="edit-btn">Edit Profile</a>
</div>

</body>
</html>

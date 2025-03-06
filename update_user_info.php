<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect if not logged in
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$query = $conn->query("SELECT * FROM users_info WHERE Id = '$user_id'");
$user = mysqli_fetch_assoc($query);

// Update user info
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);

    $update_query = "UPDATE users_info SET 
        name = '$name', surname = '$surname', username = '$username', 
        email = '$email', password = '$password', address = '$address', 
        city = '$city', state = '$state', country = '$country', 
        pincode = '$pincode' WHERE Id = '$user_id'";

    if ($conn->query($update_query)) {
        $message = "Profile Updated Successfully!";
        header("Refresh:1");
    } else {
        $message = "Update Failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Arial', sans-serif; }
        body { background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        
        .container {
            background: white; width: 500px; padding: 30px;
            border-radius: 12px; box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
        }
        
        h2 { text-align: center; color: #0a3d62; margin-bottom: 20px; }
        
        .form-group {
            display: flex; justify-content: space-between; gap: 10px; 
            margin-bottom: 12px;
        }

        .form-group label { width: 45%; font-weight: bold; color: #333; }
        
        input {
            width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 8px;
            transition: 0.3s; font-size: 16px;
        }
        
        input:focus { border-color: #0a3d62; outline: none; }
        
        button {
            width: 100%; padding: 12px; background: #0a3d62; color: white;
            border: none; border-radius: 8px; font-size: 16px; cursor: pointer;
            transition: 0.3s; margin-top: 10px;
        }
        
        button:hover { background: #07538f; }

        .message {
            text-align: center; color: green; font-weight: bold; 
            margin-bottom: 10px;
        }
    </style>
</head>
<body style="background-color:#fdfce5">


<div class="container">
    <h2>Update Your Information</h2>

    <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>

    <form action="" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="<?= $user['name'] ?>" required>
        </div>

        <div class="form-group">
            <label>Surname</label>
            <input type="text" name="surname" value="<?= $user['surname'] ?>" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?= $user['username'] ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $user['email'] ?>" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" value="<?= $user['password'] ?>" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" value="<?= $user['address'] ?>">
        </div>

        <div class="form-group">
            <label>City</label>
            <input type="text" name="city" value="<?= $user['city'] ?>">
        </div>

        <div class="form-group">
            <label>State</label>
            <input type="text" name="state" value="<?= $user['state'] ?>">
        </div>

        <div class="form-group">
            <label>Country</label>
            <input type="text" name="country" value="<?= $user['country'] ?>">
        </div>

        <div class="form-group">
            <label>Pincode</label>
            <input type="text" name="pincode" value="<?= $user['pincode'] ?>">
        </div>

        <button type="submit" name="update">Update</button>
    </form>
</div>

 
</body>
</html>

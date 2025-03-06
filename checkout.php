<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit;
}

// Fetch user information
$user_query = mysqli_query($conn, "SELECT * FROM `users_info` WHERE id = '$user_id'") or die('Query failed');

if (mysqli_num_rows($user_query) > 0) {
    $user_data = mysqli_fetch_assoc($user_query);
} else {
    die('User not found.');
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Information</title>
</head>
<body>

<h2>User Information</h2>
<form action="update_user.php" method="POST">
    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>

    <label for="number">Phone Number:</label>
    <input type="text" id="number" name="number" value="<?php echo htmlspecialchars($user_data['number']); ?>" maxlength="10" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user_data['address']); ?>" required>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user_data['city']); ?>" required>

    <label for="state">State:</label>
    <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($user_data['state']); ?>" required>

    <label for="pincode">Pin Code:</label>
    <input type="text" id="pincode" name="pincode" value="<?php echo htmlspecialchars($user_data['pincode']); ?>" required>

    <input type="submit" name="update" value="Update">
</form>

</body>
</html>

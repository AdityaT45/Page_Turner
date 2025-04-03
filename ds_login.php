<?php
include 'config.php';
session_start(); // Start session (missing in your code)

// Redirect if already logged in
if (isset($_SESSION['delivery_staff_id'])) {
    header('location: ds_dashboard.php');
    exit();
}

// Handle login form submission
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if email exists and staff is active
    $query = "SELECT * FROM delivery_staff WHERE email = '$email' AND status = 'active'";
    $result = mysqli_query($conn, $query) or die('Query failed');

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['password'])) { // Verify hashed password
            $_SESSION['delivery_staff_id'] = $row['id'];
            $_SESSION['delivery_staff_name'] = $row['name'];
            header('location: ds_dashboard.php');
            exit();
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "Account not found or inactive!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Staff Login</title>

</head>
<body>
    <div class="login-container">
        <h2>Delivery Staff Login</h2>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <form action="" method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required autocomplete="current-password">

            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>

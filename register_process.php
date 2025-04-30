<?php
session_start();
include 'config.php'; // your database connection file

if (isset($_POST['register'])) {
    $name = $_POST['Name'];
    $sname = $_POST['Sname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check password match
    if ($password != $cpassword) {
        $_SESSION['message'] = "Passwords do not match!";
        header("Location: register.php");
        exit();
    }

    // Check if user already exists
    $check_user = mysqli_query($conn, "SELECT * FROM users_info WHERE email='$email' OR username='$username'");
    if (mysqli_num_rows($check_user) > 0) {
        $_SESSION['message'] = "Email or Username already exists!";
        header("Location: register.php");
        exit();
    }

    // Insert new user (plain password)
    $insert = mysqli_query($conn, "INSERT INTO users_info (name, surname, username, email, password) VALUES ('$name', '$sname', '$username', '$email', '$password')");

    if ($insert) {
        $_SESSION['message'] = "Registration successful! Please login.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['message'] = "Something went wrong!";
        header("Location: register.php");
        exit();
    }
}
?>

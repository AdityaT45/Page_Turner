<?php
session_start();

// Check if OTP is submitted for verification
if (isset($_POST['verify_otp'])) {
    // Check if email and OTP are provided
    if (empty($_POST['email']) || empty($_POST['otp'])) {
        $_SESSION['message'] = "Email and OTP are required!";
        header("Location: register.php");
        exit();
    }

    $email = $_POST['email'];
    $otp = $_POST['otp'];

    // Validate OTP
    if ($otp == $_SESSION['otp']) {
        $_SESSION['message'] = "OTP Verified Successfully!";
        // Redirect to next registration step (e.g., store the user, show next form, etc.)
        header("Location: register_success.php");
        exit();
    } else {
        $_SESSION['message'] = "Invalid OTP! Please try again.";
        header("Location: register.php");
        exit();
    }
}

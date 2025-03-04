<?php
session_start();
include 'config.php';

if (isset($_POST['verify_otp'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);

    $check_otp = $conn->query("SELECT * FROM otp_verification WHERE email='$email' AND otp='$otp' ORDER BY created_at DESC LIMIT 1");

    if (mysqli_num_rows($check_otp) > 0) {
        echo 'OTP Verified! Proceeding to Registration...';
        // You can redirect or proceed with user registration
    } else {
        echo 'Invalid OTP! Please try again.';
    }
}
?>

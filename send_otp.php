<?php
session_start();
include 'config.php';  // Database connection
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer

if (isset($_POST['send_otp'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Generate 6-digit OTP
    $otp = rand(100000, 999999);

    // First, delete any existing OTP for this email (prevents duplicate entries)
    $conn->query("DELETE FROM otp_verification WHERE email='$email'");

    // Insert OTP into the database
    $insert = $conn->query("INSERT INTO otp_verification (email, otp, created_at) VALUES ('$email', '$otp', NOW())");

    if (!$insert) {
        die("Error inserting OTP: " . $conn->error);
    }

    // Send email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gandhibapu009@gmail.com'; // Use your email
        $mail->Password = 'bskv bfps vtuk zlhz'; // Use App Password instead
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('gandhibapu009@gmail.com', 'Page Turner');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "<h3>Your OTP Code is: <b>$otp</b></h3>";

        if ($mail->send()) {
            echo "OTP sent successfully!";
        } else {
            echo "Error sending OTP: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Error sending OTP: {$mail->ErrorInfo}";
    }
}
?>

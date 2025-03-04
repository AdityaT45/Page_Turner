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

    // Store OTP in database
    $conn->query("INSERT INTO otp_verification (email, otp) VALUES ('$email', '$otp')");

    // Send email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Use your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'gandhibapu009@gmail.com'; // Replace with your email
        $mail->Password = 'bskv bfps vtuk zlhz'; // Replace with your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('gandhibapu009@gmail.com', 'Page Turner');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "<h3>Your OTP Code is: <b>$otp</b></h3>";

        $mail->send();
        echo 'OTP sent successfully!';
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
?>



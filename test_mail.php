<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Use your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'gandhibapu009@gmail.com'; // Your email
    $mail->Password   = 'aaaaa@123'; // Your email password (or App Password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Email details
    $mail->setFrom('gandhibapu009@gmail.com', 'Page Turner');
    $mail->addAddress('adityatodmal47@gmail.com'); // Change this to the recipient's email

    $mail->Subject = 'PHPMailer Test';
    $mail->Body    = 'This is a test email from PHPMailer!';

    $mail->send();
    echo 'Email has been sent successfully!';
} catch (Exception $e) {
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}
?>

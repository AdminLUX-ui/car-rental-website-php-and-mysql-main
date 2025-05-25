<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendConfirmationEmail($to, $token) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'shantanukulkarni@luxcarrentalcomau.com';  // Your Workspace email
        $mail->Password = getenv('SMTP_MAIL_PASSWORD'); // Securely read password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email settings
        $mail->setFrom('shantanukulkarni@luxcarrentalcomau.com', 'Lux Car Rental');
        $mail->addAddress($to); // recipient

        $mail->Subject = 'Car Reservation Email Confirmation';
        $verificationLink = "https://luxcarrentalcomau.com/verify_email.php?token=" . urlencode($token);
        $mail->Body = "Thank you for reserving a car. Please verify your email by clicking the link below:\n\n$verificationLink";

        $mail->send();
        echo "Email sent successfully!";
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

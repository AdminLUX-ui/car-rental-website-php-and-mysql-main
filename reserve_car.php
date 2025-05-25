<?php
// reserve_car.php

// ...existing code...

$email = $_POST['email'];
$token = bin2hex(random_bytes(16)); // Generate a secure token

// Insert reservation with token and email_verified = 0
$stmt = $conn->prepare("INSERT INTO reservations (email, email_token, email_verified, ...) VALUES (?, ?, 0, ...)");
$stmt->bind_param("ss...", $email, $token /*, other params */);
$stmt->execute();

// Send confirmation email
require_once 'send_email.php';
sendConfirmationEmail($email, $token);

// ...existing code...
?>
<?php
require_once 'connect.php'; // Add this to connect to the database

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    // Check if token exists
    $stmt = $con->prepare("SELECT id FROM reservations WHERE email_token = ? AND email_verified = 0");
    $stmt->execute([$token]);
    if ($stmt->rowCount() > 0) {
        // Mark email as verified
        $update = $con->prepare("UPDATE reservations SET email_verified = 1 WHERE email_token = ?");
        $update->execute([$token]);
        echo "Email verified successfully!";
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "No token provided.";
}
?>

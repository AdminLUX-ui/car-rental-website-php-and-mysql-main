<?php
require_once 'connect.php'; // Add this to connect to the database

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    // Check if token exists
    $stmt = $con->prepare("SELECT id FROM reservations WHERE email_token = ? AND email_verified = 0");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        // Mark email as verified
        $update = $con->prepare("UPDATE reservations SET email_verified = 1 WHERE email_token = ?");
        $update->bind_param("s", $token);
        $update->execute();
        echo "Email verified successfully!";
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "No token provided.";
}
?>

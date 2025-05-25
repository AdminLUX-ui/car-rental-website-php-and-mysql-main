<?php
require_once 'connect.php';
include "Includes/templates/header.php";
include "Includes/templates/navbar.php";
?>
<div class="container" style="margin-top:40px;">
<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    // Check if token exists (use reservation_id instead of id if that's your PK, or just SELECT 1)
    $stmt = $con->prepare("SELECT * FROM reservations WHERE email_token = ? AND email_verified = 0");
    $stmt->execute([$token]);
    if ($stmt->rowCount() > 0) {
        $update = $con->prepare("UPDATE reservations SET email_verified = 1 WHERE email_token = ?");
        $update->execute([$token]);
        echo "<div class='alert alert-success'>Email verified successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Invalid or expired token.</div>";
    }
} else {
    echo "<div class='alert alert-warning'>No token provided.</div>";
}
?>
</div>
<?php include "Includes/templates/footer.php"; ?>

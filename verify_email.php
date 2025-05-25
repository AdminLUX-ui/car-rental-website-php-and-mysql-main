<?php
require_once 'connect.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $stmt = $con->prepare("SELECT * FROM reservations WHERE email_token = ? AND email_verified = 0");
    $stmt->execute([$token]);
    if ($stmt->rowCount() > 0) {
        $update = $con->prepare("UPDATE reservations SET email_verified = 1 WHERE email_token = ?");
        $update->execute([$token]);
        echo "<div style='margin:60px auto;max-width:400px;text-align:center;padding:30px 20px;border-radius:8px;background:#e6ffed;color:#155724;font-size:1.2em;border:1px solid #b2f5c0;'>Email verified successfully!<br><br>Redirecting to home...</div>\n<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
        exit();
    } else {
        echo "<div style='margin:60px auto;max-width:400px;text-align:center;padding:30px 20px;border-radius:8px;background:#ffe6e6;color:#721c24;font-size:1.2em;border:1px solid #f5b2b2;'>Invalid or expired token.</div>\n<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
        exit();
    }
} else {
    echo "<div style='margin:60px auto;max-width:400px;text-align:center;padding:30px 20px;border-radius:8px;background:#fffbe6;color:#856404;font-size:1.2em;border:1px solid #ffeeba;'>No token provided.</div>\n<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
    exit();
}
?>

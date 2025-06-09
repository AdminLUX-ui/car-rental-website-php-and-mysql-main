<?php
$dsn = getenv('DB_STRING');
$user = getenv('AZURE_MYSQL_USERNAME');
$pass = getenv('AZURE_MYSQL_PASSWORD');

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);

try {
    $con = new PDO($dsn, $user, $pass, $options);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // Optional: remove or comment out in production
    return $con;
} catch(PDOException $ex) {
    echo "Failed to connect with database! " . $ex->getMessage();
    return null;
}
?>

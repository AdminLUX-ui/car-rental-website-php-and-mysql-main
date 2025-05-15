<?php
$dsn = 'mysql:host=lux-mysql-server.mysql.database.azure.com;dbname=car_rental;sslmode=require;

$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);

try {
    $con = new PDO($dsn, $user, $pass, $options);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch(PDOException $ex) {
    echo "Failed to connect with database! " . $ex->getMessage();
    
}
?>

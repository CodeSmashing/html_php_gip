<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'gip';

try {
    // Create a PDO object and set the connection parameters
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    );
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    // Handle any errors that may occur during connection
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
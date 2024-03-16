<?php
$dsn = "mysql:host=localhost;dbname=class_schedule;";
$db_user_name = "root";
$db_password = "";

try {
    $pdo = new PDO($dsn, $db_user_name, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error Database: " . $e->getMessage();
}

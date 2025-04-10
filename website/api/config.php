<?php
$host = "localhost";
$db_name = "sumbosi4_sumbo";
$username = "sumbosi4_Maabu025";
$password = "Maa0592534928$$";

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $e->getMessage()]));
}
?>

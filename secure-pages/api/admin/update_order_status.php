<?php
include "../config.php";
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}

$order_id = $_POST['order_id'];
$status = $_POST['status'];

$sql = "UPDATE orders SET status = ? WHERE order_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$status, $order_id]);

echo json_encode(["success" => "Order status updated"]);
?>

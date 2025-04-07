<?php
include "../config.php";
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo json_encode(["error" => "Unauthorized access"]);
    exit;
}

$payment_id = $_POST['payment_id'];
$status = $_POST['status'];

$sql = "UPDATE payments SET payment_status = ? WHERE payment_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$status, $payment_id]);

echo json_encode(["success" => "Payment status updated"]);
?>

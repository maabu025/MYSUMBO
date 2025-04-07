<?php
include "../config.php";
session_start();

$user_id = $_SESSION['user_id'] ?? null;
$user_role = $_SESSION['role'] ?? null; // 'admin' or 'customer'

// SQL Query to fetch orders with customer name and payment status
$sql = "SELECT o.order_id, o.user_id, u.first_name, u.last_name, o.order_date, o.total_amount, 
               o.status AS order_status, p.payment_status, p.payment_id
        FROM orders o
        JOIN user_profiles u ON o.user_id = u.user_id
        LEFT JOIN payments p ON o.order_id = p.order_id";

// If the user is NOT admin, show only their orders
if ($user_role !== 'admin') {
    $sql .= " WHERE o.user_id = ?";
}

// Prepare and execute statement
$stmt = $pdo->prepare($sql);
if ($user_role !== 'admin') {
    $stmt->execute([$user_id]);
} else {
    $stmt->execute();
}

// Fetch results
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($orders);
?>

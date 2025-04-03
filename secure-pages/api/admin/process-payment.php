<?php
include "../config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['order_id']) || !isset($_POST['total_amount']) || !isset($_POST['transaction_id'])) {
        echo "Invalid request.";
        exit;
    }

    $order_id = $_POST['order_id'];
    $amount = $_POST['total_amount'];
    $transaction_id = $_POST['transaction_id'];
    $payment_status = "Pending"; // You can adjust this based on real transaction status

    // Get the customer_id from the orders table
    $sql = "SELECT user_id FROM orders WHERE order_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$order_id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        echo "Order not found.";
        exit;
    }

    $user_id = $order['user_id'];

    try {
        $pdo->beginTransaction();

        // ✅ Insert payment details
        $sql = "INSERT INTO payments (order_id, user_id, amount, transaction_id, payment_date, payment_status) 
                VALUES (?, ?, ?, ?, NOW(), ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$order_id, $user_id, $amount, $transaction_id, $payment_status]);

        // ✅ Update order status to "Paid"
        $sql = "UPDATE orders SET status = 'Processing' WHERE order_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$order_id]);

        $pdo->commit();

        // ✅ Redirect to success page
        header("Location: ../../settings.php?section=order-success&order_id=" . $order_id);   
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "❌ Payment failed: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>

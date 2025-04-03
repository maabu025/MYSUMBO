<?php
include "api/config.php";

if (!isset($_GET['order_id'])) {
    echo "Invalid order.";
    exit;
}

$order_id = $_GET['order_id'];

// Fetch order details using PDO
$sql = "SELECT * FROM orders WHERE order_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$order_id]); // Use an array to pass parameters in PDO
$order = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as an associative array

if (!$order) {
    echo "Order not found.";
    exit;
}

$total_amount = $order['total_amount'];
?>

<div class="container mt-5">
    <h2 class="text-center" style="color: #fff;">Payment Page</h2>
    <p class="text-center" style="color: #fff;">Order ID: <?php echo $order_id; ?></p>
    <p class="text-center" style="color: #fff;">Total Amount: <strong>$<?php echo number_format($total_amount, 2); ?></strong></p>

    <div class="text-center">
    <form action="api/admin/process-payment.php" method="POST" id="paymentForm">
    <input type="text" name="transaction_id" id="transaction_id" required
        style="color: #fff; text-align: center; font-size: 16px;"
        class="form-control mb-3 text-center"
        placeholder="Enter Transaction ID">
    
    <input type="hidden" name="total_amount" id="total_amount" value="<?php echo htmlspecialchars($total_amount, ENT_QUOTES, 'UTF-8'); ?>">
    <input type="hidden" name="order_id" id="order_id" value="<?php echo htmlspecialchars($order_id, ENT_QUOTES, 'UTF-8'); ?>">

    <button type="submit" class="btn btn-success" id="payButton">Complete Payment</button>
</form>

    </div>
</div>
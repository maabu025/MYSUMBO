<?php
include "../config.php";
session_start();

if (!isset($_GET['id']) || !isset($_GET['title']) || !isset($_GET['price']) || !isset($_GET['type'])) {
    echo "Invalid request.";
    exit;
}

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("SELECT user_id FROM user_profiles WHERE user_id = ?");
$stmt->execute([$user_id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "Customer ID: " . $user['user_id'];
} else {
    echo "❌ No customer found for user_id: $user";
}

$user_id = $user['user_id']; // Example customer ID (make dynamic)
$course_id = $_GET['type'] === 'course' ? $_GET['id'] : null;
$product_id = $_GET['type'] === 'product' ? $_GET['id'] : null;
$title = $_GET['title'];
$price = $_GET['price'];
$image = $_GET['image'] ? "uploads/courses/" . $_GET['image'] : "dash-assets/img/product/bg-1.jpg";
$type = $_GET['type'];
$quantity = 1;
$total_amount = $price * $quantity;

try {
    $pdo->beginTransaction();

    // Insert order
    $sql = "INSERT INTO orders (user_id, order_date, total_amount, type, status) VALUES (?, NOW(), ?, ?, 'Pending')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $total_amount, $type]);
    $order_id = $pdo->lastInsertId();

    // Insert order item
    $sql = "INSERT INTO order_items (order_id, product_id, course_id, quantity, price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$order_id, $product_id, $course_id, $quantity, $price]);

    $pdo->commit();

    // Redirect to payment page
    header("Location: ../../settings.php?section=payment&order_id=" . $order_id);
    exit;
} catch (PDOException $e) {
    $pdo->rollBack();
    die("❌ Error: " . $e->getMessage());
}
?>

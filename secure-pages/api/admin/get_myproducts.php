<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require '../config.php'; // Include database connection

session_start();

$user_id = $_SESSION['user_id'] ?? null;
$user_role = $_SESSION['role'] ?? 'user'; // Default to 'user' if not set

try {
     // ✅ Fetch products with category names
     $stmt = $pdo->prepare("
     SELECT o.order_id, o.user_id, o.order_date, o.total_amount, o.status AS order_status,
           p.product_id, p.name, p.description, p.price, p.stock_quantity,
           p.image_url, c.category_name
     FROM orders o
     JOIN order_items oi ON o.order_id = oi.order_id
     JOIN products p ON oi.product_id = p.product_id
     JOIN product_categories c ON p.category_id = c.product_category_id
     WHERE o.status = 'Delivered' AND o.user_id = ?
     ORDER BY o.order_date DESC
 ");
     $stmt->execute([$user_id]);
     $products = $stmt->fetchAll(PDO::FETCH_ASSOC);


    // ✅ Check if data exists
    if (empty($products)) {
        echo json_encode(["status" => "error", "message" => "No products found."]);
        exit;
    }

    echo json_encode(["status" => "success", "data" => $products]);
} catch (PDOException $e) {
    error_log("❌ Database error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    exit;
}
?>

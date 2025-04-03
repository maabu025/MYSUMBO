<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require '../config.php'; // Include database connection

try {
    // ✅ Fetch products with category names
    $stmt = $pdo->prepare("
        SELECT p.product_id, p.name, p.description, p.price, p.stock_quantity,
               p.image_url, c.category_name
        FROM products p
        JOIN product_categories c ON p.category_id = c.product_category_id
        ORDER BY p.product_id DESC
    ");
    $stmt->execute();
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

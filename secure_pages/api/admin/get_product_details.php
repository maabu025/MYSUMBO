<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require '../config.php'; // Include database connection

// ✅ Get product ID safely
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($product_id === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid Product ID"]);
    exit;
}

try {
    // ✅ Fetch product details
    $stmt = $pdo->prepare("
        SELECT p.product_id, p.name, p.description, p.price, p.image_url,
               cat.category_name
        FROM products p
        JOIN product_categories cat ON p.category_id = cat.product_category_id
        WHERE p.product_id = ?
    ");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo json_encode(["status" => "error", "message" => "❌ product not found"]);
        exit;
    }

    echo json_encode(["status" => "success", "data" => $product]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

require '../config.php'; // Include database connection

// Check if role is provided in the request
$cat = isset($_GET['getrole']) ? trim($_GET['getrole']) : '';

if (empty($cat)) {
    echo json_encode(["status" => "error", "message" => "Category option is required"]);
    exit;
}

try {
    if ($cat == "course") {
        // ✅ Fetch Course Categories
        $stmt = $pdo->prepare("SELECT course_category_id, category_name, description FROM course_categories ORDER BY course_category_id DESC");
    } elseif ($cat == "product") {
        // ✅ Fetch Product Categories
        $stmt = $pdo->prepare("SELECT product_category_id, category_name, description FROM product_categories ORDER BY product_category_id DESC");
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid category type"]);
        exit;
    }

    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["status" => "success", "data" => $categories]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>

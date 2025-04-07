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
           c.course_id, c.course_title, c.course_description, c.course_price, c.course_image_url,
           u.first_name, u.last_name, cat.category_name
    FROM orders o
    JOIN user_profiles u ON o.user_id = u.user_id
    JOIN order_items oi ON o.order_id = oi.order_id
    JOIN courses c ON oi.course_id = c.course_id
    JOIN course_categories cat ON c.course_category = cat.course_category_id
    WHERE o.status = 'Delivered' AND o.user_id = ?
    ORDER BY o.order_date DESC
");
    $stmt->execute([$user_id]);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ✅ Check if data exists
    if (empty($courses)) {
        echo json_encode(["status" => "error", "message" => "No Courses found."]);
        exit;
    }

    echo json_encode(["status" => "success", "data" => $courses]);
} catch (PDOException $e) {
    error_log("❌ Database error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    exit;
}
?>

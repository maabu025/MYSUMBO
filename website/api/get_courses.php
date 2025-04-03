<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


require 'config.php'; // Include database connection

try {
    // ✅ Fetch products with category names
    $stmt = $pdo->prepare("
        SELECT p.course_id, p.course_title, p.course_description, p.course_price,
               p.course_image_url, u.first_name, u.last_name, c.category_name
        FROM courses p
        JOIN user_profiles u ON p.instructor_id = u.user_id
        JOIN course_categories c ON p.course_category = c.course_category_id
        ORDER BY p.course_id DESC
    ");
    $stmt->execute();
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

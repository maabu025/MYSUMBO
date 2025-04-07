<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require '../config.php'; // Include database connection

// ✅ Get course ID safely
$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($course_id === 0) {
    echo json_encode(["status" => "error", "message" => "Invalid Course ID"]);
    exit;
}

try {
    // ✅ Fetch course details
    $stmt = $pdo->prepare("
        SELECT c.course_id, c.course_title, c.course_description, c.course_price, c.course_image_url,
               u.first_name, u.last_name, cat.category_name
        FROM courses c
        JOIN user_profiles u ON c.instructor_id = u.user_id
        JOIN course_categories cat ON c.course_category = cat.course_category_id
        WHERE c.course_id = ?
    ");
    $stmt->execute([$course_id]);
    $course = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$course) {
        echo json_encode(["status" => "error", "message" => "❌ Course not found"]);
        exit;
    }

    echo json_encode(["status" => "success", "data" => $course]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>

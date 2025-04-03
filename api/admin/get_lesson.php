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
    // ✅ Fetch course and lessons in a single JOIN query (without instructor details)
    $stmt = $pdo->prepare("
        SELECT 
            c.course_id, c.course_title, c.course_description, c.course_price, c.course_image_url,
            cat.category_name,
            l.lesson_id, l.title AS lesson_title, l.content AS lesson_content, l.video_url
        FROM courses c
        JOIN course_categories cat ON c.course_category = cat.course_category_id
        LEFT JOIN lessons l ON c.course_id = l.course_id  -- ✅ LEFT JOIN to include courses even if they have no lessons
        WHERE c.course_id = ?
        ORDER BY l.lesson_id ASC
    ");
    $stmt->execute([$course_id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows) {
        echo json_encode(["status" => "error", "message" => "❌ Course not found"]);
        exit;
    }

    // ✅ Structure response
    $courseData = [
        "course_id" => $rows[0]["course_id"],
        "course_title" => $rows[0]["course_title"],
        "course_description" => $rows[0]["course_description"],
        "course_price" => $rows[0]["course_price"],
        "course_image_url" => $rows[0]["course_image_url"],
        "category_name" => $rows[0]["category_name"],
        "lessons" => []
    ];

    // ✅ Add lessons (if available)
    foreach ($rows as $row) {
        if ($row["lesson_id"]) { // Only add if a lesson exists
            $courseData["lessons"][] = [
                "lesson_id" => $row["lesson_id"],
                "title" => $row["lesson_title"],
                "content" => $row["lesson_content"],
                "video_url" => $row["video_url"]
            ];
        }
    }

    echo json_encode(["status" => "success", "data" => $courseData]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>

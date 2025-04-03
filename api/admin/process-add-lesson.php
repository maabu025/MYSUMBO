<?php
include "../config.php";
session_start();

header("Content-Type: application/json");

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
    exit;
}

// Validate inputs
$course_id = $_POST['course_id'] ?? null;
$title = $_POST['title'] ?? null;
$content = $_POST['content'] ?? null;
$video_url = $_POST['video_url'] ?? null;

if (!$course_id || !$title || !$content) {
    echo json_encode(["status" => "error", "message" => "Please fill all required fields."]);
    exit;
}

try {
    // Insert lesson into the database
    $stmt = $pdo->prepare("INSERT INTO lessons (course_id, title, content, video_url) VALUES (?, ?, ?, ?)");
    $stmt->execute([$course_id, $title, $content, $video_url]);

    echo json_encode(["status" => "success", "message" => "Lesson added successfully!"]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>

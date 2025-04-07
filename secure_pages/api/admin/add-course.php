<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require '../config.php'; // Database connection

// Get form data
$course_name = $_POST['course_title'] ?? '';
$course_description = $_POST['course_description'] ?? '';
$category_id = $_POST['category_id'] ?? '';
$instructor_id = $_POST['instructor_id'] ?? '';
$course_price = $_POST['course_price'] ?? '';
$course_duration = $_POST['course_duration'] ?? ''; 
$course_level = $_POST['course_level'] ?? '';
$image = $_FILES['course_image']['name'] ?? '';

// Handle image upload
$imagePath = "";
if ($image) {
    $uploadDir = "../uploads/courses/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $imagePath = $uploadDir . basename($image);
    move_uploaded_file($_FILES['course_image']['tmp_name'], $imagePath);
}

try {
    $sql = "INSERT INTO courses (course_title, course_description, course_category, course_price, course_duration, course_level, course_image_url, instructor_id) 
            VALUES (:course_name, :course_description, :category_id, :course_price,  :course_duration, :course_level, :course_image, :instructor_id)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":course_name", $course_name);
    $stmt->bindParam(":course_description", $course_description);
    $stmt->bindParam(":category_id", $category_id);
    $stmt->bindParam(":course_price", $course_price);
    $stmt->bindParam(":course_duration", $course_duration);
    $stmt->bindParam(":course_level", $course_level);
    $stmt->bindParam(":course_image", $image);
    $stmt->bindParam(":instructor_id", $instructor_id);
 

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Course added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add course"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>

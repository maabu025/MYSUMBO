<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require '../config.php'; // Database connection
require '../vendor/autoload.php'; // Include JWT library

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// ✅ Get JWT token from headers
$headers = getallheaders();
if (!isset($headers["Authorization"])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized access"]);
    exit;
}

$secret_key = "=UZm~0g5osfR/)f"; // Secure this key
$token = str_replace("Bearer ", "", $headers["Authorization"]);

try {
    $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
    $user_id = $decoded->id;
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Invalid token"]);
    exit;
}

// ✅ Read JSON input
$data = json_decode(file_get_contents("php://input"));

if (!$data || empty($data->getrole) || empty($data->category_title) || empty($data->category_description)) {
    echo json_encode(["status" => "error", "message" => "All fields are required"]);
    exit;
}
$cat = trim($data->getrole);
$category_title = trim($data->category_title);
$category_description = trim($data->category_description);


if ($cat == "course") {
// ✅ Check if the category already exists

try {
    $stmt = $pdo->prepare("SELECT course_category_id FROM course_categories WHERE category_name = ?");
    $stmt->execute([$category_title]);
    
    if ($stmt->fetch()) {
        echo json_encode(["status" => "error", "message" => "Category already exists"]);
        exit;
    }

    // ✅ Insert into database
    $stmt = $pdo->prepare("INSERT INTO course_categories (category_name, description) VALUES (?, ?)");
    if ($stmt->execute([$category_title, $category_description])) {
        echo json_encode(["status" => "success", "message" => "Category added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error, please try again"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
} elseif ($cat == "product") {
    // ✅ Check if the category already exists
    try {
        $stmt = $pdo->prepare("SELECT product_category_id FROM product_categories WHERE category_name = ?");
        $stmt->execute([$category_title]);
        
        if ($stmt->fetch()) {
            echo json_encode(["status" => "error", "message" => "Category already exists"]);
            exit;
        }
    
        // ✅ Insert into database
        $stmt = $pdo->prepare("INSERT INTO product_categories (category_name, description) VALUES (?, ?)");
        if ($stmt->execute([$category_title, $category_description])) {
            echo json_encode(["status" => "success", "message" => "Category added successfully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Database error, please try again"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }
}
?>

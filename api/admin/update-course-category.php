<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Authorization, Content-Type");

require '../config.php'; // ✅ Database connection
require '../vendor/autoload.php'; // ✅ Include JWT

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// ✅ Get JWT Token from Headers
$headers = getallheaders();
$token = isset($headers["Authorization"]) ? str_replace("Bearer ", "", $headers["Authorization"]) : "";

// ✅ Get Raw JSON Data
$data = json_decode(file_get_contents("php://input"), true);

// ✅ Validate Request Data
if (!$token || !isset($data["category_id"], $data["getrole"], $data["category_title"], $data["category_description"])) {
    echo json_encode(["status" => "error", "message" => "Invalid request. Missing parameters."]);
    exit;
}

$secret_key = "=UZm~0g5osfR/)f"; // ✅ Replace with your JWT secret key

try {
    $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
    $decoded_array = (array) $decoded; // Convert to associative array

    if (!isset($decoded_array["id"])) {
        echo json_encode(["status" => "error", "message" => "Invalid token: Missing user_id"]);
        exit;
    }

    $user_id = $decoded_array["id"]; // ✅ Now safely extract user_id
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Invalid token: " . $e->getMessage()]);
    exit;
}

// ✅ Extract Category Data
$category_id = intval($data["category_id"]);
$cat = trim($data["getrole"]);
$category_title = trim($data["category_title"]);
$category_description = trim($data["category_description"]);

// ✅ Ensure Fields Are Not Empty
if (empty($category_title) || empty($category_description)) {
    echo json_encode(["status" => "error", "message" => "Title and description are required"]);
    exit;
}

if ($cat == "course") {
try {
    // ✅ Check if Category Exists
    $stmt = $pdo->prepare("SELECT course_category_id FROM course_categories WHERE course_category_id = ?");
    $stmt->execute([$category_id]);
    if ($stmt->rowCount() === 0) {
        echo json_encode(["status" => "error", "message" => "Category not found"]);
        exit;
    }

    // ✅ Update Category
    $stmt = $pdo->prepare("UPDATE course_categories SET category_name = ?, description = ? WHERE course_category_id = ?");
    $stmt->execute([$category_title, $category_description, $category_id]);

    echo json_encode(["status" => "success", "message" => "Category updated successfully"]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
} elseif ($cat == "product") {
    try {
        // ✅ Check if Category Exists
        $stmt = $pdo->prepare("SELECT product_category_id FROM product_categories WHERE product_category_id = ?");
        $stmt->execute([$category_id]);
        if ($stmt->rowCount() === 0) {
            echo json_encode(["status" => "error", "message" => "Category not found"]);
            exit;
        }

        // ✅ Update Category
        $stmt = $pdo->prepare("UPDATE product_categories SET category_name = ?, description = ? WHERE product_category_id = ?");
        $stmt->execute([$category_title, $category_description, $category_id]);

        echo json_encode(["status" => "success", "message" => "Category updated successfully"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }
}
?>

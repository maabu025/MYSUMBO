<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Authorization, Content-Type");

require '../config.php';
require '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$headers = getallheaders();
$token = isset($headers["Authorization"]) ? str_replace("Bearer ", "", $headers["Authorization"]) : "";

$category_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$cat = trim($_GET["getrole"]);

if (!$token || !$category_id || empty($cat)) {
    echo json_encode(["status" => "error", "message" => "Unauthorized or invalid request"]);
    exit;
}

$secret_key = "=UZm~0g5osfR/)f";

try {
    $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Invalid token"]);
    exit;
}

if ($cat == "course") {

$stmt = $pdo->prepare("SELECT course_category_id, category_name, description FROM course_categories WHERE course_category_id = ?");
$stmt->execute([$category_id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if ($category) {
    echo json_encode(["status" => "success", "data" => $category]);
} else {
    echo json_encode(["status" => "error", "message" => "Category not found"]);
}
} elseif ($cat == "product") {
    $stmt = $pdo->prepare("SELECT product_category_id, category_name, description FROM product_categories WHERE product_category_id = ?");
    $stmt->execute([$category_id]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($category) {
        echo json_encode(["status" => "success", "data" => $category]);
    } else {
        echo json_encode(["status" => "error", "message" => "Category not found"]);
    }
}
?>

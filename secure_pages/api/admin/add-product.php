<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require '../config.php'; // Database connection

// Get form data
$product_name = $_POST['product_name'] ?? '';
$product_description = $_POST['product_description'] ?? '';
$category_id = $_POST['category_id'] ?? '';
$product_price= $_POST['product_price'] ?? '';
$stock_quantity = $_POST['stock_quantity'] ?? '';
$image = $_FILES['product_image']['name'] ?? '';

// Handle image upload
$imagePath = "";
if ($image) {
    $uploadDir = "../uploads/products/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $imagePath = $uploadDir . basename($image);
    move_uploaded_file($_FILES['product_image']['tmp_name'], $imagePath);
}

try {
    $sql = "INSERT INTO products (name, description, category_id, price, stock_quantity, image_url) 
            VALUES (:product_name, :product_description, :category_id, :product_price,  :stock_quantity, :course_image)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":product_name", $product_name);
    $stmt->bindParam(":product_description", $product_description);
    $stmt->bindParam(":category_id", $category_id);
    $stmt->bindParam(":product_price", $product_price);
    $stmt->bindParam(":stock_quantity", $stock_quantity);
    $stmt->bindParam(":course_image", $image);
 

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Product added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add Product"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>

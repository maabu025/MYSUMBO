<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require '../config.php'; // Database connection

// Get Form Data
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$role = $_POST['role'] ?? 'trainer'; // Default role

$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$phone = $_POST['phone'] ?? '';
$address = $_POST['address'] ?? '';
$image = $_FILES['upload_image']['name'] ?? '';

// Handle Image Upload
// Define the upload directory
$uploadDir = "../uploads/users/";

// Check if the directory exists, if not, create it
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Create directory with full permissions
}

// Handle Image Upload
$imagePath = "";
if (!empty($_FILES['upload_image']['name'])) {
    $imagePath = $uploadDir . basename($_FILES['upload_image']['name']);
    
    if (!move_uploaded_file($_FILES['upload_image']['tmp_name'], $imagePath)) {
        die(json_encode(["status" => "error", "message" => "File upload failed"]));
    }
}

// Start Transaction
$pdo->beginTransaction();

try {
    // Step 1: Insert into `users` table
    $sqlUser = "INSERT INTO users (username, email, password_hash, role) 
                VALUES (:username, :email, :password, :role)";
    $stmtUser = $pdo->prepare($sqlUser);
    $stmtUser->bindParam(":username", $username);
    $stmtUser->bindParam(":email", $email);
    $stmtUser->bindParam(":password", $password);
    $stmtUser->bindParam(":role", $role);

    if (!$stmtUser->execute()) {
        throw new Exception("Error inserting into users table.");
    }

    // Get the last inserted user_id
    $user_id = $pdo->lastInsertId();

    // Step 2: Insert into `user_profile` table
    $sqlProfile = "INSERT INTO user_profiles (user_id, first_name, last_name, phone, address, profile_picture) 
                   VALUES (:user_id, :first_name, :last_name, :phone, :address, :image)";
    $stmtProfile = $pdo->prepare($sqlProfile);
    $stmtProfile->bindParam(":user_id", $user_id);
    $stmtProfile->bindParam(":first_name", $first_name);
    $stmtProfile->bindParam(":last_name", $last_name);
    $stmtProfile->bindParam(":phone", $phone);
    $stmtProfile->bindParam(":address", $address);
    $stmtProfile->bindParam(":image", $image);

    if (!$stmtProfile->execute()) {
        throw new Exception("Error inserting into user_profile table.");
    }

    // Commit transaction
    $pdo->commit();

    echo json_encode(["status" => "success", "message" => "User added successfully"]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>

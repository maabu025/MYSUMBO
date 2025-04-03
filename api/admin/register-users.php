<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

require '../config.php';
require '../vendor/autoload.php'; // Include JWT library

use Firebase\JWT\JWT;

$secret_key = "=UZm~0g5osfR/)f"; // Store securely

// Get raw JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || empty($data['username']) || empty($data['email']) || empty($data['password']) || empty($data['role'])) {
    echo json_encode(["status" => "error", "message" => "All fields are required"]);
    exit;
}

$username = trim($data['username']);
$email = trim($data['email']);
$password = trim($data['password']);
$role = trim($data['role']); // Role: admin, staff, or customer

try {
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(["status" => "error", "message" => "Email already registered"]);
        exit;
    }

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$username, $email, $passwordHash, $role])) {
        $user_id = $pdo->lastInsertId();

        // Create JWT token
        $payload = [
            "id" => $user_id,
            "username" => $username,
            "role" => $role,
            "exp" => time() + 3600
        ];
        $jwt = JWT::encode($payload, $secret_key, 'HS256');

        echo json_encode(["status" => "success", "message" => "User registered successfully", "token" => $jwt]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error registering user"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>

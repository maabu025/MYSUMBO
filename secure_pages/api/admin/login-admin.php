<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require '../config.php';
require '../vendor/autoload.php'; // Ensure JWT library is loaded

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secret_key = "=UZm~0g5osfR/)f"; // Change to a secure secret key

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

// Read JSON input
$data = json_decode(file_get_contents("php://input"));

if (!$data || empty($data->email) || empty($data->password)) {
    echo json_encode(["status" => "error", "message" => "Email and password are required"]);
    exit;
}

$email = trim($data->email);
$password = trim($data->password);

try {
    $stmt = $pdo->prepare("SELECT id, username, password_hash, role FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(["status" => "error", "message" => "User not found"]);
        exit;
    }

    if (!password_verify($password, $user['password_hash'])) {
        echo json_encode(["status" => "error", "message" => "Incorrect password"]);
        exit;
    }

    // ✅ Start the session & store user details
    session_start();
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["role"] = $user["role"]; // Store user role for access control

    // Generate JWT token
    $payload = [
        "id" => $user["id"],
        "username" => $user["username"],
        "role" => $user["role"],
        "exp" => time() + (60 * 60 * 24) // 🔥 1 day expiration (adjust as needed)
    ];
    $jwt = JWT::encode($payload, $secret_key, 'HS256');

    echo json_encode(["status" => "success", "message" => "Login successful", "token" => $jwt]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>

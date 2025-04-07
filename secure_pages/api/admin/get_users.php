<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require '../config.php'; // Database connection

// Check if role is provided in the request
$role = isset($_GET['getrole']) ? trim($_GET['getrole']) : '';

if (empty($role)) {
    echo json_encode(["status" => "error", "message" => "Role is required"]);
    exit;
}

try {
    // SQL Query to get users based on role
    $sql = "SELECT users.id AS user_id, users.username, users.email, users.role,
                   user_profiles.first_name, user_profiles.last_name, 
                   user_profiles.phone, user_profiles.address, user_profiles.profile_picture
            FROM users 
            LEFT JOIN user_profiles ON users.id = user_profiles.user_id
            WHERE users.role = :role";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":role", $role);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($users) > 0) {
        echo json_encode(["status" => "success", "data" => $users]);
    } else {
        echo json_encode(["status" => "error", "message" => "No users found for role: $role"]);
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>

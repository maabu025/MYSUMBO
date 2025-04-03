<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

session_start();
session_destroy(); // ✅ Destroy the session

echo json_encode(["status" => "success", "message" => "Logged out successfully"]);
?>

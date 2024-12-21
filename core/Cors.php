<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cache-Control");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Phản hồi OK cho preflight
    http_response_code(200);
    exit();
}

?>
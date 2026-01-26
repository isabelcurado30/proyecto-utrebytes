<?php

// Configuración de cabeceras.
header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
header ("Access-Control-Allow-Headers: Content-Type");
header ("Content-Type: application/json; charset = UTF-8");

// Para evitar problemas con preflight (CORS).
if ($_SERVER ['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code (200);
    exit;
}

// Configuración de la base de datos.
$host = "localhost";
$dbname = "utrebytes"; 
$user = "root";
$password = "";

// Conexión PDO.
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO ($dsn, $user, $password, [
        PDO:: ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION,
        PDO:: ATTR_DEFAULT_FETCH_MODE => PDO:: FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    http_response_code (500);
    echo json_encode ([
        "success" => false,
        "message" => "Error de conexión a la base de datos.",
        "error" => $e -> getMessage()
    ]);
    exit;
}






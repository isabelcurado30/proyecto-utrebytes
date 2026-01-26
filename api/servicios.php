<?php
require_once 'config.php';

// Solo permitir el método GET.
if ($_SERVER ['REQUEST_METHOD'] !== 'GET') {
    http_response_code (405);
    echo json_encode ([
        "success" => false,
        "message" => "Método no permitido."
    ]);
    exit;
}

try {
    $stmt = $pdo -> prepare ("SELECT * FROM servicios");
    $stmt -> execute();
    $servicios = $stmt -> fetchAll();

    http_response_code (200);
    echo json_encode ($servicios);
} catch (PDOException $e) {
    http_response_code (500);
    echo json_encode ([
        "success" => false,
        "message" => "Error al obtener los servicios.",
        "error" => $e -> getMessage()
    ]);
}
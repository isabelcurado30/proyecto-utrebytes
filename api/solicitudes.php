<?php
require_once 'config.php';

// GET solicitudes (listado).
if ($_SERVER ['REQUEST_METHOD'] === 'GET') {
    try {
        $sql = "SELECT
                    s.id,
                    sv.nombre AS servicio_nombre,
                    s.empresa,
                    s.email,
                    s.telefono,
                    s.descripcion,
                    s.prioridad,
                    s.estado,
                    s.fecha_solicitud
                FROM solicitudes s
                JOIN servicios sv ON s.servicio_id = sv.id
                ORDER BY s.fecha_solicitud DESC";

        $stmt = $pdo -> prepare ($sql);
        $stmt -> execute();
        $solicitudes = $stmt -> fetchAll();

        http_response_code (200);
        echo json_encode ($solicitudes);
        exit;
    } catch (PDOException $e) {
        http_response_code (500);
        echo json_encode ([
            "success" => false,
            "message" => "Error al obtener las solicitudes.",
            "error" => $e -> getMessage()
        ]);
        exit;
    }
}

// PUT para actualizar el estado de la solicitud.
if ($_SERVER ['REQUEST_METHOD'] === 'PUT') {

    if (!isset ($_GET ['id'])) {
        http_response_code (400);
        echo json_encode ([
            "success" => false,
            "message" => "ID de solicitud requerido."
        ]);
        exit;
    }

    $id = $_GET ['id'];
    $data = json_decode (file_get_contents ("php://input"), true);

    if (empty ($data ['estado'])) {
        http_response_code (400);
        echo json_encode ([
            "success" => false,
            "message" => "El nuevo estado es obligatorio."
        ]);
        exit;
    }

    try {
        $stmt = $pdo -> prepare (
            "UPDATE solicitudes SET estado = :estado WHERE id = :id"
        );
        $stmt -> execute ([
            ':estado' => $data ['estado'],
            ':id' => $id
        ]);

        http_response_code (200);
        echo json_encode ([
            "success" => true,
            "message" => "Estado actualizado correctamente."
        ]);
    } catch (PDOException $e) {
        http_response_code (500);
        echo json_encode ([
            "success" => false,
            "message" => "Error al actualizar el estado.",
            "error" => $e -> getMessage()
        ]);
    }
    exit;
}
// Solo permitir el método POST.
if ($_SERVER ['REQUEST_METHOD'] !== 'POST') {
    http_response_code (405);
    echo json_encode ([
        "success" => false,
        "message" => "Método no permitido."
    ]);
    exit;
}

// Leer JSON del body.
$data = json_decode (file_get_contents ("php://input"), true);

// Validación básica.
$required = ['servicio_id', 'empresa', 'email', 'telefono', 'descripcion', 'prioridad'];

foreach ($required as $field) {
    if (empty ($data [$field])) {
        http_response_code (400);
        echo json_encode ([
            "success" => false,
            "message" => "El campo '$field' es obligatorio."
        ]);
        exit;
    }
}

try {
    $sql = "INSERT INTO solicitudes
            (servicio_id, empresa, email, telefono, descripcion, prioridad)
            VALUES
            (:servicio_id, :empresa, :email, :telefono, :descripcion, :prioridad)";

    $stmt = $pdo -> prepare ($sql);
    $stmt -> execute ([
        ':servicio_id' => $data ['servicio_id'],
        ':empresa' => $data ['empresa'],
        ':email' => $data ['email'],
        ':telefono' => $data ['telefono'],
        ':descripcion' => $data ['descripcion'],
        ':prioridad' => $data ['prioridad']
    ]);

    http_response_code (201);
    echo json_encode ([
        "success" => true,
        "message" => "Solicitud creada correctamente.",
        "id" => $pdo -> lastInsertId()
    ]);
} catch (PDOException $e) {
    http_response_code (500);
    echo json_encode ([
        "success" => false,
        "message" => "Error al crear la solicitud.",
        "error" => $e -> getMessage()    
    ]);
}
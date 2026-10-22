<?php
require_once __DIR__ . '/includes/auth.php';
requireLogin();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/repos/MaterialRepo.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = (int)($_POST['material_id'] ?? 0);
$usuarioId = currentUser()['id'];

if ($id <= 0) {
    http_response_code(400);
    exit('Material no válido');
}

$repo = new MaterialRepo();
$material = $repo->findById($id);

if (!$material) {
    http_response_code(404);
    exit('Material no encontrado');
}

// Comprobar que el usuario tiene ese material prestado y todavía sin devolver
$stmt = db()->prepare(
    'SELECT id
     FROM prestamos
     WHERE material_id = ?
       AND usuario_id = ?
       AND fecha_devolucion IS NULL
     LIMIT 1'
);
$stmt->execute([$id, $usuarioId]);

if (!$stmt->fetch()) {
    http_response_code(400);
    exit('No tienes este material prestado');
}

// Marcar la devolución
$stmt = db()->prepare(
    'UPDATE prestamos
     SET fecha_devolucion = NOW()
     WHERE material_id = ?
       AND usuario_id = ?
       AND fecha_devolucion IS NULL'
);
$stmt->execute([$id, $usuarioId]);

// Marcar el material como disponible
$repo->setDisponible($id, true);

// Opcional: dejar constancia en el log del material
$material->log("Devolución de '{$material->getTitulo()}' por " . currentUser()['email']);

header('Location: material.php?id=' . $id);
exit;
<?php
declare(strict_types=1);

use App\Exceptions\MaterialNoEncontradoException;

set_exception_handler(function (Throwable $e): void {
    // Loguea el detalle (para el desarrollador)
    error_log('Excepción no capturada: ' . $e->getMessage());
    error_log($e->getTraceAsString());

    // Decide el código HTTP
    http_response_code(
        $e instanceof MaterialNoEncontradoException ? 404 : 500
    );

    // Muestra un mensaje genérico al usuario
    require __DIR__ . '/header.php';
    echo '<h1>Algo ha ido mal</h1>';
    echo '<p>Inténtalo de nuevo más tarde.</p>';
    require __DIR__ . '/footer.php';
    exit;
});
<?php
declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

class LimitePrestamosException extends RuntimeException
{
    public function __construct(int $usuarioId, int $limite)
    {
        parent::__construct(
            "El usuario {$usuarioId} ya tiene {$limite} préstamos activos (máximo permitido)"
        );
    }
}
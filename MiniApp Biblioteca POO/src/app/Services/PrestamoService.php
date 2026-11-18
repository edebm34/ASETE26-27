<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\MaterialNoDisponibleException;
use App\Exceptions\LimitePrestamosException;
use App\Repos\MaterialRepo;

class PrestamoService
{
    private const MAX_PRESTAMOS_ACTIVOS = 3;
    
    public function __construct(private MaterialRepo $repo) {}

    /**
     * Intenta prestar un material a un usuario.
     *
     * @throws MaterialNoDisponibleException si el material ya está prestado
     * @throws \App\Exceptions\MaterialNoEncontradoException si el id no existe
     */
    public function prestar(int $materialId, int $usuarioId): void
{
    $material = $this->repo->findById($materialId);

    try {
        if (!$material->isDisponible()) {
            throw new MaterialNoDisponibleException($material->getTitulo());
        }

        if ($this->repo->contarPrestamosActivos($usuarioId) >= self::MAX_PRESTAMOS_ACTIVOS) {
            throw new LimitePrestamosException($usuarioId, self::MAX_PRESTAMOS_ACTIVOS);
        }
        
        $material->prestar();
        $this->repo->setDisponible($materialId, false);
        $this->repo->registrarPrestamo($materialId, $usuarioId);
    } finally {
        // Se ejecuta SIEMPRE, haya excepción o no
        $material->log(
            "Intento de préstamo de '{$material->getTitulo()}' al usuario {$usuarioId}"
        );
    }
}
}
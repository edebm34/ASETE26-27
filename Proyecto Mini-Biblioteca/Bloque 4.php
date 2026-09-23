<?php
    /*
    * Al final la extensión Five Server es incapaz de ejecutar esto correctamente
    * pero levantando un server de desarrollo PHP dedicado con php -S localhost:8000
    * en la consola funciona sin problemas.
    */

    session_start();

    if (!isset($_SESSION['libros'])) {
        $_SESSION['libros'] = [
            ["id" => 0, "titulo" => "El Quijote", "autor" => "Miguel de Cervantes", "anio" => 1605, "disponible" => true, "genero" => "novela"],
            ["id" => 1, "titulo" => "Dune", "autor" => "Frank Herbert", "anio" => 1965, "disponible" => false, "genero" => "ciencia ficción"],
            ["id" => 2, "titulo" => "Sapiens", "autor" => "Yuval Noah Harari", "anio" => 2011, "disponible" => true, "genero" => "ensayo"]
        ];
    }

    $accion = $_GET["accion"] ?? null;
    $id = $_GET["id"] ?? null;

    $filtro = $_GET['filtro'] ?? '1';

    if (isset($id) && isset($accion)) {
        $_SESSION['libros'] = cambiarEstadoLibro($_SESSION['libros'], $id, $accion);
    }

    $libros = $_SESSION['libros'];

    function mostrarLibros($libros) {
        foreach($libros as $libro) {
            echo "<h2>" . $libro['titulo'] . "</h2>";
            echo "<p><i>" . $libro['autor'] . "</i></p>";
            echo "<p>" . $libro['anio'] . "</p>";
            echo '<p>'; echo $libro['disponible'] ? "✅ Disponible" : "❌ Prestado"; echo '</p>';
        }
    }

    function filtrarPorGenero($libros, $genero) {
        
        $resultado = [];
        
        foreach ($libros as $libro) {
            if ($libro['genero'] == $genero) {
                array_push($resultado, $libro);
            }
        }

        return $resultado;
    }

    function filtrarPorDisponibilidad($libros, $disponibilidad) {
        
        $resultado = [];
        
        foreach ($libros as $libro) {
            if ($libro['disponible'] == $disponibilidad) {
                array_push($resultado, $libro);
            }
        }

        return $resultado;
    }

    function cambiarEstadoLibro($libros, $id, $accion) {
        foreach($libros as &$libro) {
            if ($libro['id'] == $id) {
                $libro['disponible'] = ($accion != "prestar");
            }
        }

        return $libros;
    }
?>

<!DOCTYPE html>
<html>
    <h1>Mi biblioteca</h1>
    <hr>
    <h2>Todos los libros</h2>
    <?php mostrarLibros($libros) ?>
    <hr>
    <h2>Novelas</h2>
    <?php mostrarLibros(filtrarPorGenero($libros, "novela")) ?>
    <hr>
    <h2>Ciencia ficción</h2>
    <?php mostrarLibros(filtrarPorGenero($libros, "ciencia ficción")) ?>
    <hr>
    <h2>Filtro personalizado</h2>
    <form method="GET">
        <select name="filtro">
            <option value="1" <?= $filtro === '1' ? 'selected' : ''?>>Solo disponibles</option>
            <option value="0" <?= $filtro === '0' ? 'selected' : ''?>>Solo prestados</option>
        </select>
        <button>Filtrar</button>
    </form>
    <?php 
        if (isset($_GET['filtro'])) {
            mostrarLibros(filtrarPorDisponibilidad($libros, $_GET['filtro'] === '1'));
        }
    ?>
    <hr>
    <p><i>Total: <?=count($libros)?> libros</i></p>
    <hr>
    <h2>Prestamo por ID</h2>
    <form method="GET">
        <input type="number" name="id" placeholder="ID del libro" required min="0">
        <select name="accion">
            <option value="prestar">Prestar</option>
            <option value="devolver">Devolver</option>
        </select>
        <button>Enviar</button>
    </form>
</html>
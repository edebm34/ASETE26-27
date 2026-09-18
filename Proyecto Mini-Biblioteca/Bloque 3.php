<?php
    $libros = [
        ["titulo" => "El Quijote", "autor" => "Miguel de Cervantes", "anio" => 1605, "disponible" => true, "genero" => "novela"],
        ["titulo" => "Dune", "autor" => "Frank Herbert", "anio" => 1965, "disponible" => false, "genero" => "ciencia ficción"],
        ["titulo" => "Sapiens", "autor" => "Yuval Noah Harari", "anio" => 2011, "disponible" => true, "genero" => "ensayo"]
    ];

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
    <p><i>Total: <?=count($libros)?> libros</i></p>
</html>
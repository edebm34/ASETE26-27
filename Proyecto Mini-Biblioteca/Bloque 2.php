<?php
    $libros = [
        ["titulo" => "El Quijote", "autor" => "Miguel de Cervantes", "anio" => 1605, "disponible" => true],
        ["titulo" => "Dune", "autor" => "Frank Herbert", "anio" => 1965, "disponible" => false],
        ["titulo" => "Sapiens", "autor" => "Yuval Noah Harari", "anio" => 2011, "disponible" => true]
    ];
?>

<!DOCTYPE html>
<html>
    <h1>Mi biblioteca</h1>
    <?php foreach($libros as $libro):?>
        <h2><?=$libro['titulo']?></h2>
        <p><i><?=$libro['autor']?></i></p>
        <p><?=$libro['anio']?></p>
        <p><?=$libro['disponible'] ? "✅ Disponible" : "❌ Prestado"?></p>
    <?php endforeach; ?>
    <p><i>Total: <?=count($libros)?> libros</i></p>
</html>
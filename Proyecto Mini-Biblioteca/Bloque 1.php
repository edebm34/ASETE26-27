<?php
    $libro = [
        "titulo" => "El Quijote",
        "autor" => "Miguel de Cervantes",
        "anio" => 1605,
        "disponible" => true
    ];
?>

<!DOCTYPE html>
<html>
<h2><?=$libro['titulo']?></h2>
<p><i><?=$libro['autor']?></i></p>
<p><?=$libro['anio']?></p>
<p><?=$libro['disponible'] ? "✅ Disponible" : "❌ Prestado"?></p>
</html>
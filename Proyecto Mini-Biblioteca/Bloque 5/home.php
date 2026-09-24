<?php
    session_start();

    $login = $_GET['login'] ?? false;

    if (!$login) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
</head>
<body>
    <?php
        if($login) {
            echo "<h2>¡Bienvenido " . $_SESSION['usuario'] . "!" . "</h2>";
        }
    ?>
</body>
</html>
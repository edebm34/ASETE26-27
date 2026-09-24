<?php
    session_start();

    $loginError = false;

    $usuarios = [
        'paquitoelpanadero@hotmail.com' => 'vivaelvino123',
        'jinchocolate22@gmail.com' => 'perico221',
        'pondollo67@live.com' => 'unvideoma67'
    ];

    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        if (isset($usuarios[$correo]) && hash_equals($usuarios[$correo], $contraseña)) {
            $loginError = false;
            $_SESSION['usuario'] = strstr($correo, '@', true);
            header('Location: home.php?login=true');
        } else {
            $loginError = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="" method="post">
        <label for="correo">Correo electrónico:</label> <br>
        <input type="email" name="correo" id="correo"> <br>
        <label for="contraseña">Contraseña:</label> <br>
        <input type="password" name="contraseña" id="contraseña"> <br>
        <input type="submit" value="Iniciar sesión">
    </form>
    <?php 
        if ($loginError) {
            echo "<h3>Los datos introducidos no son correctos</h3>";
        }
    ?>
</body>
</html>
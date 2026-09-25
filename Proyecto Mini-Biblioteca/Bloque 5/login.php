<?php
session_start();

$loginError = false;

$usuarios = [
    [
        "correo" => "paquitoelpanadero@hotmail.com",
        "contraseña" => "vivaelvino123",
        "admin" => false
    ],
    [
        "correo" => "jinchocolate22@gmail.com",
        "contraseña" => "perico221",
        "admin" => true
    ],
    [
        "correo" => "pondollo67@live.com",
        "contraseña" => "unvideoma67",
        "admin" => false
    ]
];

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    foreach ($usuarios as $usuario) {
        if (
            $usuario['correo'] === $correo &&
            hash_equals($usuario['contraseña'], $contraseña)
        ) {
            $loginError = false;

            $_SESSION['usuario'] = strstr($correo, '@', true);
            $_SESSION['admin'] = $usuario['admin'];

            header('Location: catalogo.php?login=true');
            exit;
        }
    }

    $loginError = true;
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

        <label for="correo">Correo electrónico:</label><br>
        <input type="email" name="correo" id="correo" required><br>

        <label for="contraseña">Contraseña:</label><br>
        <input type="password" name="contraseña" id="contraseña" required><br>

        <input type="submit" value="Iniciar sesión">

    </form>

    <?php
    if ($loginError) {
        echo "<h3>Los datos introducidos no son correctos</h3>";
    }
    ?>

</body>
</html>

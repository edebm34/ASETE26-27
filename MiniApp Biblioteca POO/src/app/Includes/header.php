<?php require_once __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>MiniApp Biblioteca POO</title>
</head>
<body>
<nav>
  <?php if (currentUser()): ?>
    <a href="/index.php">Catálogo</a>
    <?php if (currentUser()['rol'] === 'admin'): ?>
      | <a href="/admin.php">Panel admin</a>
    <?php endif; ?>
    | <span><?= htmlspecialchars(currentUser()['email']) ?></span>
    | <a href="/logout.php">Salir</a>
  <?php else: ?>
    <a href="/login.php">Entrar</a>
  <?php endif; ?>
</nav>
<main>
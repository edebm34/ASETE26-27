<?php
require_once __DIR__ . '/Includes/auth.php';
requireLogin();
require_once __DIR__ . '/Repos/MaterialRepo.php';

$repo = new MaterialRepo();
$materiales = $repo->findAll();

require __DIR__ . '/Includes/header.php';
?>
<h1>Catálogo de la biblioteca</h1>

<ul>
<?php foreach ($materiales as $m): ?>
  <li>
    <?= htmlspecialchars($m->mostrarFicha()) ?>
    — <?= $m->isDisponible() ? '✅ Disponible' : '❌ Prestado' ?>
    <?php if ($m->isDisponible()): ?>
      · <a href="/material.php?id=<?= $m->getId() ?>">Ver ficha</a>
    <?php endif; ?>
  </li>
<?php endforeach; ?>
</ul>

<?php require __DIR__ . '/Includes/footer.php'; ?>

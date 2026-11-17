<?php
require_once __DIR__ . '/../app/Includes/auth.php';
logout();
header('Location: login.php');
exit;

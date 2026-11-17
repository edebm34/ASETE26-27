<?php
require_once __DIR__ . '/Includes/auth.php';
logout();
header('Location: login.php');
exit;
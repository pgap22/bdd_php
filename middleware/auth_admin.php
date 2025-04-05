<?php
// auth_admin.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo "Acceso denegado. Solo para administradores.";
    exit;
}

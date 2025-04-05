<?php
// auth.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    // No está autenticado, redirigir al login
    header('Location: /');
    exit;
}
?>

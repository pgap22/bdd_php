<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';

class LoginController
{
    private $usuario;

    public function __construct(PDO $db)
    {
        $this->usuario = new Usuario($db);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login($email, $password)
    {
        $user = $this->usuario->obtenerPorEmail($email);

        if (!$user) {
            return [
                "success" => false,
                "message" => "Usuario no encontrado o inactivo"
            ];
        }

        $hashedInputPassword = hash('sha256', $password);

        if (strtolower($hashedInputPassword) === strtolower($user['password'])) {
            // Guardar en sesión
            $_SESSION['usuario'] = [
                "id_usuario" => $user['id_usuario'],
                "nombre" => $user['nombre'],
                "apellido" => $user['apellido'],
                "email" => $user['email'],
                "rol" => $user['rol']
            ];

            header('Location: /admin/index.php');
        } else {
            return [
                "success" => false,
                "message" => "Contraseña incorrecta"
            ];
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        
        header("Location: /");
    }

    public function getUsuarioActual()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['usuario'] ?? null;
    }
}

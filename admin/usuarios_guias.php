<?php
// usuarios_guias.php (Controller - Modified to use SHA-256 hashing)
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT'] . "/models/Conexion.php";
$db = Conexion::getInstance();

$activeNav = 'usuarios_guias';

$usuarioGuia = [];

if (isset($_GET['id_usuario'])) {
    $usuarioGuia = $db->queryOne("SELECT id_usuario, nombre, apellido, email, password FROM Usuario WHERE id_usuario = :id AND rol = 'guia'", [
        "id" => $_GET['id_usuario']
    ]);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nombre = htmlentities($_POST['nombre']);
    $apellido = htmlentities($_POST['apellido']);
    $email = htmlentities($_POST['email']);
    $password = $_POST['password'] ?? null; // Get password for edit, if provided
    $id_usuario = htmlentities($_POST['id_usuario'] ?? null);

    $errors = [];

    if (!$nombre) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta el campo nombre"
        ];
    }

    if (!$apellido) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta el campo apellido"
        ];
    }

    if (!$email) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta el campo email"
        ];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "El formato del email no es válido"
        ];
    }

    if (empty($errors)) {
        if ($id_usuario) {
            // Handle update, hash password only if a new one is provided
            $updateData = [
                "nombre" => $nombre,
                "apellido" => $apellido,
                "email" => $email,
                "id_usuario" => $id_usuario
            ];
            if ($password) {
                $hashedPassword = hash('sha256', $password);
                $updateData['password'] = $hashedPassword;
            }
            $setClause = "nombre = :nombre, apellido = :apellido, email = :email";
            if (isset($updateData['password'])) {
                $setClause .= ", password = :password";
            }
            $db->query("UPDATE Usuario SET $setClause WHERE id_usuario = :id_usuario", $updateData);
            $succesMessage = "El usuario guía ha sido actualizado con éxito";
            header("location: /admin/usuarios_guias.php?message=$succesMessage");
        } else {
            $defaultPassword = 'cambiarPassword';
            $hashedPassword = hash('sha256', $defaultPassword);

            try {
                $db->query("INSERT INTO Usuario(nombre, apellido, email, password, rol) VALUES(:nombre, :apellido, :email, :password, 'guia')", [
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "email" => $email,
                    "password" => $hashedPassword
                ]);
                $succesMessage = "El usuario guía ha sido agregado con éxito. La contraseña predeterminada es: cambiarPassword";
                header("location: /admin/usuarios_guias.php?message=$succesMessage");
            } catch (\PDOException $e) {
                if ($e->getCode() === '23000') { // Error de clave única (email duplicado)
                    $errors[] = [
                        "titulo" => "Error",
                        "descripcion" => "El email ya está registrado"
                    ];
                } else {
                    throw $e; // Re-lanzar otros errores
                }
            }
        }
    }

    if (!empty($errors)) {
        $errorString = implode("<br>", array_column($errors, 'descripcion'));
        header("location: /admin/usuarios_guias.php?error=$errorString");
    }
}

$usuariosGuias = $db->query("SELECT id_usuario, nombre, apellido, email FROM Usuario WHERE rol = 'guia'");

if (isset($_GET['delete'])) {
    try {
        $db->query("DELETE FROM Usuario WHERE id_usuario = :id AND rol = 'guia'", [
            "id" => $_GET['delete']
        ]);
        $succesMessage = "El usuario guía ha sido eliminado con éxito";
        header("location: /admin/usuarios_guias.php?message=$succesMessage");
    } catch (\PDOException $e) {
        $errorString = "No se pudo eliminar el usuario guía. Puede que tenga registros asociados.";
        header("location: /admin/usuarios_guias.php?error=$errorString&type=warning");
    }
}

$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/usuarios_guias.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";

?>
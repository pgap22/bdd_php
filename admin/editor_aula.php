<?php
// editor_aula.php (Controller - Modified to show only users not in the aula)
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT'] . "/models/Conexion.php";
$db = Conexion::getInstance();

$activeNav = 'aulas'; // You might want to create a specific nav item for this

$id_aula = $_GET['id_aula'] ?? null;
$aula = [];

if ($id_aula) {
    $aula = $db->queryOne("SELECT * FROM Aula WHERE id_aula = :id", [
        "id" => $id_aula
    ]);
} else {
    // Redirect if no aula ID is provided
    header("location: /admin/aulas.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['add_usuario'])) {
        $id_usuario = htmlentities($_POST['id_usuario']);

        $errors = [];

        if (!$id_usuario) {
            $errors[] = [
                "titulo" => "Error",
                "descripcion" => "Falta seleccionar el usuario"
            ];
        }

        if (empty($errors)) {
            $db->query("INSERT INTO UsuarioAula(id_usuario, id_aula) VALUES(:id_usuario, :id_aula)", [
                "id_usuario" => $id_usuario,
                "id_aula" => $id_aula
            ]);
            $succesMessage = "El usuario ha sido agregado al aula con éxito";
            header("location: /admin/editor_aula.php?id_aula=$id_aula&message=$succesMessage");
        } else {
            $errorString = implode("<br>", array_column($errors, 'descripcion'));
            header("location: /admin/editor_aula.php?id_aula=$id_aula&error=$errorString");
        }
    } elseif (isset($_POST['remove_usuario'])) {
        $id_usuarioaula = htmlentities($_POST['id_usuarioaula']);
        $db->query("DELETE FROM UsuarioAula WHERE id_usuarioaula = :id_usuarioaula", [
            "id_usuarioaula" => $id_usuarioaula
        ]);
        $succesMessage = "El usuario ha sido removido del aula con éxito";
        header("location: /admin/editor_aula.php?id_aula=$id_aula&message=$succesMessage");
    }
}

$usuariosDisponibles = $db->query("SELECT u.id_usuario, u.nombre, u.apellido, u.email, u.rol
                            FROM Usuario u
                            WHERE u.rol IN ('estudiante', 'guia')
                            AND u.id_usuario NOT IN (SELECT ua.id_usuario FROM UsuarioAula ua WHERE ua.id_aula = :id_aula)", [
                                "id_aula" => $id_aula
                            ]);

$usuariosEnAula = $db->query("SELECT ua.*, u.nombre, u.apellido, u.email, u.rol
                            FROM UsuarioAula ua
                            JOIN Usuario u ON ua.id_usuario = u.id_usuario
                            WHERE ua.id_aula = :id_aula", [
                                "id_aula" => $id_aula
                            ]);

$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/editor_aula.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";
?>
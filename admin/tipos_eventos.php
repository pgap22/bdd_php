<?php
// tipos_eventos.php (Controller - with edit functionality)
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT'] . "/models/Conexion.php";
$db = Conexion::getInstance();

$activeNav = 'tipos_eventos';

$tipoEvento = [];

if (isset($_GET['id_tipoEvento'])) {
    $tipoEvento = $db->queryOne("SELECT * FROM TipoEvento WHERE id_tipoEvento = :id", [
        "id" => $_GET['id_tipoEvento']
    ]);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nombre = htmlentities($_POST['nombre']);
    $tipoAsistencia = htmlentities($_POST['tipoAsistencia']);
    $id_tipoEvento = htmlentities($_POST['id_tipoEvento'] ?? null);

    $errors = [];

    if (!$nombre) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta el campo nombre"
        ];
    }

    if (!$tipoAsistencia) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta seleccionar el tipo de asistencia"
        ];
    }

    if (empty($errors)) {
        if ($id_tipoEvento) {
            $db->query("UPDATE TipoEvento SET nombre = :nombre, tipoAsistencia = :tipoAsistencia WHERE id_tipoEvento = :id_tipoEvento", [
                "nombre" => $nombre,
                "tipoAsistencia" => $tipoAsistencia,
                "id_tipoEvento" => $id_tipoEvento
            ]);
            $succesMessage = "El tipo de evento ha sido actualizado con éxito";
            header("location: /admin/tipos_eventos.php?message=$succesMessage");
        } else {
            $db->query("INSERT INTO TipoEvento(nombre, tipoAsistencia) VALUES(:nombre, :tipoAsistencia)", [
                "nombre" => $nombre,
                "tipoAsistencia" => $tipoAsistencia
            ]);
            $succesMessage = "El tipo de evento ha sido agregado con éxito";
            header("location: /admin/tipos_eventos.php?message=$succesMessage");
        }
    }
}

$tiposEventos = $db->query("SELECT * FROM TipoEvento");

if (isset($_GET['delete'])) {
    $db->query("DELETE FROM TipoEvento WHERE id_tipoEvento = :id", [
        "id" => $_GET['delete']
    ]);
    $succesMessage = "El tipo de evento ha sido eliminado con éxito";
    header("location: /admin/tipos_eventos.php?message=$succesMessage");
}

$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/tipos_eventos.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";
?>
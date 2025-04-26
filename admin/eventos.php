<?php
// eventos.php (Controller)
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT'] . "/models/Conexion.php";
$db = Conexion::getInstance();

$activeNav = 'eventos';

$evento = [];

if (isset($_GET['id_evento'])) {
    $evento = $db->queryOne("SELECT * FROM Evento WHERE id_evento = :id", [
        "id" => $_GET['id_evento']
    ]);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nombre = htmlentities($_POST['nombre']);
    $id_tipoEvento = htmlentities($_POST['id_tipoEvento']);
    $descripcion = htmlentities($_POST['descripcion']);
    $id_evento = htmlentities($_POST['id_evento'] ?? null);

    $errors = [];

    if (!$nombre) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta el campo Nombre del Evento"
        ];
    }

    if (!$id_tipoEvento) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta seleccionar el Tipo de Evento"
        ];
    }

    if (!$descripcion) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta el campo Descripción"
        ];
    }

    if (empty($errors)) {
        if ($id_evento) {
            $db->query("UPDATE Evento SET nombre = :nombre, id_tipoEvento = :id_tipoEvento, descripcion = :descripcion WHERE id_evento = :id_evento", [
                "nombre" => $nombre,
                "id_tipoEvento" => $id_tipoEvento,
                "descripcion" => $descripcion,
                "id_evento" => $id_evento
            ]);
            $succesMessage = "El evento ha sido actualizado con éxito";
            header("location: /admin/eventos.php?message=$succesMessage");
        } else {
            $db->query("INSERT INTO Evento(nombre, id_tipoEvento, descripcion) VALUES(:nombre, :id_tipoEvento, :descripcion)", [
                "nombre" => $nombre,
                "id_tipoEvento" => $id_tipoEvento,
                "descripcion" => $descripcion
            ]);
            $succesMessage = "El evento ha sido registrado con éxito";
            header("location: /admin/eventos.php?message=$succesMessage");
        }
    }
}

$tiposEventos = $db->query("SELECT * FROM TipoEvento");
$eventos = $db->query("SELECT e.*, t.nombre as tipoEventoNombre, t.tipoAsistencia FROM Evento e JOIN TipoEvento t ON e.id_tipoEvento = t.id_tipoEvento");

if (isset($_GET['delete'])) {
    $db->query("DELETE FROM Evento WHERE id_evento = :id", [
        "id" => $_GET['delete']
    ]);
    $succesMessage = "El evento ha sido eliminado con éxito";
    header("location: /admin/eventos.php?message=$succesMessage");
}

$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/eventos.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";
?>
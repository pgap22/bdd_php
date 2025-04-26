<?php
// convocatorias_generales.php (Controller - with date formatting for SQL Server)
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT'] . "/models/Conexion.php";
$db = Conexion::getInstance();

$activeNav = 'convocatorias_generales';

$convocatoriaGeneral = [];

if (isset($_GET['id_convocatoriaGeneral'])) {
    $convocatoriaGeneral = $db->queryOne("SELECT * FROM ConvocatoriaGeneral WHERE id_convocatoriaGeneral = :id", [
        "id" => $_GET['id_convocatoriaGeneral']
    ]);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_nivelAcademico = htmlentities($_POST['id_nivelAcademico']);
    $id_evento = htmlentities($_POST['id_evento']);
    $fecha_str = htmlentities($_POST['fecha']);
    $lugar = htmlentities($_POST['lugar']);
    $id_convocatoriaGeneral = htmlentities($_POST['id_convocatoriaGeneral'] ?? null);

    $errors = [];

    if (!$id_nivelAcademico) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta seleccionar el Nivel Académico"
        ];
    }

    if (!$id_evento) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta seleccionar el Evento"
        ];
    }

    if (!$fecha_str) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta seleccionar la Fecha y Hora"
        ];
    }

    if (!$lugar) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta el campo Lugar"
        ];
    }

    if (empty($errors)) {
        // Format the date string for SQL Server
        $fecha = new DateTime($fecha_str);
        $fecha_formateada = $fecha->format('Y-m-d H:i:s');

        if ($id_convocatoriaGeneral) {
            $db->query("UPDATE ConvocatoriaGeneral SET id_nivelAcademico = :id_nivelAcademico, id_evento = :id_evento, fecha = :fecha, lugar = :lugar WHERE id_convocatoriaGeneral = :id_convocatoriaGeneral", [
                "id_nivelAcademico" => $id_nivelAcademico,
                "id_evento" => $id_evento,
                "fecha" => $fecha_formateada,
                "lugar" => $lugar,
                "id_convocatoriaGeneral" => $id_convocatoriaGeneral
            ]);
            $succesMessage = "La convocatoria ha sido actualizada con éxito";
            header("location: /admin/convocatorias_generales.php?message=$succesMessage");
        } else {
            $db->query("INSERT INTO ConvocatoriaGeneral(id_nivelAcademico, id_evento, fecha, lugar) VALUES(:id_nivelAcademico, :id_evento, :fecha, :lugar)", [
                "id_nivelAcademico" => $id_nivelAcademico,
                "id_evento" => $id_evento,
                "fecha" => $fecha_formateada,
                "lugar" => $lugar
            ]);
            $succesMessage = "La convocatoria ha sido programada con éxito";
            header("location: /admin/convocatorias_generales.php?message=$succesMessage");
        }
    }
}

$nivelesAcademicos = $db->query("SELECT * FROM NivelAcademico");
$eventos = $db->query("SELECT e.*, t.nombre as tipoEventoNombre, t.tipoAsistencia FROM Evento e JOIN TipoEvento t ON e.id_tipoEvento = t.id_tipoEvento");
$convocatoriasGenerales = $db->query("SELECT cg.*, na.nombre as nivelAcademicoNombre, e.nombre as eventoNombre, e.descripcion as eventoDescripcion, et.tipoAsistencia as eventoTipoAsistencia
                                      FROM ConvocatoriaGeneral cg
                                      JOIN NivelAcademico na ON cg.id_nivelAcademico = na.id_nivelAcademico
                                      JOIN Evento e ON cg.id_evento = e.id_evento
                                      JOIN TipoEvento et ON e.id_tipoEvento = et.id_tipoEvento");

if (isset($_GET['delete'])) {
    $db->query("DELETE FROM ConvocatoriaGeneral WHERE id_convocatoriaGeneral = :id", [
        "id" => $_GET['delete']
    ]);
    $succesMessage = "La convocatoria ha sido eliminada con éxito";
    header("location: /admin/convocatorias_generales.php?message=$succesMessage");
}

$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/convocatorias_generales.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";
?>
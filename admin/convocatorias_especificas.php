<?php
// convocatorias_especificas.php (Controller)
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT'] . "/models/Conexion.php";
$db = Conexion::getInstance();

$activeNav = 'convocatorias_especificas';

$convocatoriaEspecifica = [];

if (isset($_GET['id_convocatoriaEspecifica'])) {
    $convocatoriaEspecifica = $db->queryOne("SELECT * FROM ConvocatoriaEspecifica WHERE id_convocatoriaEspecifica = :id", [
        "id" => $_GET['id_convocatoriaEspecifica']
    ]);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_evento = htmlentities($_POST['id_evento']);
    $id_aula = htmlentities($_POST['id_aula']);
    $fecha_str = htmlentities($_POST['fecha']);
    $lugar = htmlentities($_POST['lugar']);
    $id_convocatoriaEspecifica = htmlentities($_POST['id_convocatoriaEspecifica'] ?? null);

    $errors = [];

    if (!$id_evento) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta seleccionar el Evento"
        ];
    }

    if (!$id_aula) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta seleccionar el Aula"
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

        if ($id_convocatoriaEspecifica) {
            $db->query("UPDATE ConvocatoriaEspecifica SET id_evento = :id_evento, id_aula = :id_aula, fecha = :fecha, lugar = :lugar WHERE id_convocatoriaEspecifica = :id_convocatoriaEspecifica", [
                "id_evento" => $id_evento,
                "id_aula" => $id_aula,
                "fecha" => $fecha_formateada,
                "lugar" => $lugar,
                "id_convocatoriaEspecifica" => $id_convocatoriaEspecifica
            ]);
            $succesMessage = "La convocatoria específica ha sido actualizada con éxito";
            header("location: /admin/convocatorias_especificas.php?message=$succesMessage");
        } else {
            $db->query("INSERT INTO ConvocatoriaEspecifica(id_evento, id_aula, fecha, lugar) VALUES(:id_evento, :id_aula, :fecha, :lugar)", [
                "id_evento" => $id_evento,
                "id_aula" => $id_aula,
                "fecha" => $fecha_formateada,
                "lugar" => $lugar
            ]);
            $succesMessage = "La convocatoria específica ha sido programada con éxito";
            header("location: /admin/convocatorias_especificas.php?message=$succesMessage");
        }
    }
}

$eventos = $db->query("SELECT e.*, t.nombre as tipoEventoNombre, t.tipoAsistencia FROM Evento e JOIN TipoEvento t ON e.id_tipoEvento = t.id_tipoEvento");
$aulas = $db->query("SELECT a.*, g.nombre as nombreGrado FROM Aula a JOIN Grado g ON a.id_grado = g.id_grado");
$convocatoriasEspecificas = $db->query("SELECT ce.*, e.nombre as eventoNombre, e.descripcion as eventoDescripcion, et.tipoAsistencia as eventoTipoAsistencia,
                                         a.seccion as aulaSeccion, gr.nombre as gradoNombre
                                         FROM ConvocatoriaEspecifica ce
                                         JOIN Evento e ON ce.id_evento = e.id_evento
                                         JOIN TipoEvento et ON e.id_tipoEvento = et.id_tipoEvento
                                         JOIN Aula a ON ce.id_aula = a.id_aula
                                         JOIN Grado gr ON a.id_grado = gr.id_grado");

if (isset($_GET['delete'])) {
    $db->query("DELETE FROM ConvocatoriaEspecifica WHERE id_convocatoriaEspecifica = :id", [
        "id" => $_GET['delete']
    ]);
    $succesMessage = "La convocatoria específica ha sido eliminada con éxito";
    header("location: /admin/convocatorias_especificas.php?message=$succesMessage");
}

$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/convocatorias_especificas.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";
?>
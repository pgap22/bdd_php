<?php
// aula.php (Controller)
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT'] . "/models/Conexion.php";
$db = Conexion::getInstance();

$activeNav = 'aulas';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $seccion = htmlentities($_POST['seccion']);
    $id_aula = htmlentities($_POST['id_aula']);
    $id_grado = htmlentities($_POST['id_grado']);

    $errors = [];

    if (!$seccion) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta el campo sección"
        ];
    }

    if (!$id_grado) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta seleccionar el grado"
        ];
    }

    if (empty($errors)) {
        if (!$id_aula) {
            $db->query("INSERT INTO Aula(seccion, id_grado) VALUES(:seccion, :id_grado)", [
                "seccion" => $seccion,
                "id_grado" => $id_grado
            ]);
            $succesMessage = "El aula ha sido agregada con éxito";
            header("location: /admin/aulas.php?message=$succesMessage");
        } else {
            $db->query("UPDATE Aula SET seccion = :seccion, id_grado = :id_grado WHERE id_aula = :id_aula", [
                "seccion" => $seccion,
                "id_grado" => $id_grado,
                "id_aula" => $id_aula
            ]);
            $succesMessage = "El aula ha sido actualizada con éxito";
            header("location: /admin/aulas.php?message=$succesMessage");
        }
    }
}

$grados = $db->query("SELECT g.*, CONCAT(g.nombre, ' | ', na.nombre) as nombre FROM Grado g inner join NivelAcademico na on na.id_nivelAcademico=g.id_nivelAcademico");
$aulas = $db->query("SELECT a.*, CONCAT(g.nombre, ' | ', na.nombre) as nombreGrado FROM Aula a JOIN Grado g ON a.id_grado = g.id_grado inner join NivelAcademico na on na.id_nivelAcademico=g.id_nivelAcademico");

$aula = [];

if (isset($_GET['id_aula'])) {
    $aula = $db->queryOne("SELECT * FROM Aula WHERE id_aula = :id", [
        "id" => $_GET['id_aula']
    ]);
}

if (isset($_GET['delete'])) {
    $db->query("DELETE FROM Aula WHERE id_aula = :id", [
        "id" => $_GET['delete']
    ]);
    $succesMessage = "El aula ha sido eliminada con éxito";
    header("location: /admin/aulas.php?message=$succesMessage");
}

$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/aulas.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";
?>
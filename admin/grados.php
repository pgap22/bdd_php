<?php
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT']  . "/models/Conexion.php";
$db = Conexion::getInstance();

$activeNav = 'grados';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nombre = htmlentities($_POST['nombre']);
    $id_grado = htmlentities($_POST['id_grado']);
    $id_nivelAcademico = htmlentities($_POST['id_nivelAcademico']);

    $errors = [];

    if (!$nombre) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta el campo nombre"
        ];
    }

    if (!$id_nivelAcademico) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta seleccionar el nivel académico"
        ];
    }

    if (empty($errors)) {
        if (!$id_grado) {
            $db->query("INSERT INTO Grado(nombre, id_nivelAcademico) VALUES(:nombre, :id_nivelAcademico)", [
                "nombre" => $nombre,
                "id_nivelAcademico" => $id_nivelAcademico
            ]);
            $succesMessage = "El grado ha sido agregado con éxito";
            header("location: /admin/grados.php?message=$succesMessage");
        } else {
            $db->query("UPDATE Grado SET nombre = :nombre, id_nivelAcademico = :id_nivelAcademico WHERE id_grado = :id_grado", [
                "nombre" => $nombre,
                "id_nivelAcademico" => $id_nivelAcademico,
                "id_grado" => $id_grado
            ]);
            $succesMessage = "El grado ha sido actualizado con éxito";
            header("location: /admin/grados.php?message=$succesMessage");
        }
    }
}

$nivelesAcademicos = $db->query("SELECT * FROM NivelAcademico");
$grados = $db->query("SELECT g.*, n.nombre as nivelAcademico FROM Grado g JOIN NivelAcademico n ON g.id_nivelAcademico = n.id_nivelAcademico");

$grado = [];

if (isset($_GET['id_grado'])) {
    $grado = $db->queryOne("SELECT * FROM Grado WHERE id_grado = :id", [
        "id" => $_GET['id_grado']
    ]);
}

if (isset($_GET['delete'])) {
    $db->query("DELETE FROM Grado WHERE id_grado = :id", [
        "id" => $_GET['delete']
    ]);
    $succesMessage = "El grado ha sido eliminado con éxito";
    header("location: /admin/grados.php?message=$succesMessage");
}

$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/grados.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT']  . "/models/Conexion.php";
$db = Conexion::getInstance();

$activeNav = "nivelesAcademicos";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nombre = htmlentities($_POST['nombre']);
    $id_nivelAcademico = htmlentities($_POST['id_nivelAcademico']);

    $errors = [];

    if (!$nombre) {
        $errors[] = [
            "titulo" => "Error",
            "descripcion" => "Falta el campo nombre"
        ];
    }


    if (empty($errors)) {
        if (!$id_nivelAcademico) {
            $db->query("INSERT INTO NivelAcademico(nombre) VALUES(:nombre)", [
                "nombre" => $nombre
            ]);
            $succesMessage = "El nivel academico ha sido agregado con exito";
            header("location: /admin/nivelesAcademicos.php?message=$succesMessage");
        } else {
            $db->query("UPDATE NivelAcademico SET nombre = :nombre WHERE id_nivelAcademico = :id_nivelAcademico", [
                "nombre" => $nombre,
                "id_nivelAcademico" => $id_nivelAcademico
            ]);
            $succesMessage = "El nivel academico ha sido actualizado con extio";
            header("location: /admin/nivelesAcademicos.php?message=$succesMessage");
        }
    }
}

$nivelesAcademicos = $db->query("SELECT * FROM NivelAcademico");

$nivel = [];

if (isset($_GET['id_nivelAcademico'])) {
    $nivel = $db->queryOne("SELECT * FROM NivelAcademico WHERE id_nivelAcademico = :id", [
        "id" => $_GET['id_nivelAcademico']
    ]);
}

if (isset($_GET['delete'])) {
    $nivel = $db->query("DELETE FROM NivelAcademico WHERE id_nivelAcademico = :id", [
        "id" => $_GET['delete']
    ]);
    $succesMessage = "El nivel academico ha sido eliminado con exito";
    header("location: /admin/nivelesAcademicos.php?message=$succesMessage");
}

$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/nivelesAcademicos.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";

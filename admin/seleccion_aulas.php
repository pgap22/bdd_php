<?php
// seleccion_aulas.php (Controller - Modified to concatenate aula and grade)
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT'] . "/models/Conexion.php";
$db = Conexion::getInstance();

$activeNav = 'aulas'; // Or create a specific nav item

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id_aula = htmlentities($_POST['id_aula']);
    if ($id_aula) {
        header("location: /admin/editor_aula.php?id_aula=$id_aula");
        exit;
    } else {
        $errorMessage = "Por favor, selecciona un aula.";
        header("location: /admin/seleccion_aulas.php?error=$errorMessage");
        exit;
    }
}

$aulas = $db->query("SELECT a.id_aula, CONCAT(a.seccion, ' - ', g.nombre) as aulaNombre FROM Aula a JOIN Grado g ON a.id_grado = g.id_grado");

$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/seleccion_aulas.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";
?>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/middleware/auth_admin.php';
require $_SERVER['DOCUMENT_ROOT']  . "/models/Conexion.php";
$db = Conexion::getInstance();
$activeNav = 'admin';
$totalEstudiantes               = $db->queryOne("SELECT COUNT(*) as total FROM Usuario where rol = 'estudiante'")['total'];
$totalConvocatoriasGenerales    = $db->queryOne("SELECT COUNT(*) as total FROM ConvocatoriaGeneral")['total'];
$totalConvocatoriasEspecifica  = $db->queryOne("SELECT COUNT(*) as total FROM ConvocatoriaEspecifica")['total'];


$view = $_SERVER['DOCUMENT_ROOT'] . "/views/admin/index.php";
include $_SERVER['DOCUMENT_ROOT'] . "/views/layout/adminLayout.php";

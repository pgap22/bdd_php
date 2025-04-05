<?php
$serverName = "localhost";
$database = "bdd_proyecto";

try {
    $db = new PDO("sqlsrv:Server=$serverName;Database=$database", null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

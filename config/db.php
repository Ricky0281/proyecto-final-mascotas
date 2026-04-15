<?php
$host = "sql101.infinityfree.com";
$usuario = "if0_41214981";
$contrasena = 'WD73qJcC9rxTdB2';
$basedatos = "if0_41214981_tiendamascotas";

$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
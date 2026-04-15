<?php
// Conexión a la base de datos de InfinityFree

$host = "sql101.infinityfree.com";
$usuario = "if0_41214981";
$contrasena = "WD73qJcC9rxTdB2";
$basedatos = "if0_41214981_tiendamascotas";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $basedatos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Ajuste de caracteres
$conn->set_charset("utf8");
?>
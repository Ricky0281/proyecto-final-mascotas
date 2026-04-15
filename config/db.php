<?php
// Conexión a la base de datos de InfinityFree

$host = "sql101.infinityfree.com";
$usuario = "if0_41214981";
$contrasena = "WD73qJcC9rxTdB2";
$basedatos = "if0_41214981_tiendamascotas";

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena, $basedatos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Ajuste de caracteres
$conexion->set_charset("utf8");
?>
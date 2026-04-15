<?php
include("config/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cliente"];
    $producto = $_POST["producto"];
    $cantidad = $_POST["cantidad"];
    $direccion = $_POST["direccion"];
    $fecha = $_POST["fecha"];

    $sql = "INSERT INTO pedidos (cliente, producto, cantidad, direccion, fecha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $cliente, $producto, $cantidad, $direccion, $fecha);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al guardar el pedido: " . $stmt->error;
    }

    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}

$conn->close();
?>
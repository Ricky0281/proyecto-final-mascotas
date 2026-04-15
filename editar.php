<?php
include("config/db.php");

if (!isset($_GET["id"])) {
    die("ID no recibido");
}

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = $_POST["cliente"];
    $producto = $_POST["producto"];
    $cantidad = $_POST["cantidad"];
    $direccion = $_POST["direccion"];
    $fecha = $_POST["fecha"];

    $sql_update = "UPDATE pedidos SET cliente = ?, producto = ?, cantidad = ?, direccion = ?, fecha = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssissi", $cliente, $producto, $cantidad, $direccion, $fecha, $id);

    if ($stmt_update->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
    }

    $stmt_update->close();
}

$sql = "SELECT * FROM pedidos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    die("Pedido no encontrado");
}

$pedido = $resultado->fetch_assoc();

$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pedido</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">
    <h1>Editar pedido</h1>

    <form action="" method="POST" class="formulario">
        <input type="text" name="cliente" placeholder="Nombre del cliente" value="<?php echo htmlspecialchars($pedido['cliente']); ?>" required>
        <input type="text" name="producto" placeholder="Producto" value="<?php echo htmlspecialchars($pedido['producto']); ?>" required>
        <input type="number" name="cantidad" placeholder="Cantidad" value="<?php echo htmlspecialchars($pedido['cantidad']); ?>" required min="1">
        <input type="text" name="direccion" placeholder="Direccion de entrega" value="<?php echo htmlspecialchars($pedido['direccion']); ?>" required>
        <input type="date" name="fecha" value="<?php echo htmlspecialchars($pedido['fecha']); ?>" required>

        <button type="submit" class="btn guardar">Actualizar pedido</button>
    </form>

    <a href="index.php" class="btn volver">Volver</a>
</div>

</body>
</html>
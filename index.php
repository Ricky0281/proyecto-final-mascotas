<?php
include("config/db.php");

$sql = "SELECT * FROM pedidos ORDER BY id DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de mascotas - Gestion de pedidos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">
    <h1>Tienda de mascotas - Gestion de pedidos</h1>
    <p class="subtitulo">Sistema para registrar, consultar, editar y eliminar pedidos</p>

    <div class="tarjeta">
        <h2>Registrar nuevo pedido</h2>

        <form action="crear.php" method="POST" class="formulario">
            <input type="text" name="cliente" placeholder="Nombre del cliente" required>
            <input type="text" name="producto" placeholder="Producto para mascota" required>
            <input type="number" name="cantidad" placeholder="Cantidad" required min="1">
            <input type="text" name="direccion" placeholder="Direccion de entrega" required>
            <input type="date" name="fecha" required>

            <button type="submit" class="btn guardar">Guardar pedido</button>
        </form>
    </div>

    <div class="tarjeta">
        <h2>Lista de pedidos</h2>

        <?php if ($resultado && $resultado->num_rows > 0) { ?>
            <div class="tabla-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Direccion</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($fila = $resultado->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $fila["id"]; ?></td>
                                <td><?php echo htmlspecialchars($fila["cliente"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["producto"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["cantidad"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["direccion"]); ?></td>
                                <td><?php echo htmlspecialchars($fila["fecha"]); ?></td>
                                <td class="acciones">
                                    <a href="editar.php?id=<?php echo $fila['id']; ?>" class="btn editar">Editar</a>
                                    <a href="eliminar.php?id=<?php echo $fila['id']; ?>" class="btn eliminar" onclick="return confirm('Seguro que deseas eliminar este pedido?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <p class="mensaje">No hay pedidos registrados.</p>
        <?php } ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
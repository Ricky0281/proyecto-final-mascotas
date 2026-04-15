<?php
include("config/db.php");

// Obtener pedidos
$resultado = mysqli_query($conexion, "SELECT * FROM pedidos ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Mascotas</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">
    <h1>Registrar nuevo pedido</h1>
    <p>Ingresa los datos del cliente y del producto solicitado</p>

    <form action="crear.php" method="POST" class="formulario">
        <input type="text" name="cliente" placeholder="Nombre del cliente" required>
        <input type="text" name="producto" placeholder="Ejemplo: collar para perro" required>
        <input type="number" name="cantidad" placeholder="Cantidad" required min="1">
        <input type="text" name="direccion" placeholder="Dirección de entrega" required>
        <input type="date" name="fecha" required>
        <button type="submit">Guardar pedido</button>
    </form>
</div>

<div class="contenedor">
    <h2>Lista de pedidos</h2>
    <p>Pedidos registrados actualmente en la base de datos</p>

    <?php if (mysqli_num_rows($resultado) > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Dirección</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $fila['id']; ?></td>
                        <td><?php echo htmlspecialchars($fila['cliente']); ?></td>
                        <td><?php echo htmlspecialchars($fila['producto']); ?></td>
                        <td><?php echo $fila['cantidad']; ?></td>
                        <td><?php echo htmlspecialchars($fila['direccion']); ?></td>
                        <td><?php echo $fila['fecha']; ?></td>
                        <td>
                            <a href="editar.php?id=<?php echo $fila['id']; ?>">Editar</a> |
                            <a href="eliminar.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este pedido?')">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No hay pedidos registrados todavía.</p>
    <?php } ?>
</div>

<div class="whatsapp-box">
    <div class="whatsapp-texto">
        <span class="whatsapp-titulo">Contáctanos</span>
        <p>¿Necesitas ayuda con tu pedido? Escríbenos por WhatsApp y te respondemos rápido.</p>
    </div>

    <a
        class="whatsapp-boton"
        href="https://wa.me/573001234567?text=Hola,%20quiero%20informaci%C3%B3n%20sobre%20los%20productos%20de%20la%20tienda"
        target="_blank"
    >
        WhatsApp
    </a>
</div>

</body>
</html>
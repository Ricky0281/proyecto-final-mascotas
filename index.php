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
    <title>Pet Shop Ricky - Gestion de pedidos</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="pagina">

    <header class="hero">
        <div class="hero-texto">
            <span class="etiqueta">Tienda de mascotas</span>
            <h1>Pet Shop Ricky</h1>
            <p>
                Todo lo que tu mascota necesita en un solo lugar.
                Calidad, cuidado y amor en cada producto.
            </p>
            <p>
                Haz tu pedido facil y rapido con nosotros.
            </p>
        </div>
    </header>

    <section class="catalogo">
        <div class="seccion-titulo">
            <h2>Catalogo destacado</h2>
            <p>Encuentra productos especiales para consentir a tu mascota.</p>
        </div>

        <div class="grid-productos">
            <article class="card-producto">
                <img src="img/collar.jpg" alt="Collar para perro">
                <div class="producto-info">
                    <h3>Collar para perro</h3>
                    <p>Collar resistente y comodo para paseos diarios.</p>
                    <span class="precio">$ 20.000 COP</span>
                </div>
            </article>

            <article class="card-producto">
                <img src="img/arena.jpg" alt="Arena para gato">
                <div class="producto-info">
                    <h3>Arena para gato</h3>
                    <p>Control de olores y facil limpieza para uso diario.</p>
                    <span class="precio">$ 35.000 COP</span>
                </div>
            </article>

            <article class="card-producto">
                <img src="img/juguete.jpg" alt="Juguete para mascota">
                <div class="producto-info">
                    <h3>Juguete para mascota</h3>
                    <p>Ideal para entretenimiento y actividad fisica.</p>
                    <span class="precio">$ 18.000 COP</span>
                </div>
            </article>

            <article class="card-producto">
                <img src="img/concentrado.jpg" alt="Concentrado premium">
                <div class="producto-info">
                    <h3>Concentrado premium</h3>
                    <p>Alimento balanceado para perros y gatos.</p>
                    <span class="precio">$ 75.000 COP</span>
                </div>
            </article>
        </div>
    </section>

    <section class="paneles">
        <div class="panel formulario-panel" id="formulario-pedido">
            <div class="seccion-titulo">
                <h2>Registrar nuevo pedido</h2>
                <p>Ingresa los datos del cliente y del producto solicitado</p>
            </div>

            <form action="crear.php" method="POST" class="formulario">
                <div class="campo">
                    <label for="cliente">Cliente</label>
                    <input type="text" id="cliente" name="cliente" placeholder="Nombre del cliente" required>
                </div>

                <div class="campo">
                    <label for="producto">Producto</label>
                    <input type="text" id="producto" name="producto" placeholder="Ejemplo: collar para perro" required>
                </div>

                <div class="campo">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" id="cantidad" name="cantidad" placeholder="Cantidad" min="1" required>
                </div>

                <div class="campo">
                    <label for="direccion">Direccion</label>
                    <input type="text" id="direccion" name="direccion" placeholder="Direccion de entrega" required>
                </div>

                <div class="campo">
                    <label for="fecha">Fecha</label>
                    <input type="date" id="fecha" name="fecha" required>
                </div>

                <div class="campo campo-boton">
                    <button type="submit" class="btn guardar">Guardar pedido</button>
                </div>
            </form>
        </div>

        <div class="panel tabla-panel">
            <div class="seccion-titulo">
                <h2>Lista de pedidos</h2>
                <p>Pedidos registrados actualmente en la base de datos</p>
            </div>

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
                <div class="estado-vacio">
                    <p>No hay pedidos registrados todavia.</p>
                </div>
            <?php } ?>
        </div>
    </section>

</div>

<div class="whatsapp-card">
    <div class="whatsapp-card-icono">💬</div>
    <div class="whatsapp-card-contenido">
        <span class="whatsapp-card-titulo">Contactanos por WhatsApp</span>
        <p>Estamos listos para ayudarte con tu pedido, resolver dudas y recomendarte el mejor producto para tu mascota.</p>
        <a class="whatsapp-card-boton" href="https://wa.me/573027552684?text=Hola,%20quiero%20informacion%20sobre%20los%20productos%20de%20Pet%20Shop%20Ricky" target="_blank">
            Escribir por WhatsApp
        </a>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
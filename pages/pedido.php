<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pedido</title>
</head>
<br>
    <br></br>
    <h2>Realizar Pedido</h2>
    <form action="guardar_pedido.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="producto">Producto:</label>
        <input type="text" id="producto" name="producto" required><br><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" required><br><br>

        <label for="direccion">Dirección:</label>
        <textarea id="direccion" name="direccion" required></textarea><br><br>

        <button type="submit">Enviar Pedido</button>
    </form>
</body>
</html>
<?php include('footer.php'); ?>
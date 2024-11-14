<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por tu Pedido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            text-align: center;
            padding: 50px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background-color: #d43f3a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #b30c00;
        }
    </style>
</head>
<body>
    <h2>¡Gracias por hacer tu pedido!</h2>
    <p>Tu pedido ha sido recibido y pronto nos pondremos en contacto contigo.</p>
    <a href="pedido.php" class="btn">Hacer otro pedido</a>
</body>
</html>

<?php include('footer.php'); ?>

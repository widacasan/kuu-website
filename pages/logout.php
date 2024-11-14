<?php
session_start();
session_unset();
session_destroy();
header('Location: login.php');
exit();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cerrar Sesión - Kuu</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <h2>Has cerrado sesión</h2>
</body>
</html>




<?php


session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Si ya está logueado, redirige al listado de pedidos
    header('Location: pedidos.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí puedes establecer una clave secreta o verificarla con la base de datos
    $clave_secreta = 'kuu3d'; // Cambia esta clave a una más segura
    
    if (isset($_POST['clave']) && $_POST['clave'] === $clave_secreta) {
        $_SESSION['logged_in'] = true; // Establecer la sesión como iniciada
        header('Location: pedidos.php');
        exit();
    } else {
        $error_message = 'Clave incorrecta. Intenta nuevamente.';
    }
}
?>

<!-- HTML para el formulario de inicio de sesión -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Kuu</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <h2>Acceso al Checklist de Pedidos</h2>
    <?php if (isset($error_message)) { echo "<p style='color:red;'>$error_message</p>"; } ?>
    <form action="login.php" method="POST">
        <label for="clave">Clave de acceso:</label>
        <input type="password" id="clave" name="clave" required>
        <button type="submit">Acceder</button>
    </form>
</body>
</html>

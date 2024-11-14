<?php
session_start();



// Conexión a la base de datos
$host = 'localhost';
$dbname = 'pedidos'; // Cambia por el nombre de tu base de datos
$username = 'root'; // Tu usuario de base de datos
$password = ''; // Tu contraseña de base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Verificar si el formulario de nuevo pedido ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se está enviando un nuevo pedido
    if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['producto']) && isset($_POST['cantidad']) && isset($_POST['direccion'])) {
        // Insertar el nuevo pedido en la base de datos
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $producto = $_POST['producto'];
        $cantidad = $_POST['cantidad'];
        $direccion = $_POST['direccion'];

        $stmt = $pdo->prepare("INSERT INTO pedidos (nombre, email, producto, cantidad, direccion, estado) VALUES (:nombre, :email, :producto, :cantidad, :direccion, 'pendiente')");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':producto', $producto);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->execute();

        // Redirigir a la página de agradecimiento después de insertar el pedido
        header('Location: gracias.php');
        exit();
    }

    // Procesar los estados de los pedidos existentes (si los hay)
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'estado_') === 0) {
            $pedidoId = substr($key, 7); // Extraer el ID del pedido
            $nuevoEstado = $value;

            // Actualizar el estado del pedido en la base de datos
            $stmt = $pdo->prepare("UPDATE pedidos SET estado = :estado WHERE id = :id");
            $stmt->bindParam(':estado', $nuevoEstado);
            $stmt->bindParam(':id', $pedidoId, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    // Después de procesar, redirigir a la misma página para evitar reenvío de formulario
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Consultar los pedidos desde la base de datos
$stmt = $pdo->prepare('SELECT * FROM pedidos');
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

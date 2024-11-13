<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de la base de datos
$servername = "localhost";
$username = "root"; // Cambia esto si has cambiado el usuario por defecto
$password = ""; // Cambia esto si tienes una contraseña
$dbname = "pedidos"; // Nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Preparar la consulta SQL
$stmt = $conn->prepare("INSERT INTO pedidos (nombre, email, producto, cantidad, direccion) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $nombre, $email, $producto, $cantidad, $direccion);

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$direccion = $_POST['direccion'];

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Pedido registrado con éxito";
} else {
    echo "Error al registrar el pedido: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>

<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Si no está logueado, redirige al login
    header('Location: login.php');
    exit();
}

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

// Procesar los estados de los pedidos (si los hay)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Redirigir a la misma página después de la actualización
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Consultar los pedidos desde la base de datos
$stmt = $pdo->prepare('SELECT * FROM pedidos');
$stmt->execute();
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checklist de Pedidos - Kuu</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <h2>Checklist de Pedidos</h2>
    <a class="cerrar" href="logout.php">Cerrar sesión</a>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <ul>
            <?php foreach ($pedidos as $pedido): ?>
                <li class="pedido <?php echo $pedido['estado']; ?>">
                    <input type="checkbox" name="pedido_<?php echo $pedido['id']; ?>" id="pedido_<?php echo $pedido['id']; ?>">
                    <label for="pedido_<?php echo $pedido['id']; ?>">
                        Pedido #<?php echo $pedido['id']; ?> - <?php echo $pedido['producto']; ?> - Cantidad: <?php echo $pedido['cantidad']; ?>
                    </label>
                    <!-- Dropdown de estado -->
                    <select name="estado_<?php echo $pedido['id']; ?>" id="estado_<?php echo $pedido['id']; ?>">
                        <option value="pendiente" <?php echo ($pedido['estado'] == 'pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                        <option value="en_proceso" <?php echo ($pedido['estado'] == 'en_proceso') ? 'selected' : ''; ?>>En Proceso</option>
                        <option value="entregado" <?php echo ($pedido['estado'] == 'entregado') ? 'selected' : ''; ?>>Entregado</option>
                    </select>
                </li>
            <?php endforeach; ?>
        </ul>
        <button type="submit">Actualizar Estado</button>
    </form>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const estadoSelects = document.querySelectorAll("select[name^='estado_']");

        estadoSelects.forEach(select => {
            const pedidoItem = select.closest("li");

            const actualizarColor = () => {
                pedidoItem.classList.remove("pendiente", "en_proceso", "entregado");
                pedidoItem.classList.add(select.value);
            };

            actualizarColor();

            select.addEventListener("change", actualizarColor);
        });
    });
    </script>
</body>
</html>

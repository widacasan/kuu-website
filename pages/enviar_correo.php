<?php
// Incluir el autoload de PHPMailer (si usas Composer)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Cambia la ruta si no usas Composer

// Crear una nueva instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP(); // Usar SMTP
    $mail->Host = 'smtp.gmail.com'; // Servidor SMTP de Gmail
    $mail->SMTPAuth = true; // Habilitar autenticación SMTP
    $mail->Username = 'kuu3dprint@gmail.com'; // Tu dirección de correo de Gmail
    $mail->Password = 'Andres2002'; // Contraseña o App password de Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Cifrado
    $mail->Port = 587; // Puerto para enviar el correo

    // Configuración del remitente y destinatario
    $mail->setFrom('kuu3dprint@gmail.com', 'Kuu3d');
    $mail->addAddress('kuu3dprint@gmail.com'); // Dirección del destinatario (puedes agregar más destinatarios)

    // Asunto y cuerpo del mensaje
    $mail->Subject = 'Nuevo Pedido Registrado';
    
    // Asegúrate de que estas variables están definidas y sanitizadas antes de usarlas
    $nombre = htmlspecialchars($nombre ?? '');
    $email = htmlspecialchars($email ?? '');
    $producto = htmlspecialchars($producto ?? '');
    $cantidad = htmlspecialchars($cantidad ?? '');
    $direccion = htmlspecialchars($direccion ?? '');
    
    // Configurar cuerpo en texto plano
    $mail->isHTML(false); // Enviar como texto plano
    $mail->Body = "Se ha registrado un nuevo pedido:\n\n" .
                  "Nombre: $nombre\n" .
                  "Email: $email\n" .
                  "Producto: $producto\n" .
                  "Cantidad: $cantidad\n" .
                  "Dirección: $direccion";

    // Enviar el correo
    $mail->send();
    echo "Notificación enviada con éxito.";
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>

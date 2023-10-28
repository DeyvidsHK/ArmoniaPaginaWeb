<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'static/src/libs/PHPMailer/Exception.php';
require 'static/src/libs/PHPMailer/PHPMailer.php';
require 'static/src/libs/PHPMailer/SMTP.php';

// Comprueba si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $mensaje = $_POST["mensaje"];

    try {
        // Creación de una nueva instancia de PHPMailer
        $mail = new PHPMailer();
        // Configuración del servidor SMTP y la autenticación
        $mail->isSMTP();
        $mail->SMTPDebug = 2; 
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'armonia10oficialperu@gmail.com';
        $mail->Password = 'uctbcltubeblwofx';
        $mail->SMTPSecure = 'tls'; // Puedes cambiar a 'ssl' si tu servidor lo requiere
        $mail->Port = 587; // Puerto SMTP
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        // Configura el correo electrónico
        $mail->setFrom('armonia10oficialperu@gmail.com', 'Armonía 10');
        $mail->addAddress('armonia10oficialperu@gmail.com');
        $mail->Subject = 'Mensaje de contacto de ' . $nombre;

        // Cuerpo del mensaje
        $message_body = "Tienes un mensaje desde tu sitio web Armonía 10\n";
        $message_body .= "Nombre: " . $nombre . "\n";
        $message_body .= "Correo: " . $correo . "\n";
        $message_body .= "Teléfono: " . $telefono . "\n";
        $message_body .= "Mensaje: " . $mensaje;
        $mail->Body = $message_body;

        // Configura la codificación del mensaje en UTF-8
        $mail->CharSet = 'UTF-8';

        // Enviar el correo electrónico
        $mail->send();
        echo "Mensaje enviado con éxito. ¡Gracias por ponerte en contacto!";

        // Después de enviar el correo, Obtiene la URL anterior sin los anclajes
        $pagina_anterior = strtok($_SERVER['HTTP_REFERER'], '#');

        // Redirige al usuario a la página anterior
        header("Location: " . $pagina_anterior . "#contactanos");
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
} else {
    echo "No se pudo procesar el formulario.";
}
?>
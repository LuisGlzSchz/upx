<?php
date_default_timezone_set('America/Mexico_City');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

define('APP_RUNNING', true);
$config = require 'config/config.php';

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host       = $config['host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['username'];
    $mail->Password   = $config['password'];
    $mail->SMTPSecure = $config['encryption'];
    $mail->Port       = $config['port'];


    $mail->CharSet = 'UTF-8';
    $mail->setFrom($config['username'], 'Página Web');
    $mail->addAddress($config['username']); 

 
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
    $mensaje = filter_var($_POST['mensaje'], FILTER_SANITIZE_STRING);


    if (!$email) {
        throw new Exception("El correo electrónico proporcionado no es válido.");
    }


    if (preg_match("/[\r\n]/", $nombre) || preg_match("/[\r\n]/", $email)) {
        throw new Exception("Error: No se permiten cabeceras de correo en los campos.");
    }


    $mail->isHTML(true);
    $mail->Subject = 'Nuevo mensaje desde la página web';
$fechaHora = date('Y-m-d H:i:s');
   $mail->Body    = "
    <table style='width: 100%; border-collapse: collapse;'>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><strong>Fecha y Hora:</strong></td>
            <td style='padding: 8px; border: 1px solid #ddd;'>$fechaHora</td>
        </tr>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><strong>Nombre:</strong></td>
            <td style='padding: 8px; border: 1px solid #ddd;'>$nombre</td>
        </tr>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><strong>Correo Electrónico:</strong></td>
            <td style='padding: 8px; border: 1px solid #ddd;'>$email</td>
        </tr>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><strong>Teléfono:</strong></td>
            <td style='padding: 8px; border: 1px solid #ddd;'>$telefono</td>
        </tr>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><strong>Mensaje:</strong></td>
            <td style='padding: 8px; border: 1px solid #ddd;'>$mensaje</td>
        </tr>
    </table>
";


    $mail->send();
    header('Location: success.html'); 
    exit();

} catch (Exception $e) {

    error_log('Error al enviar correo: ' . $e->getMessage());

    header('Location: index.php?error=true');
    exit();
}

?>

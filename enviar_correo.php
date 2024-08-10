<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


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


    $mail->setFrom($config['username'], 'Formulario de Contacto');
    $mail->addAddress($config['username']); 


    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    $mail->isHTML(true);
    $mail->Subject = 'Nuevo mensaje de contacto';
    $mail->Body    = "
                    <table style='width: 100%; border-collapse: collapse;'>
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

    header('Location: index.html');
    exit();
}
?>

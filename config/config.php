<?php

if (!defined('APP_RUNNING')) {
    die('Direct access not permitted');
}

return [
    'host' => 'secure.emailsrvr.com',
    'username' => 'contacto@upx.edu.mx',
    'password' => 'BqCe!C38',
    'port' => 465,
    'encryption' => PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS
];
?>

<?php
// test_enviar_correo.php
header('Content-Type: application/json');

$response = array(
    'status' => 'success',
    'message' => 'El correo ha sido enviado exitosamente.'
);

echo json_encode($response);
?>

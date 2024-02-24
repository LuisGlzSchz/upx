<?php
require 'conexion.php';
session_start();

$user = $_POST['user'];
$password = $_POST['password'];

echo "Usuario: $user, Contraseña: $password";
$query = "SELECT * FROM alumnos WHERE usuario='$user'";

$consulta = pg_query($conection, $query);
$registro = pg_fetch_assoc($consulta);

var_dump($registro['password']);

if ($registro) {
    if (($password == $registro['password'])) {
        $_SESSION['usuario'] = $user;
        header('location: kardex.php');
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}
?>


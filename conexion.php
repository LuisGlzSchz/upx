<?php

$host='localhost';
$db='upx_xalapa';
$user='luis';
$password='password';

$conection=pg_connect("host=$host dbname=$db user=$user password=$password");

$conection = pg_connect("host=$host dbname=$db user=$user password=$password");

if (!$conection) {
    die("Error de conexión: " . pg_last_error());
}

?>

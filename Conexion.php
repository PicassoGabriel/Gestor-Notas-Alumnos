<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "prediccion";

$conexion = mysqli_connect($server, $user, $pass, $db);

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}
?>
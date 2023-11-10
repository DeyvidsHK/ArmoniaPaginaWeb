<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bd_armonia10";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

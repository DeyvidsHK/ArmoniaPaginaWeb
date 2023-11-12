<?php
<<<<<<< HEAD
$servername = "db";
=======
$servername = "localhost:8000";
>>>>>>> 7d2e6d3ac2d0e8465b7b261809dd00e7ab931aec
$username = "root";
$password = "test";
$database = "armonia";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

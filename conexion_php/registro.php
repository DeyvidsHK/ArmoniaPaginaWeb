<?php

    include ("conexion_lg.php");

    $nombre = $_POST["nombre"]; 
    $correo = $_POST["correo"]; 
    $usuario = $_POST["usuario"]; 
    $contraseña = $_POST["contraseña"]; 

    $query = "INSERT INTO clientes(nombre,correo,contraseña,usuario)
            VALUES('$nombre','$correo','$contraseña',$usuario)";
    $ejecutar= mysqli_query($conexion, $query) ;
?>  
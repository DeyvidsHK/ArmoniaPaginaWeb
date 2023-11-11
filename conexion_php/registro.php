<?php

    $nombre = $_POST["nombre"]; 
    $correo = $_POST["correo"]; 
    $usuario = $_POST["usuario"]; 
    $contraseña = $_POST["contraseña"]; 

    $query = "INSERT INTO clientes(nombre,correo,contraseña,Usuario)
            VALUES('$nombre','$correo','$contrasela',$usuario)";
?>
<?php

    include ("conexion_lg.php");

    $nombre = $_POST["nombre"]; 
    $correo = $_POST["correo"]; 
    $usuario = $_POST["usuario"]; 
    $contrasena = $_POST["contrasena"];
    $contrasena = hash("sha512", $contrasena);

    $query = "INSERT INTO clientes(nombre,correo,usuario,contrasena)
            VALUES('$nombre','$correo','$usuario','$contrasena')";

    $verificar = mysqli_query($conexion, "SELECT * FROM clientes WHERE correo='$correo' ");

    if (mysqli_num_rows($verificar) > 0){
        echo "
            <script>
                alert('Usuario ya registrado, Ingrese otro');
                window.location = '../login.php';
            </script>
        "; 
        exit();
    }


    $ejecutar= mysqli_query($conexion, $query) ;

    if($ejecutar){ 
        echo "
            <script>
                alert('Usuario almacenado');
                window.location = '../login.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Error al almacenar usuario');
                window.location = '../login.php';
            </script>
        ";
    }

    mysqli_close($conexion);
?>

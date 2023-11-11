<?php

    include ("conexion_lg.php");

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $validar_lg = mysqli_query($conexion, "SELECT * FROM clientes WHERE correo= '$correo' and contrasena='$contrasena' ") ; 

    if (mysqli_num_rows($validar_lg)>0){
        header("location: ../tienda.php"); 
        
    }else{
        echo "
            <script>
                alert('Usuario no registrado');
                window.location = '../login.php';
            </script>
        ";
    }
?>
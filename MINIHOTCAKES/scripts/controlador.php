<?php

if(!empty($_POST["btnIngresar"])){
    if(empty($_POST["usuario"]) and empty($_POST["contrasena"])){
        echo '<div class="alert alert-danger" >LOS CAMPOS ESTAN VACIOS</div>';
    }else{
        $usuario = $_POST['usuario'];
        $pass = $_POST['contrasena'];

        $sql=$conexion->query("SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena='$pass'");
        if($datos=$sql->fetch_object()){
            header('location: admin_page.php');
        }else{
            echo '<div class="alert alert-danger">ACCESO DENEGADO</div>';
        }


    }
}

?>
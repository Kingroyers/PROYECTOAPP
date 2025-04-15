<?php

require_once '../Model/LoginModel.php';
require_once '../Model/conexionbd.php';

class loginController{

    function loginValidar()
    {
        session_start();

        if(isset($_POST['btnlogin'])){
           if(!empty($_POST['correo']) && !empty($_POST['pass'])){
                $correo = $_POST['correo'];
                $contraseña = $_POST['pass'];
        
                $conexion = new ConexionBD();
                $conexion->getConexion();
            
                $sql = "select * from login where correo ='$correo'and contraseña='$contraseña'";
                $result = $conexion->getConexion()->query($sql);
        
                if ($datos=$result->fetch_assoc()) {

                    $_SESSION['id_login'] = $datos->id_login;
                    $_SESSION['nombre_usuario'] = $datos->nombre_usuario;
                    $_SESSION['apellido'] = $datos->apellido;

                    header("Location: ../dashboard.php");
                } else {
                    echo '<div class="alert alert-danger fs-6">Acceso denegado</div>';
                }
            }else{
                echo '<div class="alert alert-danger fs-6">Por favor complete todos los campos</div>';

           }
        }



    //   session_start();

    //     if (isset($_POST['btnlogin'])) {
            
    //         $correo = $_POST['correo'];
    //         $contraseña = $_POST['pass'];
        
    //         $login = new LoginModel();
    //         $usuario = $login->loginValidar($correo, $contraseña);
        
    //         if ($usuario == true) {
                
                
    //             $_SESSION['nombre_usuario'];

    //             header("Location: ../dashboard.php");
                
    //         } else {
    //             echo '<div class="alert alert-danger fs-6">Acceso denegado</div>';
    //         }
    //     }
        
    }

    function cerrarSesion(){
        session_start();
        session_destroy();
        header("Location: ../index.php");
    }
}
?>
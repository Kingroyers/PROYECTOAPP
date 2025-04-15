<?php

require_once '../Model/LoginModel.php';
require_once '../Model/conexionbd.php';

class loginController
{

    function loginValidar()
    {


        if (isset($_POST['btnlogin'])) {
            if (!empty($_POST['correo']) && !empty($_POST['pass'])) {
                $correo = $_POST['correo'];
                $contraseña = $_POST['pass'];

                $conexion = new ConexionBD();
                $conexion->getConexion();

                $sql = "select * from login where correo ='$correo'and contraseña='$contraseña'";
                $result = $conexion->getConexion()->query($sql);

                if ($datos = $result->fetch_assoc()) {
                    // echo '<pre>';
                    // print_r($datos);  // 👈 Muestra lo que tiene la fila
                    // echo '</pre>';
                    // exit();
                    session_start();
                    $_SESSION['id_login'] = $datos['id_login'];
                    $_SESSION['nombre_usuario'] = $datos['nombre_usuario'];
                    $_SESSION['apellido'] = $datos['apellido'];



                    header("Location: ../dashboard.php");
                    exit();
                } else {
                    echo '<div class="alert alert-danger fs-6">Acceso denegado</div>';
                }
            } else {
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

   function registrarUsuario()
    {
        if (isset($_POST['btnRegistrar'])) {
            if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo_register']) && !empty($_POST['id']) && !empty($_POST['contraseña'])) {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $correo = $_POST['correo_register'];
                $identificacion = $_POST['id'];
                $contraseña = $_POST['contraseña'];

                $login = new LoginModel();
                $usuario = $login->registrarUsuario($nombre, $apellido, $correo, $identificacion, $contraseña);

                if ($usuario == true) {
                    echo '<div class="alert alert-success fs-6">Usuario registrado correctamente</div>';
                } else {
                    echo '<div class="alert alert-danger fs-6">Error al registrar el usuario</div>';
                }
            } else {
                echo '<div class="alert alert-danger fs-6">Por favor complete todos los campos</div>';
            }
        }
    }
}

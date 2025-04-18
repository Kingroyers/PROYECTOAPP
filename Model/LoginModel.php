<?php
require_once 'conexionbd.php';
class LoginModel{

    


    function loginValidar($correo, $contraseña)
    { 
        

        $conexion = new ConexionBD();
        $conexion->getConexion();
    
        $sql = "select * from login where correo ='$correo'and contraseña='$contraseña'";
        $result = $conexion->getConexion()->query($sql);

    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['id_login'] = $row->id_login;
            $_SESSION['nombre_usuario'] = $row->nombre_usuario;
            $_SESSION['id_usuario'] = $row->id_usuario;

            if ($row['correo'] == $correo && $row['contraseña'] == $contraseña) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
            
        }
    }

    function registrarUsuario($nombre, $apellido, $correo, $identificacion, $contraseña)
    {
        $conexion = new ConexionBD();
        $conexion->getConexion();

        $sql = "INSERT INTO login (id_usuario, nombre_usuario, apellido, correo, contraseña) VALUES ('$identificacion','$nombre', '$apellido', '$correo', '$contraseña')";
        if ($conexion->getConexion()->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function UsuarioExiste($id_usuario)
    {
        $conexion = new ConexionBD();
        $db = $conexion->getConexion();
        $sql = "SELECT Identificacion FROM usuarios WHERE Identificacion = '$id_usuario'";
        $result = $db->query($sql);
    
        if ($result->num_rows > 0) {
            return true;  // Usuario encontrado
        } else {
            return false; // Usuario no encontrado
        }
    }
    
}
?>


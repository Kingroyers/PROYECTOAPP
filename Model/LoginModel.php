<?php
require_once 'conexionbd.php';
class LoginModel{

    


    function loginValidar($correo, $contraseña)
    {
        $conexion = new ConexionBD();
        $conexion->getConexion();
    
        $sql = "select * from login where correo='$correo'and contrasena='$contraseña'";
        $result = $conexion->getConexion()->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['correo'] == $correo && $row['contrasena'] == $contraseña) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
            
        }
    }
}
?>


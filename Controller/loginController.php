<?php

require_once '../Model/LoginModel.php';

class loginController{

    function loginValidar()
    {
        if (!empty($_POST['btn_login'])) {
           
            $correo = $_POST['correo'];
            $contraseña = $_POST['contraseña'];
        
            $login = new LoginModel();
            $usuario = $login->loginValidar($correo, $contraseña);
        
            if ($usuario == true) {
                $_SESSION['usuario'] = $usuario;
                header("Location: /dashboard.php");
                
            } else {
                echo '<div class="alert alert-danger">Correo o contraseña incorrectos</div>';
            }
        }
        
    }
}
?>
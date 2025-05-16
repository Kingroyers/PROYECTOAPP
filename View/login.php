<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/estilos.css">
    <title>Login</title>
</head>

<body class="position-relative d-flex justify-content-center align-items-center">
    <a href="../index.php" class="position-absolute top-0 my-4" style="z-index: 100; text-decoration: none; color: #fff;"><img src="../src/img/inconos/logo.png" alt="">FITNESS LIFE</a>
    <div class=" d-flex flex-column justify-content-center align-items-center" style="background-color: #101116; width: 100vh; height: 100vh;">
        <?php
        require_once '../Controller/loginController.php';
        $login = new loginController();
        $login->loginValidar();
        ?>
        <form method="post" action="" class="w-lg-100 p-4 text-white h-auto mt-sm-5" style="border: 1px solid #fff; border-radius: 10px 10px 10px 50px; min-width: 300px; max-width: 350px; background-color: #101116;" id="formulario_login">
            <div class="mb-3 text-white  my-4" style="box-sizing: border-box;">
                <label class="form-label">Correo</label>
                <input type="text" class="form-control formulario__input" name="correo" placeholder="usuario@example.com" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;" maxlength="50">
                <p class="formulario__input-error" style="font-size: 9px; margin-top: 10px;">Introduce un correo electrónico válido. Ej: usuario@example.com</p>
            </div>
            <div class="mb-3 text-white  my-5">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control formulario__input" name="pass" placeholder="***************" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;" maxlength="50">
                <p class="formulario__input-error" style="font-size: 9px;">La contraseña debe tener al menos 8 caracteres, incluyendo una mayúscula, una minúscula y un número.</p>
            </div>
            <div class="mb-3 text-white" style="display: flex; justify-content: right;">
                <a href="RecuperarContraseña.php" style="font-size: 10px; font-family: Arial, Helvetica, sans-serif;">¿olvidaste tu contraseña?</a>
            </div>
            <button type="submit" class="btn btn-primary my-4 w-100" name="btnlogin">Iniciar Sesion</button>
        </form>
    </div>
    <script src="../src/js/bootstrap.bundle.min.js"></script>
    <script src="/ProyectoApp/src/js/formularioLogin.js"></script>
</body>

</html>
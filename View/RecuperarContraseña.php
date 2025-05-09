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

   <div class="container-fluid d-flex justify-content-center align-items-center">

   <div class=" d-flex flex-column justify-content-center align-items-center" style="background-color: #101116; width: 100vh; height: 100vh;">
        <?php
        require_once '../Controller/loginController.php';
        $login = new loginController();
        $login->RecuperarContraseña();
        ?>


        <form method="post" action="" class="w-lg-100 p-4 text-white mt-sm-5" style="height: 450px; max-width: 350px; border: 1px solid #fff; border-radius: 10px 10px 10px 50px; background-color: #101116;">


        <h4 class="text-center mb-3">¿Olvidaste tu contraseña?</h4>
        <p class="text-center" style="font-size: 13px; color: #ccc;">
            Ingresa tu correo y se le enviará la contraseña a su correo.
        </p>
            <div class="mb-3 text-white  my-5">

                <label class="form-label">Correo</label>
                <input type="text" class="form-control" name="correo" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;">

            </div>


            <button type="submit" class="btn btn-primary my-5 w-100" name="btnRC">Recuperar Contraseña</button>
        </form>
    </div>
   </div>





    <script src="../src/js/bootstrap.bundle.min.js"></script>
</body>

</html>
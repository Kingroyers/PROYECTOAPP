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

    <div class=" d-flex justify-content-center align-items-center" style="background-color: #101116; width: 100vh; height: 100vh;">





        <form method="post" action="" class="w-lg-100 p-4 text-white h-auto mt-sm-5" style="border: 1px solid #fff; border-radius: 10px 10px 10px 50px; min-width: 300px; background-color: #101116;">

            <div class="mb-3 text-white  my-4">
                <?php
                require_once '../Controller/loginController.php';
                 $login = new loginController();
                 $login->loginValidar();
                ?>
                <label for="exampleInputEmail1" class="form-label">Correo</label>
                <input type="text" class="form-control" name="correo"  placeholder="usuario@example.com" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;">

            </div>

            <div class="mb-3 text-white  my-5">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contraseña" placeholder="***************" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;">
            </div>

            <div class="mb-3 form-check text-white ">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1" style="font-size: 10px;">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-primary my-4 w-100" name="btnlogin">Iniciar Sesion</button>
        </form>
    </div>





    <script src="../src/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/estilos.css">
    <title>Register</title>
</head>

<body class="d-flex justify-content-center align-items-center vh-100 position-relative" style="background-color: #f8f9fa;  background-color: #101116;">
    <div class="p-4 bg-transparent position-absolute" style="max-width: 390px; width: 100%; border: 1px solid #ffffff38; border-radius: 40px;">

        <h2 class="text-center text-primary my-4">Registro</h2>
        <?php
        include_once '../Controller/loginController.php';
        $login = new loginController();
        $login->registrarUsuario();
        ?>
        <form class="text-white" action="" method="post">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="nombre" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;" required >
                </div>
                <div class="col">
                    <label class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido" placeholder="Apellido" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Identificacion</label>
                <input type="number" class="form-control" name="id" placeholder="CC:" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="correo_register" placeholder="Usuario@example.com" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="***************" style="font-size: 14px; font-family: Arial, Helvetica, sans-serif;" required>
                    <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword()">
                        <img src="../src/img/inconos/ojoabierto.png" id="iconoContraseña" width="20px"></img>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100" name="btnRegistrar">Enviar</button>
        </form>
        <p class="text-center mt-3" style="color: #dadada;">¿Ya tienes una cuenta? <a href="../View/login.php" style="text-decoration: none; color: #007bff;">Inicia sesión</a></p>

    </div>

    
    <script src="../src/js/bootstrap.bundle.min.js"></script>
    <script src="../Model/funcionPass.js" ></script>
</body>

</html>
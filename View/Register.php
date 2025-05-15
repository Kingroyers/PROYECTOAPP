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
        <form class="text-white" action="" method="post" id="formulario_registrar">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control formulario__input" name="nombre" placeholder="Nombre" maxlength="50" required>
                    <p class="formulario__input-error">El nombre debe contener solo letras y espacios, mínimo 3 caracteres.</p>
                </div>
                <div class="col">
                    <label class="form-label">Apellido</label>
                    <input type="text" class="form-control formulario__input" name="apellido" placeholder="Apellido" maxlength="50" required>
                    <p class="formulario__input-error">El apellido debe contener solo letras y espacios, mínimo 3 caracteres.</p>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Identificación</label>
                <input type="text" class="form-control formulario__input" name="id" placeholder="CC:" maxlength="10" required>
                <p class="formulario__input-error">La identificación debe contener entre 7 y 10 dígitos numéricos.</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control formulario__input" name="correo_register" placeholder="usuario@example.com" maxlength="50" required>
                <p class="formulario__input-error">Introduce un correo electrónico válido.</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control formulario__input" id="contraseña" name="contraseña" placeholder="***************" maxlength="50" required>
                    <p class="formulario__input-error">Debe tener al menos 8 caracteres, incluyendo una mayúscula, una minúscula, un número y un carácter especial.</p>
                    <span class="input-group-text" style="cursor: pointer;" onclick="togglePassword()">
                        <img src="../src/img/inconos/ojoabierto.png" id="iconoContraseña" width="20px">
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="btnRegistrar">Enviar</button>
        </form>
        <p class="text-center mt-3" style="color: #dadada;">¿Ya tienes una cuenta? <a href="../View/login.php" style="text-decoration: none; color: #007bff;">Inicia sesión</a></p>
    </div>
    <script src="../src/js/bootstrap.bundle.min.js"></script>
    <script src="../Model/funcionPass.js"></script>
    <script src="/ProyectoApp/src/js/formularioRegistrar.js"></script>
</body>

</html>
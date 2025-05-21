<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../src/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../src/estilos.css" />
    <base href="http://localhost/ProyectoAPP/" />
    <title>Configuración</title>
    <style>
        .formulario__input-error {
            display: none;
            color: red;
            font-size: 0.9em;
            margin-top: 3px;
        }
    </style>
</head>

<body class="d-flex position-relative align-items-center bg-white flex-column">

    <div class="d-flex justify-content-center align-items-center w-100">
        <div class="container-xxl position-relative d-flex flex-column" style="width: 100%; height: 100vh;">

            <?php
            include_once '../Controller/loginController.php';
            $loginController = new loginController();
            $loginController->actualizarPerfil();
            ?>

            <div class="container-fluid justify-content-center align-items-center d-flex">
                <form class="container mt-5" action="" method="post" id="formulario_registrar" novalidate>
                    <h3 class="mb-4">Configuración de perfil</h3>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label class="form-label" for="nombre">Nombre</label>
                        <div class="d-flex">
                            <input type="text" class="form-control me-2" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>" disabled />
                            <button class="btn btn-outline-primary" type="button" onclick="habilitarCampo('nombre')">Editar</button>
                        </div>
                        <p class="formulario__input-error">El nombre debe contener solo letras, mínimo 3 caracteres.</p>
                    </div>

                    <!-- Apellido -->
                    <div class="mb-3">
                        <label class="form-label" for="apellido">Apellido</label>
                        <div class="d-flex">
                            <input type="text" class="form-control me-2" id="apellido" name="apellido" value="<?php echo htmlspecialchars($_SESSION['apellido']); ?>" disabled />
                            <button class="btn btn-outline-primary" type="button" onclick="habilitarCampo('apellido')">Editar</button>
                        </div>
                        <p class="formulario__input-error">El apellido debe contener solo letras, mínimo 3 caracteres.</p>
                    </div>

                    <!-- Correo -->
                    <div class="mb-3">
                        <label class="form-label" for="correo">Correo electrónico</label>
                        <div class="d-flex">
                            <input type="email" class="form-control me-2" id="correo" name="correo" value="<?php echo htmlspecialchars($_SESSION['correo']); ?>" disabled />
                            <button class="btn btn-outline-primary" type="button" onclick="habilitarCampo('correo')">Editar</button>
                        </div>
                        <p class="formulario__input-error">Introduce un correo electrónico válido.</p>
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label class="form-label" for="password">Contraseña</label>
                        <div class="d-flex">
                           <input type="password" class="form-control me-2" id="password" name="password" maxlength="50" placeholder="********" value="" disabled />
                            <button class="btn btn-outline-primary" type="button" onclick="habilitarCampo('password')">Editar</button>
                        </div>
                        <p class="formulario__input-error" style="font-size: 0.8em;">
                            Debe tener al menos 8 caracteres, incluyendo una mayúscula, una minúscula y un número
                        </p>
                    </div>

                    <button class="btn btn-primary mt-3 w-100" type="submit" name="actualizarPerfil">Guardar cambios</button>
                </form>
            </div>

            <?php include_once __DIR__ . '/componentes/menu.php'; ?>
        </div>
    </div>

    <script src="/ProyectoAPP/src/js/bootstrap.min.js"></script>
    <script src="/ProyectoAPP/src/js/formularioConfig.js"></script>
</body>

</html>

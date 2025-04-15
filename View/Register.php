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

        <form class="text-white" action="" method="post">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="nombre" required>
                </div>
                <div class="col">
                    <label class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Identificacion</label>
                <input type="text" class="form-control" name="id" placeholder="CC:" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="correo_register" placeholder="Usuario@example.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contraseña" placeholder="***************" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
        <p class="text-center mt-3" style="color: #dadada;">¿Ya tienes una cuenta? <a href="../View/login.php" style="text-decoration: none; color: #007bff;">Inicia sesión</a></p>

    </div>


    <script src="../src/js/bootstrap.bundle.min.js"></script>
</body>

</html>
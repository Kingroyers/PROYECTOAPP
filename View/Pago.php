<?php require '../Controller/PlanesController.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/estilos.css">
    <base href="http://localhost/ProyectoAPP/">
    <title>Pago - APP</title>
</head>

<body class="bg-white">
    <?php include '../View/componentes/barraPrincipal.php'; ?>
    <div class="container-xxl position-relative d-flex flex-column">
        <main style="height: auto;">
            <div class="container mt-4">
                <div class="card shadow-lg p-4">
                    <?php
                    $nombre_plan = isset($_GET['nombre_plan']) ? $_GET['nombre_plan'] : 'Desconocido';
                    $precio = isset($_GET['precio']) ? $_GET['precio'] : '0';
                    ?>

                    <h4 class="card-title">Formulario de Pago para el Plan <strong><?php echo htmlspecialchars($nombre_plan); ?></strong></h4>
                    <p><strong>Precio a pagar:</strong> $<?php echo number_format($precio, 2); ?> COP</p>

                    <form action="/ProyectoAPP/Controller/PagoController.php" method="POST">
                        <input type="hidden" name="id_plan" value="<?php echo $_GET['id_plan']; ?>">
                        <div class="form-group mb-2">
                            <label>Nombre del Titular</label>
                            <input type="text" name="titular" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Número de Tarjeta</label>
                            <input type="text" name="numero_tarjeta" class="form-control" maxlength="16" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Fecha de Caducidad</label>
                            <input type="month" name="caducidad" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Código de Seguridad</label>
                            <input type="text" name="codigo_seguridad" class="form-control" maxlength="4" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Identificación</label>
                            <input type="text" name="identificacion" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Pagar</button>
                    </form>
                </div>
            </div>
        </main>
        <?php include '../View/componentes/menu.html'; ?>
        <script src="/ProyectoAPP/src/js/bootstrap.min.js"></script>
    </div>
</body>

</html>
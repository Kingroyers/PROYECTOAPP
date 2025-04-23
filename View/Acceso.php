<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../src/estilos.css">
    <base href="http://localhost/ProyectoAPP/">
    <title>Acceso-APP</title>
</head>

<body class="bg-white">
    <?php include '../ProyectoAPP/View/componentes/barraPrincipal.php' ?>
    <p style="margin: 30px 0 0 10px; display: flex; justify-content: space-between;">ACCESO</p>
    <hr style="margin: 0;">
    <main style="height: auto">
        <div class="container mt-5">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body text-center">
                    <p>CÓDIGO QR</p>
                    <?php
                    include '../Controller/AccesoController.php';
                    $controller = new AccesoController();
                    $controller->mostrar_qr();
                    ?>
                    <p>ESCANEAME!</p>
                </div>
            </div>
        </div>
    </main>
    <?php include '../ProyectoAPP/View/componentes/menu.html' ?>
    <script src="../ProyectoAPP/src/js/bootstrap.min.js"></script>
</body>

</html>
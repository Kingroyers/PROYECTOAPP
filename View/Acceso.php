<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/estilos.css">
<<<<<<< HEAD
    <base href="http://localhost/ProyectoAPP/">
    <title>Acceso-APP</title>
=======
    <title>Acceso</title>
>>>>>>> 0896699661c6374637fb04b2b52292d828766c96
</head>

<body class="bg-white">
    <?php include '../View/componentes/barraPrincipal.php' ?>
    <div class="container-xxl position-relative d-flex flex-column">
        <main style="height: auto;">
            <p style="margin: 30px 0 0 10px; display: flex; justify-content: space-between;">ACCESO</p>
            <hr style="margin-bottom: 20px;">
            <div class="row d-flex justify-content-center align-content-center" style=" margin-top: 0; padding: 0 0 10px 0;">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-375px">
                    <div class="card bg-secondary text-white mb-4" style="border-radius: 40px;">
                        <div class="card-body text-center">
                            <p>CÓDIGO QR</p>
                            <?php
                            include '../Controller/AccesoController.php';
                            $controller = new AccesoController();
                            $controller->mostrar_qr();
                            ?>
                            <p style="margin-top: 20px;">ESCANEAME!</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php include '../View/componentes/menu.html' ?>
    </div>
</body>

</html>
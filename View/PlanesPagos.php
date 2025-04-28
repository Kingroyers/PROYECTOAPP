<?php require '../Controller/PlanesController.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/estilos.css">
    <base href="http://localhost/ProyectoAPP/">
    <title>Planes y Pago - APP</title>
</head>

<body class="bg-white">
    <?php include '../View/componentes/barraPrincipal.php' ?>
    <div class="container-xxl position-relative d-flex flex-column">
        <main style="height: auto;">
            <p style="margin: 30px 0 0 10px; display: flex; justify-content: space-between;">PLANES</p>
            <hr style="margin-bottom: 20px;">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 mx-375px">
                <?php
                $first = true;
                foreach ($planes as $plan) : ?>
                    <div class="card mx-auto shadow-lg" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h3 class="card-title"><strong>Plan </strong><?php echo $plan['nombre_plan']; ?></h3>
                            <p class="card-text"><strong>Beneficios</strong><br><?php echo nl2br(htmlspecialchars($plan['beneficios'])); ?></p>
                            <p class="card-text"><strong>Precio:</strong> $<?php echo number_format($plan['precio'], 2); ?> COP</p>
                            <button class="btn btn-primary" onclick="redirigirPago(<?php echo $plan['id_plan']; ?>)">Seleccionar</button>
                        </div>
                    </div>
                <?php
                    $first = false;
                endforeach;
                ?>
            </div>
        </main>
        <?php include '../View/componentes/menu.html' ?>
        <script src="/ProyectoAPP/src/js/bootstrap.min.js"></script>
    </div>
</body>

</html>
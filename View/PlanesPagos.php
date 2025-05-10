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
            <div class="container-fluid mt-4 w-100 w-sm-100" style="padding: 1em;">
                <div id="scrollContainer" class="wrapper d-flex" style="overflow-x: auto; padding-bottom: 1em; scroll-behavior: smooth;">
                    <?php
                    $first = true;
                    foreach ($planes as $index => $plan) : ?>
                        <div class="card mx-2 shadow-lg text-white" style="width: 18rem; flex: 0 0 auto; border-radius: 40px; background-color: #101116;" id="card-<?php echo $index; ?>">
                            <div class="card-body text-left">
                                <h3 class="card-title mt-3 mb-3"><strong>Plan </strong><?php echo $plan['nombre_plan']; ?></h3>
                                <p class="card-text" style="font-size: 0.75rem;"><strong>Beneficios</strong><br><?php echo nl2br(htmlspecialchars($plan['beneficios'])); ?></p>
                                <p class="card-text"><strong>Precio:</strong> $<?php echo number_format($plan['precio'], 2); ?> COP</p>
                                <div class="text-center">
                                    <button class="btn btn-primary" onclick="redirigirPago(<?php echo $plan['id_plan']; ?>)">Seleccionar</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
        <?php include '../View/componentes/menu.html' ?>
        <script src="/ProyectoAPP/src/js/bootstrap.min.js"></script>
    </div>
</body>

</html>
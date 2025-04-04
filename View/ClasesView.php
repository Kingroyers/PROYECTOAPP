<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/estilos.css">
    <base href="http://localhost/ProyectoAPP/">
    <title>Proximas Clases</title>
</head>
<body class="d-flex position-relative align-items-center bg-white flex-column">

    <!---Barra principal-->
    <?php include '../View/componentes/barraPrincipal.html' ?>

    <div class="container mt-5">
    <h2>Clases Disponibles</h2>

    <div class="col-12 d-flex flex-wrap" style="border: 1px solid;">
       
    
    <?php
        require_once "../Controller/ClaseController.php"; // Asegúrate de que la ruta sea correcta
        $claseController = new ClaseController();
        $claseController->obtenerClases(); // Llama al método para mostrar las clases
        ?>
    
    </div>
</div>



    <?php include '../View/componentes/menu.html' ?>

    <script src="/ProyectoAPP/src/js/bootstrap.min.js"></script>
</body>
</html>
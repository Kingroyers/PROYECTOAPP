<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../src/estilos.css">
    <base href="http://localhost/ProyectoAPP/">
    <title>Proximas Clases</title>
</head>

<body class="d-flex position-relative align-items-center bg-white flex-column">

    <style>
        .dia:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .hoy {
            background-color: #2F3148 !important;
            color: white !important;
            font-weight: bold;
            border: 2px solid #0056b3;
            transform: scaleY(1.1);
            /* Escalar verticalmente */

        }

        #contenedor-dias {
            scroll-snap-type: x mandatory;
        }



        .dia p {
            margin: 0;
        }

        .numero-dia {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nombre-dia {
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .dia {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 999px;
            min-width: 60px;
            text-align: center;
            background: #fff;
        }

        .activo {
            background: #000;
            color: #fff;
        }
    </style>

    <?php include '../View/componentes/barraPrincipal.php' ?>

    <div class="col-12 d-flex justify-content-center my-2">
        <div class='d-flex  overflow-x-auto p-2' id="contenedor-dias" style='width: 100%; padding: 1em; scrollbar-width: none; scroll-behavior: smooth; '>
            <?php
            require_once "../Controller/ClaseController.php";
            $claseController = new ClaseController();
            $claseController->ObtenerDiaSemana();
            ?>
        </div>
    </div>



    <div class="container mt-5">
        <h2>Clases De la semana</h2>
        <hr>
        <?php
        //   require_once '../Controller/ClaseController.php';
        //   $claseController = new ClaseController();
        //   $usuarioExiste = $claseController-> 
        
        ?>

        <div class="col-12 d-flex flex-wrap mb-5">


            <?php
            require_once "../Controller/ClaseController.php";
            $claseController = new ClaseController();
            $claseController->mostrarClasesPorFecha();
            ?>



        </div>
    </div>



    <?php include '../View/componentes/menu.html' ?>

    <script src="/ProyectoAPP/src/js/bootstrap.min.js"></script>
    <!-- <script>
window.onload = function () {
    const activo = document.querySelector('.activo');
    const container = document.getElementById('semana');

    if (activo) {
        const offset = activo.offsetLeft - (container.offsetWidth / 2) + (activo.offsetWidth / 2);
        container.scrollLeft = offset;
    }
}
</script> -->


<script src="src/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
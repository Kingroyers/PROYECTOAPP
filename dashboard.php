<?php
session_start();

if (empty($_SESSION['id_login'])) {
    header("Location: index.php");
}

include_once "Model/ClaseModel.php";
$controller = new ModeloClases();
$controller->eliminarAsistenciasDomingo();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/estilos.css">
    <title>Dashboard-APP</title>
</head>

<body class="d-flex position-relative align-items-center bg-white flex-column">

    
    <?php include '../ProyectoAPP/View/componentes/barraPrincipal.php' ?>

    <?php #echo '<pre>';
    #print_r($_SESSION);  
    #echo '</pre>'; 
    ?>

    <div class=" d-flex justify-content-center align-items-center  w-100 ">


        <div class="container-xxl position-relative d-flex flex-column">


            <main style="height: auto;">


                <a href="View/ClasesView.php" class="text-black text-decoration-none">
                    <p style="margin: 30px 0 0 10px; display: flex; justify-content: space-between;">proximas clases <i class="bi bi-chevron-double-right"></i></p>
                </a>
                <hr style="margin: 0;">

                <div class="row d-flex justify-content-center align-content-center" style=" margin-top: 0; padding: 0 0 10px 0; margin-bottom: 50px;">

                    <?php include '../ProyectoAPP/View/componentes/ProximasClases.php' ?>


                    <p style="margin: 10px 0 10px 0;">Nuestra coleccion</p>
                    <hr>

                    <div class="row" style="padding: 1em; justify-self: center; ">


                        <figure class="cartas-rutinas col-12 col-md-4" style="position: relative;">
                            <a href="https://www.youtube.com/watch?v=oCtrksNCiKk"
                                style="color: #101116; text-decoration: none;" target="_blank">
                                <div class="fondo-rutina col10 col-md-4 d-flex flex-row justify-content-between" style="border-radius: 10px; box-shadow: 5px 5px 35px #3f55762f; width: 100%;">

                                    <div class="" style=" margin: 10px 10px ; z-index: 100;">
                                        <p style="margin-top: 60px; margin-left: 10px; margin-bottom: 10px; color: #fff; font-size: 20px;">
                                            Espalda y Hombros</p>

                                    </div>
                                    <div class="" style="position: absolute; bottom: 10px; left: 17px; color: #fff; font-size: 10px;">
                                        <img src="src/img/inconos/IonTime.png" alt="icono time" style="width: 20px;"> 5:08m
                                        <img src="src/img/inconos/MdiStar.png" alt="icono star" style="width: 20px;"> 4.5
                                    </div>

                                    <div class="position-relative"><img class="img-fluid
                                     position-absolute bottom-0" src="src/img/espalda.png" alt=""
                                            style="min-width: 70px; max-width: 140px; right: 0; "></div>

                                </div>
                            </a>
                        </figure>

                        <figure class="cartas-rutinas col-12 col-md-4">
                            <a href="https://www.youtube.com/watch?v=VB09kLgJDo0" target="_blank" style="color: #101116; text-decoration: none;">
                                <div class="fondo-rutina  col10 col-md-4 d-flex flex-row justify-content-between" style=" max-height: 160px; border-radius: 10px; background-color: #101116; box-shadow: 5px 5px 35px #3f55762f; width: 100%;">

                                    <div class=" d-flex flex-wrap" style=" margin: 10px 10px ; z-index: 100;">
                                        <p class="text-white"
                                            style="margin-top: 60px; margin-left: 10px; font-size: 20px;">Pecho y
                                            Abdomen</p>

                                    </div>
                                    <div class="" style="position: absolute; bottom: 10px; left: 17px; color: #fff; font-size: 10px;">
                                        <img src="src/img/inconos/IonTime.png" alt="icono time" style="width: 20px;"> 4:53m
                                        <img src="src/img/inconos/MdiStar.png" alt="icono star" style="width: 20px;"> 4
                                    </div>

                                    <div class="position-relative"><img class="img-fluid
                                        position-absolute bottom-0" src="src/img/Abdomen-fotos.png" alt=""
                                            style="height: 100%; min-width: 70px; max-width: 200px; right: 0; mask-image: linear-gradient(black 89%, transparent);  filter: drop-shadow(0 0 10px rgb(0, 0, 0));">
                                    </div>
                                </div>
                            </a>

                        </figure>

                        <figure class="cartas-rutinas col-12 col-md-4">
                            <a href="https://www.youtube.com/watch?v=_hkUNgX9e54" target="_blank" style="color: #101116; text-decoration: none;">
                                <div class="fondo-rutina col10 col-md-4 d-flex flex-row justify-content-between" style="border-radius: 10px; box-shadow: 5px 5px 35px #3f55762f; width: 100%;">

                                    <div class="" style=" margin: 10px 10px ; z-index: 100;">
                                        <p style="margin-top: 60px; margin-left: 10px; color: #fff; font-size: 20px;">
                                            Brazo</p>

                                    </div>
                                    <div class="" style="position: absolute; bottom: 10px; left: 17px; color: #fff; font-size: 10px;">
                                        <img src="src/img/inconos/IonTime.png" alt="icono time" style="width: 20px;"> 8:18m
                                        <img src="src/img/inconos/MdiStar.png" alt="icono star" style="width: 20px;"> 5
                                    </div>

                                    <div class="position-relative"><img class="img-fluid
                                     position-absolute bottom-0" src="src/img/biceps-fotos.png" alt=""
                                            style=" min-width: 90px; max-width: 240px; right: 0; mask-image: linear-gradient(black 89%, transparent);  filter: drop-shadow(0 0 10px rgb(0, 0, 0));">
                                    </div>

                                </div>
                            </a>
                        </figure>

                        <figure class="cartas-rutinas col-12 col-md-4">
                            <a href="https://www.youtube.com/watch?v=LFR7BPbLmTc"
                                style="color: #101116; text-decoration: none;" target="_blank">
                                <div class="fondo-rutina col10 col-md-4 d-flex flex-row justify-content-between"
                                    style="border-radius: 10px; box-shadow: 5px 5px 35px #3f55762f; width: 100%;">

                                    <div class="" style=" margin: 10px 10px ; z-index: 100;">
                                        <p style="margin-top: 60px; margin-left: 10px; color: #fff; font-size: 20px;">
                                            Pierna y Gluteos</p>

                                    </div>
                                    <div class="" style="position: absolute; bottom: 10px; left: 17px; color: #fff; font-size: 10px;">
                                        <img src="src/img/inconos/IonTime.png" alt="icono time" style="width: 20px;"> 7:13m
                                        <img src="src/img/inconos/MdiStar.png" alt="icono star" style="width: 20px;"> 4.5
                                    </div>

                                    <div class="position-relative"><img class="img-fluid
                                     position-absolute bottom-0" src="src/img/Abdomen.png" alt=""
                                            style=" min-width: 40px; max-width: 220px; right: 0; mask-image: linear-gradient(black 89%, transparent);  filter: drop-shadow(0 0 10px rgb(0, 0, 0));">
                                    </div>

                                </div>
                            </a>
                        </figure>

                    </div>



                    <p style="margin: 30px 0 10px 0;">Nuestro Equipo</p>
                    <hr>

                    <?php include '../ProyectoAPP/View/componentes/NuestroEquipo.php' ?>

                    <p style="margin: 30px 0 10px 0;">Clases Agendadas</p>
                    <hr>

                    <div class="container-fluid mt-4 w-100 w-sm-100" style="padding: 1em;">
                        <div class="wrapper d-flex" style=" overflow-x: auto; padding-bottom: 1em;">

                            <?php
                            include_once 'Controller/ClaseController.php';

                            $controller = new ClaseController();
                            $controller->MostrarCLasesInscritas();

                            ?>
                        </div>    
                    </div>

                </div>

            </main>





            <!-------------- menu ---------------->
            <?php include '../ProyectoAPP/View/componentes/menu.html' ?>

        </div>

        <script src="../ProyectoAPP/src/js/bootstrap.min.js"></script>
</body>

</html>
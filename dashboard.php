<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/estilos.css">
    <title>Dashboard</title>
</head>

<body class="d-flex position-relative align-items-center bg-white flex-column">
    <!---Barra principal-->

    <?php include '../ProyectoAPP/View/componentes/barraPrincipal.html' ?>

    <div class=" d-flex justify-content-center align-items-center  w-100 ">

        <!--------------------------------------------------------------------------------->
        <div class="container-xxl position-relative d-flex flex-column">


            <main style="height: auto">


                <p style="margin: 30px 0 0 10px;">proximas clases</p>
                <hr style="margin: 0;">

                <div class="row d-flex justify-content-center align-content-center"
                    style=" margin-top: 0; padding: 0 0 10px 0;">

                    <!------------------------------------------------------------------------------->
                    <div class="container-fluid m-3 w-100 w-sm-100">

                        <div class="wrapper d-flex" style="max-height: 120px;  overflow-x: auto; height: 77px;">


                            <a href="#" style="text-decoration: none; color: #000;">
                                <div class="custom-proximas-clases item">

                                    <div class="row" style=" width: 100%;">

                                        <div class="col-4"
                                            style="display: flex; padding: 0; justify-content: center; align-items: center;">
                                            <img src="../src/img/running.png" alt="icons-running" width="40px"
                                                height="40px">
                                        </div>

                                        <div class="col-8"
                                            style="display: flex; justify-content: center; align-items: center;">
                                            <h6>Cardio</h6>

                                        </div>

                                    </div>

                                </div>
                            </a>

                            <a href="#" style="text-decoration: none; color: #000;">
                                <div class="custom-proximas-clases item">

                                    <div class="row" style=" width: 100%;">

                                        <div class="col-4"
                                            style="display: flex; padding: 0; justify-content: center; align-items: center;">
                                            <img src="../src/img/inconos/iconos-spinning.png" alt="icons-running"
                                                width="30px" height="30px">
                                        </div>

                                        <div class="col-8"
                                            style="display: flex; justify-content: center; align-items: center;">
                                            <h6>Spinning</h6>

                                        </div>

                                    </div>

                                </div>
                            </a>

                            <a href="#" style="text-decoration: none; color: #000;">
                                <div class="custom-proximas-clases item">

                                    <div class="row" style=" width: 100%;">

                                        <div class="col-4"
                                            style="display: flex; padding: 0; justify-content: center; align-items: center;">
                                            <img src="../src/img/inconos/icons-boxing.png" alt="icons-running"
                                                width="30px" height="30px">
                                        </div>

                                        <div class="col-8"
                                            style="display: flex; justify-content: center; align-items: center;">
                                            <h6>Boxing</h6>

                                        </div>

                                    </div>

                                </div>
                            </a>

                            <a href="#" style="text-decoration: none; color: #000;">
                                <div class="custom-proximas-clases item">

                                    <div class="row" style=" width: 100%;">

                                        <div class="col-4"
                                            style="display: flex; padding: 0; justify-content: center; align-items: center;">
                                            <img src="../csrc/img/inconos/icons-zumba.png" alt="icons-running"
                                                width="30px" height="30px">
                                        </div>

                                        <div class="col-8"
                                            style="display: flex; justify-content: center; align-items: center;">
                                            <h6>Zumba</h6>

                                        </div>

                                    </div>


                                </div>
                            </a>

                            <a href="#" style="text-decoration: none; color: #000;">
                                <div class="custom-proximas-clases item">

                                    <div class="row" style=" width: 100%;">

                                        <div class="col-4"
                                            style="display: flex; padding: 0; justify-content: center; align-items: center;">
                                            <img src="../src/img/Icons-Biceps.png" alt="icons-running" width="30px"
                                                height="30px">
                                        </div>

                                        <div class="col-8"
                                            style="display: flex; justify-content: center; align-items: center;">
                                            <h6 style="font-size: 14px;">IronCWout</h6>

                                        </div>

                                    </div>

                                </div>
                            </a>

                            <a href="#" style="text-decoration: none; color: #000;">
                                <div class="custom-proximas-clases item">

                                    <div class="row" style=" width: 100%;">

                                        <div class="col-4"
                                            style="display: flex; padding: 0; justify-content: center; align-items: center;">
                                            <img src="../src/img/icons-peso-rusa.png" alt="icons-running" width="40px"
                                                height="40px">
                                        </div>

                                        <div class="col-8"
                                            style="display: flex; justify-content: center; align-items: center;">
                                            <h6>CrossFit</h6>

                                        </div>

                                    </div>

                                </div>
                            </a>

                            <a href="#" style="text-decoration: none; color: #000;">
                                <div class="custom-proximas-clases item">

                                    <div class="row" style=" width: 100%;">

                                        <div class="col-4"
                                            style="display: flex; padding: 0; justify-content: center; align-items: center;">
                                            <img src="../src/img/Icons-Yoga.png" alt="icons-running" width="40px"
                                                height="40px">
                                        </div>

                                        <div class="col-8"
                                            style="display: flex; justify-content: center; align-items: center;">
                                            <h6>Yoga</h6>

                                        </div>

                                    </div>

                                </div>
                            </a>
                            <div class="custom-proximas-clases item">
                                8</div>

                        </div>
                    </div>
                    <!-------------------------------------------------------------------------------->

                    <p style="margin: 10px 0 10px 0;">Nuestra coleccion</p>
                    <hr>

                    <div class="row" style="padding: 1em; justify-self: center; ">


                        <figure class="cartas-rutinas col-12 col-sm-4">
                            <a href="https://www.youtube.com/watch?v=oCtrksNCiKk"
                                style="color: #101116; text-decoration: none;">
                                <div class="fondo-rutina col10 col-md-4 d-flex flex-row justify-content-between"
                                    style="border-radius: 10px; box-shadow: 5px 5px 35px #3f55762f; width: 100%;">

                                    <div class="" style=" margin: 10px 10px ; z-index: 100;">
                                        <p style="margin-top: 70px; margin-left: 10px; color: #fff; font-size: 20px;">
                                            Espalda y Hombros</p>

                                    </div>

                                    <div class="position-relative"><img class="img-fluid
                                     position-absolute bottom-0" src="../src/img/espalda.png" alt=""
                                            style="min-width: 70px; max-width: 140px; right: 0; "></div>

                                </div>
                            </a>
                        </figure>

                        <figure class="cartas-rutinas col-12 col-sm-4">
                            <a href="https://www.youtube.com/watch?v=VB09kLgJDo0"
                                style="color: #101116; text-decoration: none;">
                                <div class="fondo-rutina  col10 col-md-4 d-flex flex-row justify-content-between"
                                    style=" max-height: 160px; border-radius: 10px; background-color: #101116; box-shadow: 5px 5px 35px #3f55762f; width: 100%;">

                                    <div class=" d-flex flex-wrap" style=" margin: 10px 10px ; z-index: 100;">
                                        <p class="text-white"
                                            style="margin-top: 70px; margin-left: 10px; font-size: 20px;">Pecho y
                                            Abdomen</p>

                                    </div>

                                    <div class="position-relative"><img class="img-fluid
                                        position-absolute bottom-0" src="../src/img/Abdomen-fotos.png" alt=""
                                            style="height: 100%; min-width: 70px; max-width: 200px; right: 0; mask-image: linear-gradient(black 89%, transparent);  filter: drop-shadow(0 0 10px rgb(0, 0, 0));">
                                    </div>
                                </div>
                            </a>

                        </figure>

                        <figure class="cartas-rutinas col-12 col-sm-4">
                            <a href="https://www.youtube.com/watch?v=_hkUNgX9e54"
                                style="color: #101116; text-decoration: none;">
                                <div class="fondo-rutina col10 col-md-4 d-flex flex-row justify-content-between"
                                    style="border-radius: 10px; box-shadow: 5px 5px 35px #3f55762f; width: 100%;">

                                    <div class="" style=" margin: 10px 10px ; z-index: 100;">
                                        <p style="margin-top: 70px; margin-left: 10px; color: #fff; font-size: 20px;">
                                            Brazo</p>

                                    </div>

                                    <div class="position-relative"><img class="img-fluid
                                     position-absolute bottom-0" src="../src/img/biceps-fotos.png" alt=""
                                            style=" min-width: 90px; max-width: 240px; right: 0; mask-image: linear-gradient(black 89%, transparent);  filter: drop-shadow(0 0 10px rgb(0, 0, 0));">
                                    </div>

                                </div>
                            </a>
                        </figure>

                        <figure class="cartas-rutinas col-12 col-sm-4">
                            <a href="https://www.youtube.com/watch?v=LFR7BPbLmTc"
                                style="color: #101116; text-decoration: none;">
                                <div class="fondo-rutina col10 col-md-4 d-flex flex-row justify-content-between"
                                    style="border-radius: 10px; box-shadow: 5px 5px 35px #3f55762f; width: 100%;">

                                    <div class="" style=" margin: 10px 10px ; z-index: 100;">
                                        <p style="margin-top: 70px; margin-left: 10px; color: #fff; font-size: 20px;">
                                            Pierna y Gluteos</p>

                                    </div>

                                    <div class="position-relative"><img class="img-fluid
                                     position-absolute bottom-0" src="../src/img/Abdomen.png" alt=""
                                            style=" min-width: 40px; max-width: 220px; right: 0; mask-image: linear-gradient(black 89%, transparent);  filter: drop-shadow(0 0 10px rgb(0, 0, 0));">
                                    </div>

                                </div>
                            </a>
                        </figure>



                    </div>


                    <!-------------------------------------------------------------------------------->
                    <p style="margin: 30px 0 10px 0;">Nuestro Equipo</p>
                    <hr>

                    <?php include '../ProyectoAPP/View/componentes/NuestroEquipo.html' ?>
                    <!-------------------------------------------------------------------------------->

            </main>





            <!-------------------------------------------- menu ----------------------------------->
            <?php include '../ProyectoAPP/View/componentes/menu.html' ?>
            <!------------------------------------------------------------------------------->
        </div>


        <script src="../ProyectoAPP/src/js/bootstrap.min.js"></script>


</body>

</html>
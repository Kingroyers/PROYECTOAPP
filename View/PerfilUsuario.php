<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="../src/estilos.css">
    <base href="http://localhost/ProyectoAPP/">
    <title>Perfil Usuario</title>
</head>
<style>
    .fondo-perfil {
        z-index: -10;
        background: radial-gradient(125% 125% at 50% 10%, #101116 40%, #63e 100%);
        border-radius: 0px 0px 100px 40px;

    }
</style>

<body class="d-flex position-relative align-items-center bg-white flex-column" style="height: 100vh;">

    <div class="fondo-perfil  position-relative" style=" height: 160px; width: 100%; display: flex; justify-content: center;">


        <div class="col-12" style="  height: auto; position: absolute; bottom: 24px; padding: 1em;">

            <div class="d-flex flex-row align-items-center" style="gap: 20px;">
                <div style="width: 80px; height: 80px; margin: 10px solid #ffffff;">
                    <?php
                    include_once __DIR__ . '/../Controller/loginController.php';

                    $login = new loginController;
                    $login->mostrarFotoUsuario();
                    ?>

                </div>

                <div class="" style="gap: 0;">
                    <p style="font-size: 18px ;margin-top: 15px; color: #fff; font-weight: 600;"><?php echo $_SESSION['nombre_usuario'] . ' ' . $_SESSION['apellido'] ?> </p>
                    <p style="font-size: 10px ; color: #fff;"><?php echo $_SESSION['correo'] ?></p>
                </div>

            </div>

        </div>

            <div class="position-absolute" style="border-radius: 20px; width: 330px; height: 140px; z-index: 1000; bottom: -110px; background: #fff; box-shadow: 10px 8px 24px #bebebe;">

            </div>
   
    </div>    



        <div class=" d-flex justify-content-center align-items-center  w-100" style="margin-top: 150px;">

            <div class="container-xxl position-relative d-flex flex-column">

                <main style="height: auto; ">

                 <div class="row d-flex justify-content-center align-items-center" style="gap: 10px;">

                    <div class="col-sm-4 col-11 d-flex flex-row align-items-center" style="padding: 1em; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                        <div class="col-4">
                            <img src="src/img/inconos/CartaID.png" alt="cartaid" style="width: 40px; height: 40px;">
                        </div>
                        <div class="col-8" style="font-size: 20px;">
                            <?php echo $_SESSION['id_usuario']; ?>
                        </div>
                    </div>
                    <div class="col-sm-4 col-11 d-flex flex-row align-items-center" style="padding: 1em; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                        <div class="col-4">
                            <img src="src/img/inconos/CartaID.png" alt="cartaid" style="width: 40px; height: 40px;">
                        </div>
                        <div class="col-8">
                            <?php echo $_SESSION['nombre_usuario'].'   '.$_SESSION['apellido']; ?>
                        </div>
                    </div>
                    
                 </div>

                </main>





                <?php include '../View/componentes/menu.html' ?>
            </div>


        </div>
</body>

</html>
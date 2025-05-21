<!DOCTYPE html>
<html lang="es">

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

    .letraNombre {
        font-size: 20px;
        font-weight: 300;
        -webkit-text-stroke-width: 0.5px;
        -webkit-text-stroke-color: white;
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
                <div class="">
                    <p class="letraNombre valorant-text" style="margin-left: 14px;"><?php echo $_SESSION['nombre_usuario'] . ' ' . $_SESSION['apellido'] ?> </p>
                </div>
            </div>
        </div>
        <div class="position-absolute d-flex justify-content-center align-items-center flex-column" style="border-radius: 20px; width: 330px; height: 140px; z-index: 1000; bottom: -110px; background: #fff; box-shadow: 10px 8px 24px #bebebe;">
            <div class="position-absolute d-flex justify-content-between" style="background-color: #8689ac; border-radius: 10px 40px 90px 0; box-sizing: content-box; top: 10px; left: 0px; border: 1px solid #e0e0e0; width: 200px;">
                <p style="margin: 0 30px; color: #fff;">Plan</p>
                <div style="border-radius: 50%; width: 10px; height: 10px; background-color: #fff; margin:  5px 10px;"></div>
            </div>
            <?php
            include_once __DIR__ . '/../Controller/loginController.php';
            $Controller = new loginController();
            $Controller->mostrarPlan();
            ?>
        </div>
    </div>
    <div class=" d-flex justify-content-center align-items-center  w-100" style="margin-top: 150px;">
        <div class="container-xxl position-relative d-flex flex-column">
            <main style="height: auto; display: flex; justify-content: center; align-items: center; margin: 0 20px 0 20px;">
                <div class="row d-flex justify-content-center align-items-center" style="gap: 10px;">
                    <div class="position-relative col-12 d-flex flex-row align-items-center" style="border-radius: 15px 65px 15px 15px; padding: 1em; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                        <div class="col-4">
                            <img src="src/img/inconos/CartaID.png" alt="cartaid" style="width: 40px; height: 40px;">
                        </div>
                        <div class="col-8" style="font-size: 15px;">
                            <?php echo $_SESSION['id_usuario']; ?>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-row align-items-center" style="border-radius: 15px 15px 65px 15px; padding: 1em; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                        <div class="col-4">
                            <img src="src/img/inconos/icono-name.png" alt="cartaid" style="width: 30px; height: 30px;">
                        </div>
                        <div class="col-8" style="font-size: 15px;">
                            <?php echo $_SESSION['nombre_usuario'] . '   ' . $_SESSION['apellido']; ?>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-row align-items-center" style="border-radius: 15px 65px 15px 15px; padding: 1em; box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;">
                        <div class="col-2">
                            <img src="src/img/inconos/icono-email.png" alt="cartaid" style="width: 30px; height: 30px; margin-right: 3px;">
                        </div>
                        <div class="col-10" style="font-size: 15px;">
                            <?php echo $_SESSION['correo']; ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php include '../View/componentes/menu.php' ?>
        </div>
    </div>
</body>

</html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// if (isset($_SESSION['nombre_usuario'])) {
//     $nombre = $_SESSION['nombre_usuario'];
// } else {
//     $nombre = 'Invitado';
// }
?>


<div class="d-flex w-100 w-md-75 w-lg-50 text-white justify-content-between" style="background: #101116; padding: 1em; width: 100vh;">

    <section class="row w-100 mx-2">
        <div class="col-6 w-auto d-flex justify-content-center align-items-center" style="gap: 10px;">
            <div style="width: 40px; height: 40px; border: 1px solid; border-radius: 50%;"></div>
           <p style="font-size: 17px;margin-top: 15px;">Hola, <?php echo $_SESSION['nombre_usuario']. ' '. $_SESSION['apellido'] ?> </p>
        </div>
        <div class="col-6 w-auto position-absolute" style="width: auto; right: 0; top: 26px; cursor: pointer;"><img
                    src="src/img/inconos/BiThreeDotsVertical.png" alt="config" style="width: 24px;"
                    data-bs-toggle="offcanvas" data-bs-target="#menuLateral">
        </div>
        <!-- Menú Offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="menuLateral"
            style="transition: transform 0.5s ease-in-out !important; z-index: 100000;">
            <div class="offcanvas-header">
    
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column">
                <div class="row"
                    style="width: 100%; height: auto; display: flex; justify-content: center; align-items: center; padding: 1em;">
                    <div
                        style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
                        <figure class=""
                            style="border-radius: 50%; width: 100px; height: 100px; border: 1px solid;"></figure>
                        <p style="justify-self: center; font-size: 20px;"><?php echo $_SESSION['nombre_usuario']. ' '. $_SESSION['apellido'] ?></p>
    
                    </div>
                </div>
    
                <div class="container mt-3 my-3">
                    <div class="custom-alert"
                        style="background-color: #eefbe5; color: #2b641e; border: 1px solid #84d65a; display: flex; align-items: center; padding: 8px 12px; border-radius: 5px;">
                        <i class="bi bi-person-circle icon"
                            tyle=" color: #4CAF50; font-size: 1.2rem; margin-right: 8px;"></i>
                        <span style="margin-right: 20px;">Usuarios Online</span>
                        <span style="font-size: 20px;">0000000</span>
                    </div>
                </div>
    
    
    
                <ul class="list-group" style="margin-top: 20px;">
    
                    <li class="list-group-item" style="padding: 1em;"><a href="#"
                            style="text-decoration: none; color: #000;">Perfil</a></li>
                    <li class="list-group-item" style="padding: 1em;"><a href="#"
                            style="text-decoration: none; color: #000;">Servicios</a></li>
                    <li class="list-group-item" style="padding: 1em;"><a href="#"
                            style="text-decoration: none; color: #000;">Cartera</a></li>
                    <li class="list-group-item" style="padding: 1em;"><a href="#"
                                style="text-decoration: none; color: #000;">Clases Inscritas</a></li>
                    <li class="list-group-item" style="padding: 1em;"><a href="#"
                                    style="text-decoration: none; color: #000;">Configuracion</a></li>        
    
                </ul>
    
                <ul class="list-group" style="margin-top: 20px;">
                    <li class="list-group-item" style="padding: 1em;">
                        <a href="Controller/cerrarSesion.php"
                            style="text-decoration: none; color: #000;"><img
                                src="src/img/inconos/Icons-CerrarSesion.png" alt="user" width="30px" height="30px"
                                style="margin-right: 10px;">Cerrar Sesión
                        </a></li>
                    <li class="list-group-item"
                        style="padding: 1em; height: 50px; margin-top: 20px; background-color: #101116; display: flex; justify-content: center;">
                        <a href="#" style="text-decoration: none; color: #fff;">Visita nuestra pagina</a>
                </ul>
    
    
            </div>
        </div>
    
    </section>
    </div>
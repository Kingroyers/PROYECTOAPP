<div class="custom-navbar d-flex justify-content-around align-items-center position-fixed mx-5 w-75 w-md-75 w-lg-50" style=" align-self: center; gap: 10px; bottom: 8px; color: white;   border-radius: 20px;  height: 7vh; padding: 2em; background: #101116;">
  <a href="../ProyectoAPP/Dashboard.php"
    ><img src="src/img/inconos/icons-Home.png" alt=""
  /></a>
  <a href="../ProyectoAPP/View/PerfilUsuario.php"
    ><img src="src/img/inconos/user-icons2.png" alt=""
  /></a>
  <a href="../ProyectoApp/View/Acceso.php"
    ><img src="src/img/inconos/QrCodeModern.png" alt=""
  /></a>
 <div style="position: relative; display: inline-block;">
  <a href="../ProyectoApp/View/Planes.php">
    <img src="src/img/inconos/MdiWalletBifold.png" alt="">
  </a>
  <?php 
    require_once __DIR__ . '/../../Controller/loginController.php';
    $controller = new LoginController();
    $controller->mostrarNotificacionesPlanVencido();
    ?>
  </div>
</div>
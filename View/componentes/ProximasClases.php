<div class="container-fluid m-3 w-100 w-sm-100">

    <div class="wrapper d-flex" style="max-height: 120px;  overflow-x: auto; height: 77px;">

        <?php 
       require_once "../ProyectoAPP/Controller/ClaseController.php";
        
        $claseController = new ClaseController();
        $claseController->mostrarClasesDashboard();
        $icons_yoga = ""; 
        
        ?>

    </div>
</div>
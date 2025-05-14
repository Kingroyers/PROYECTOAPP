<?php
session_start();
require_once '../Model/PagoModel.php';

class PagoController
{
    public function procesarPago()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_usuario = $_SESSION['id_usuario'];
            $id_plan = $_POST['id_plan'];
            $nombre_titular = $_POST['titular'];
            $numero_tarjeta = $_POST['numero_tarjeta'];
            $fecha_caducidad = $_POST['caducidad'];
            $codigo_seguridad = $_POST['codigo_seguridad'];

            $pagoModel = new PagoModel();
            $resultado = $pagoModel->registrarPago($id_usuario, $id_plan, $nombre_titular, $numero_tarjeta, $fecha_caducidad, $codigo_seguridad);

            if ($resultado) {
                echo '<div class="container mt-4 d-flex justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.5); z-index: 1000;">
                                    <div id="alerta-exito" class="alert alert-success alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;">
                                           <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                                            <i class="bi bi-check-circle-fill" style="font-size: 10px;"></i> 
                                             <strong style="font-size: 10px;">¡Inscripción exitosa!</strong>
                                            </div>
                                           </div>
                                    </div>
                                  </div>';
                            echo '<script>
                              setTimeout(function() {
                                  location.reload();
                              }, 3000);
                            </script>';                        
                header("Location: /ProyectoAPP/View/Planes.php");
                exit();
            } else {
                $_SESSION['mensaje_error'] = "Error al realizar el pago";
                header("Location: /ProyectoAPP/View/Pago.php?id_plan=$id_plan&nombre_plan=" . urlencode($nombre_titular) . "&precio=" . $_POST['precio']);
                exit();
            }
        }
    }
}

$controller = new PagoController();
$controller->procesarPago();

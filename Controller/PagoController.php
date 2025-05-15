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
                $_SESSION['mensaje_exito'] = "Pago realizado con éxito";
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

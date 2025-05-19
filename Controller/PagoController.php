<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../Model/PagoModel.php';
require_once '../Model/AcessoModel.php';

class PagoController
{
    public function procesarPago()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $id_usuario = $_SESSION['id_usuario'];
            $nombre_usuario =  $_SESSION['nombre_usuario'];
            $apellido = $_SESSION['apellido'];
            $correo = $_SESSION['correo'];
            $id_plan = $_POST['id_plan'];
            $nombre_titular = $_POST['titular'];
            $numero_tarjeta = $_POST['numero_tarjeta'];
            $fecha_caducidad = $_POST['caducidad'];
            $codigo_seguridad = $_POST['codigo_seguridad'];

            $pagoModel = new PagoModel();
            $resultado = $pagoModel->registrarPago($id_usuario, $id_plan, $nombre_titular, $numero_tarjeta, $fecha_caducidad, $codigo_seguridad);

            if ($resultado) {
                $_SESSION['mensaje_exito'] = "Pago realizado con éxito";

                $modelo = new AcessoModel;
                $resultado = $modelo->AssecoGym($id_usuario, $id_plan, $nombre_usuario, $apellido, $correo);

                header("Location: /ProyectoAPP/View/Planes.php");


                exit();
            } else {
                $_SESSION['mensaje_error'] = "Error al realizar el pago";
                header("Location: /ProyectoAPP/View/Pago.php?id_plan=$id_plan&nombre_plan=" . urlencode($nombre_titular) . "&precio=" . $_POST['precio']);
                exit();
            }
        }
    }

//   public function BarraProcesoPlan()
// {
//     $id_usuario = $_SESSION['id_usuario'];
//     $pagoModel = new PagoModel();
//     $resultado = $pagoModel->BarraProcesoPlan($id_usuario);

//     if ($resultado) {
//         $fecha_inicio = new DateTime($resultado['fecha_inicio']);
//         $fecha_expiracion = new DateTime($resultado['fecha_expiracion']);
//         $hoy = new DateTime();

//         $dias_totales = $fecha_inicio->diff($fecha_expiracion)->days;
//         $dias_restantes = max(0, $hoy->diff($fecha_expiracion)->days);

//         $porcentaje = ($dias_restantes / $dias_totales) * 100;
//         $porcentaje = min(max(round($porcentaje), 0), 100);

//         $expirado = $hoy > $fecha_expiracion;

//         return [
//             'porcentaje' => $porcentaje,
//             'expirado' => $expirado
//         ];
//     }
//     return null;
// }

}

$controller = new PagoController();
$controller->procesarPago();

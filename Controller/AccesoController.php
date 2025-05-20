<?php

include('../libs/phpqrcode/qrlib.php');
require_once realpath(dirname(__FILE__) . '/../Model/LoginModel.php');

class AccesoController
{
    public function mostrar_qr()
    {
        if (isset($_SESSION['id_usuario'])) {
            $idUsuario = $_SESSION['id_usuario'];
            $nombreArchivo = "qr-$idUsuario.png";
            $ruta = "../public/qrcodes/$nombreArchivo";
            if (!file_exists($ruta)) {
                QRcode::png($idUsuario, $ruta, QR_ECLEVEL_L, 8);
            }
            echo "<img src='public/qrcodes/$nombreArchivo' alt='QR' style='border-radius: 40px;' />";
        } else {
            echo "Error: No se ha iniciado sesión o no se ha encontrado el ID de usuario.";
        }
    }
}

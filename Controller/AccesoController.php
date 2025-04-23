<?php
session_start();

include('../libs/phpqrcode/qrlib.php');
include('../Model/LoginModel.php');

class AccesoController
{
    public function mostrar_qr()
    {
        if (isset($_SESSION['id_login'])) {
            $idUsuario = $_SESSION['id_login'];
            QRcode::png((int)$idUsuario, '../public/qrcodes/qr.png', QR_ECLEVEL_L, 10);
            echo '<img src="../public/qrcodes/qr.png" alt="QR" />';
        } else {
            echo "Error: No se ha iniciado sesión o no se ha encontrado el ID de usuario.";
        }
    }
}

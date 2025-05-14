<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['id_usuario'])) {
    die("Error: No hay un usuario logueado.");
}


$id_usuario = $_SESSION['id_usuario'];

require_once __DIR__ . '/../Model/conexionbd.php';
require_once __DIR__ . '/../Model/PlanesModel.php';
require_once __DIR__ . '/../Model/PagoModel.php';

class PlanesController
{
    private $planesModel;

    public function __construct($conexion)
    {
        $this->planesModel = new PlanesModel($conexion);
    }

    public function mostrarPlanes($id_usuario)
    {
        return $this->planesModel->getPlanesNoPagados($id_usuario);
    }

    public function getPlanActivo($id_usuario)
    {
        return $this->planesModel->getPlanActivo($id_usuario);
    }
}

$conexionBD = new ConexionBD();
$conexion = $conexionBD->getConexion();

$planController = new PlanesController($conexion);
$planes = $planController->mostrarPlanes($id_usuario);
$planActivo = $planController->getPlanActivo($id_usuario);

$pagoModel = new PagoModel();
$pagoModel->actualizarEstadosPagos();

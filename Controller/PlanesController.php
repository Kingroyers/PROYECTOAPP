<?php
require_once __DIR__ . '/../Model/conexionbd.php'; // Primero cargamos la conexión
require_once __DIR__ . '/../Model/PlanesModel.php';

class PlanesController
{
    private $planesModel;

    public function __construct($conexion)
    {
        $this->planesModel = new PlanesModel($conexion);
    }

    public function mostrarPlanes()
    {
        return $this->planesModel->getPlanes();
    }
}

// 🛠 Definir la conexión ANTES de instanciar el controlador
$conexionBD = new ConexionBD();
$conexion = $conexionBD->getConexion();

$planController = new PlanesController($conexion);
$planes = $planController->mostrarPlanes();

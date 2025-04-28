<?php

class PlanesModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new ConexionBD())->getConexion(); // Guarda la conexión una vez
    }

    public function getPlanes()
    {
        $sql = "SELECT * FROM planes";
        $result = $this->conexion->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC); // Devuelve un array asociativo
    }
}

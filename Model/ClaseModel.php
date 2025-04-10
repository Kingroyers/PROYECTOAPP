<?php
require_once "conexionbd.php"; 

class ModeloClases {

    public function obtenerClases() {
        $conexion = new ConexionBD();
        $db = $conexion->getConexion();

        $sql = "SELECT * FROM clases ORDER BY fecha >= CURDATE() DESC, fecha DESC, horario DESC;";
        $result = $db->query($sql);

        $clases = [];

        while ($row = $result->fetch_assoc()) {
            $clases[] = $row;
        }

        return $clases;
    }

    public function obtenerClasesOrdenadas() {
        $conexion = new ConexionBD();
        $db = $conexion->getConexion();

        $sql = "SELECT * FROM clases ORDER BY fecha >= CURDATE() DESC, fecha DESC, horario DESC;";
        $result = $db->query($sql);

        $clases = [];
        while ($row = $result->fetch_assoc()) {
            $clases[] = $row;
        }

        return $clases;
    }
  
}
?>

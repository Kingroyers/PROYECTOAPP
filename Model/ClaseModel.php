<?php
require_once "conexionbd.php"; 

class ModeloClases {

    public function obtenerClases() {
        $conexion = new ConexionBD();

        $db = $conexion->getConexion(); 

        $sql = "SELECT * FROM clases ORDER BY fecha, horario ASC";
        $result = $db->query($sql);

        $clases = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $clases[] = $row;
            }
        } else {
            die("Error en la consulta: " . $db->error);
        }

        return $clases;
    }
}
?>

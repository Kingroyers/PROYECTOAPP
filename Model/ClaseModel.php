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
  
    public function InscripcionClases($id_clase, $id_usuario,$fecha) {
        $conexion = new ConexionBD();
        $db = $conexion->getConexion();
        

        $sql = "INSERT INTO inscripcion_clases (id_clase, id_usuario, fecha_inscripcion) VALUES ('$id_clase', '$id_usuario','$fecha')";
        
        if ($db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

   
}
?>

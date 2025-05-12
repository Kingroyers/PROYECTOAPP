<?php
require_once "conexionbd.php";

class ModeloClases
{
    private $db;

    public function __construct()
    {
        $conexion = new ConexionBD();
        $this->db = $conexion->getConexion();
    }

    public function obtenerClases()
    {
        

        $sql = "SELECT * FROM clases ORDER BY fecha >= CURDATE() DESC, fecha DESC, horario DESC;";
        $result = $this->db->query($sql);

        $clases = [];

        while ($row = $result->fetch_assoc()) {
            $clases[] = $row;
        }

        return $clases;
    }

    public function obtenerClasesOrdenadas()
    {

        $sql = "SELECT * FROM clases ORDER BY fecha >= CURDATE() DESC, fecha DESC, horario DESC;";
        $result = $this->db->query($sql);

        $clases = [];
        while ($row = $result->fetch_assoc()) {
            $clases[] = $row;
        }

        return $clases;
    }

    public function InscripcionClases($id_clase, $id_usuario, $fecha)
{
    $stmt = $this->db->prepare("INSERT INTO inscripcion (id_clase, id_usuario, fecha_inscripcion) VALUES (?, ?, ?)");
    if (!$stmt) {
        error_log("Error al preparar: " . $this->db->error);
        return false;
    }
    $stmt->bind_param("iis", $id_clase, $id_usuario, $fecha);
    $resultado = $stmt->execute();
    $stmt->close();

    return $resultado;
}


    public function ValidarInscripcion($id_clase, $id_usuario)
    {

        $stmt = $this->db->prepare("SELECT * FROM inscripcion WHERE id_clase = ? AND id_usuario = ? ");
        $stmt->bind_param("ii", $id_clase, $id_usuario);
        $stmt->execute();

         $result = $stmt->get_result();
         return $result->num_rows > 0;
    }

    public function EliminarInscripcion($id_clase, $id_usuario)
    {

        $stmt = $this->db->prepare("DELETE FROM inscripcion WHERE id_clase = ? AND id_usuario = ?");

        $stmt->bind_param("ii", $id_clase, $id_usuario);
        return $stmt->execute();
    }

    public function MostrarClasesInscritas($id_usuario, $fecha) {

        $stmt = $this->db->prepare("SELECT clases.* FROM clases JOIN inscripcion ON clases.id_clase = inscripcion.id_clase WHERE inscripcion.id_usuario = ? AND fecha = ? ORDER BY clases.fecha DESC, clases.horario DESC;");
        $stmt->bind_param("is", $id_usuario, $fecha);
        $stmt->execute();
        $result = $stmt->get_result();
        $clasesInscritas = [];

        while ($row = $result->fetch_assoc()) {
            $clasesInscritas[] = $row;
        }

        $stmt->close();

        return $clasesInscritas;
    }

    public function VerificarCapacidadMaxima($id_clase)
    {
        $stmt = $this->db->prepare("SELECT capacidad_maxima FROM clases WHERE id_clase = ?");
        $stmt->bind_param("i", $id_clase);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $capacidad = $row['capacidad_maxima'];

            $stmt2 = $this->db->prepare("SELECT COUNT(*) AS total FROM inscripcion WHERE id_clase = ?");
            $stmt2->bind_param("i", $id_clase);
            $stmt2->execute();

            $res2 = $stmt2->get_result();
            $fila2 = $res2->fetch_assoc();
            $inscritos = $fila2['total'];

            return $inscritos < $capacidad;
        }

        return false;
    }

    public function eliminarAsistenciasDomingo() {
        

        if (date('w') == 0) { 
            $stmt= $this->db->prepare("DELETE FROM clases");
            $stmt->execute();
        }
    }

}

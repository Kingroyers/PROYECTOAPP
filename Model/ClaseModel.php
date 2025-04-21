<?php
require_once "conexionbd.php";

class ModeloClases
{

    public function obtenerClases()
    {
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

    public function obtenerClasesOrdenadas()
    {
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

    public function InscripcionClases($id_clase, $id_usuario, $fecha)
    {
        $conexion = new ConexionBD();
        $db = $conexion->getConexion();


        $sql = "INSERT INTO inscripcion (id_clase, id_usuario, fecha_inscripcion) VALUES ('$id_clase', '$id_usuario','$fecha')";

        if ($db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function ValidarInscripcion($id_clase, $id_usuario)
    {
        $conexion = new ConexionBD();
        $db = $conexion->getConexion();

        $sql = "SELECT * FROM inscripcion WHERE id_clase = '$id_clase' AND id_usuario = '$id_usuario'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            return true; // Inscripción ya existe
        } else {
            return false; // Inscripción no existe
        }
    }

    public function EliminarInscripcion($id_clase, $id_usuario)
    {
        $conexion = new ConexionBD();
        $db = $conexion->getConexion();

        $sql = "DELETE FROM inscripcion WHERE id_clase = '$id_clase' AND id_usuario = '$id_usuario'";

        if ($db->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // public function MostrarClasesInscritas($id_usuario) {
    //     $conexion = new ConexionBD();
    //     $db = $conexion->getConexion();

    //     $sql = "SELECT clases.* FROM clases JOIN inscripcion ON clases.id_clase = inscripcion.id_clase WHERE inscripcion.id_usuario = '$id_usuario' ORDER BY clases.fecha DESC, clases.horario DESC;";
    //     $result = $db->query($sql);

    //     $clasesInscritas = [];

    //     while ($row = $result->fetch_assoc()) {
    //         $clasesInscritas[] = $row;
    //     }

    //     return $clasesInscritas;
    // }

    public function VerificarCapacidadMaxima($id_clase)
    {
        $conn = new ConexionBD();
        $db = $conn->getConexion();

        $sql = "SELECT capacidad_maxima FROM clases WHERE id_clase = '$id_clase'";
        $result = $db->query($sql);

        if($row = $result->fetch_assoc()){
            $capacidad = $row['capacidad_maxima'];

            $sqlInscritos = "SELECT COUNT(*) AS total FROM inscripcion WHERE id_clase = '$id_clase'";
            $resultado = $db->query($sqlInscritos);
            $fila2 = $resultado->fetch_assoc();

            $inscritos = $fila2['total'];

            return $inscritos < $capacidad;

             
        }

        return false;
    }

}

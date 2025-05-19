<?php
require_once '../Model/conexionbd.php';

class PagoModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new ConexionBD())->getConexion();
    }

    public function registrarPago($id_usuario, $id_plan, $nombre_titular, $numero_tarjeta, $fecha_caducidad, $codigo_seguridad)
    {
        $fecha_inicio = date("Y-m-d");
        $fecha_expiracion = date("Y-m-d", strtotime("+1 month"));

        $sql = "INSERT INTO pagos (id_usuario, id_plan, nombre_titular, numero_tarjeta, fecha_caducidad, codigo_seguridad, fecha_inicio, fecha_expiracion, estado)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $this->conn->prepare($sql)) {
            $estado = 1;
            $stmt->bind_param("iissssssi", $id_usuario, $id_plan, $nombre_titular, $numero_tarjeta, $fecha_caducidad, $codigo_seguridad, $fecha_inicio, $fecha_expiracion, $estado);

            if ($stmt->execute()) {
                return true;
            }
            $stmt->close();
        }
        return false;
    }

    public function actualizarEstadosPagos()
    {
        $sql = "UPDATE pagos SET estado = 0 WHERE fecha_expiracion <= NOW() AND estado = 1";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute();
    }

     public function BarraProcesoPlan($id_usuario){

        $stmt = $this->conn->prepare("SELECT fecha_expiracion, fecha_inicio FROM pagos WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();

        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }
}

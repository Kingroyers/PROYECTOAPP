<?php

class PlanesModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = (new ConexionBD())->getConexion();
    }

    public function getConexion()
    {
        return $this->conexion;
    }

    public function getPlanesNoPagados($id_usuario)
    {
        $sql_check = "SELECT COUNT(*) as total 
                  FROM pagos 
                  WHERE id_usuario = ? 
                  AND fecha_expiracion > NOW() 
                  AND estado = 1";

        $stmt_check = $this->conexion->prepare($sql_check);
        $stmt_check->bind_param("i", $id_usuario);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        $row_check = $result_check->fetch_assoc();

        if ($row_check['total'] == 0) {
            $sql = "SELECT * FROM planes";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }


    public function getPlanActivo($id_usuario)
    {
        $sql = "SELECT p.nombre_plan, p.precio, pg.fecha_inicio, pg.fecha_expiracion 
            FROM pagos pg 
            INNER JOIN planes p ON pg.id_plan = p.id_plan
            WHERE pg.id_usuario = ? AND pg.estado = 1 
            LIMIT 1";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

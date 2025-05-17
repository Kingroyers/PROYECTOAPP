<?php
require_once "conexionbd.php";

class AcessoModel
{

    private $db;

    public function __construct()
    {
        $conexion = new ConexionBD();
        $this->db = $conexion->getConexion();
    }

   public function AssecoGym($id_usuario, $id_plan, $nombre_usuario, $apellido, $correo) {
    // Verifica si el usuario ya existe
    $check = $this->db->prepare("SELECT Identificacion FROM usuarios WHERE Identificacion = ?");
    $check->bind_param("i", $id_usuario);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        return false; 
    }

    $stmt = $this->db->prepare("INSERT INTO usuarios (Identificacion, Nombre, Apellido, Correo,  id_plan) 
                                VALUES (?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("isssi", $id_usuario, $nombre_usuario, $apellido, $correo, $id_plan);

    return $stmt->execute();
}

}

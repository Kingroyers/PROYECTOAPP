<?php

require_once __DIR__ . "/../../config/database.php"; // Cambia la ruta según tu estructura de carpetas
//__DIR__ es una constante mágica que devuelve la ruta del directorio actual del archivo 

class ClaseModel{
    private $db;

    public function __construct(){
        $this->db = new ConexionBD(); // Instancia de la clase ConexionBD
    }

    public function obtenerClases() {
        // $sql = "SELECT * FROM clases ORDER BY fecha_hora ASC";
        // $result = $this->db->query($sql);
        // $clases = [];

        // while ($row = $result->fetch_assoc()) {
        //     $clases[] = $row;
        // }
        // return $clases;
    }
}




?>
<?php

 class ConexionBD{

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "appBD";
    private $conn;

    public function conectarBD(){
      
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname); //this es para referirse a la clase actual

        if ($this->conn->connect_error) {
            die("EROOR DE CONEXION: " . $this->conn->connect_error);
        } else {
            //  echo "Conectado correctamente a la base de datos";
        }
            
                return $this->conn;
    }
   
 }

?>
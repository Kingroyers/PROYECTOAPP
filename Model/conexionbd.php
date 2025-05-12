<?php
class ConexionBD
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbname = "appBD";
    private $conn;

    public function conectarBD()
    {
        if (!$this->conn) { // Si no hay conexión, la crea
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);

            if ($this->conn->connect_error) {
                die("ERROR DE CONEXIÓN: " . $this->conn->connect_error);
                echo "<script>alert('Error de conexión a la base de datos');</script>";
            } else {
                // echo "<script>alert('Conexión exitosa a la base de datos');</script>";
            }
        }
        return $this->conn;
    }

    // Método para obtener la conexión sin necesidad de volver a conectarse
    public function getConexion()
    {
        return $this->conectarBD();
    }

    public function closeConexion()
    {
        if ($this->conn) {
            $this->conn->close();
            $this->conn = null;
        }
    }

    public function probarConexion()
    {
        $conn = $this->conectarBD();
        if ($conn) {
            // echo "✅ Conexión a la base de datos exitosa.";
        } else {
            echo "❌ Error al conectar.";
        }
    }
}

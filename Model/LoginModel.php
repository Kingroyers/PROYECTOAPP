<?php
require_once 'conexionbd.php';
class LoginModel
{
    private $db;

    public function __construct()
    {
        $conexion = new ConexionBD();
        $this->db = $conexion->getConexion();
    }

    function registrarUsuario($nombre, $apellido, $correo, $identificacion, $contraseña)
    {
        $conexion = new ConexionBD();
        $conexion->getConexion();

        $sql = "INSERT INTO login (id_usuario, nombre_usuario, apellido, correo, contraseña) VALUES ('$identificacion','$nombre', '$apellido', '$correo', '$contraseña')";
        if ($conexion->getConexion()->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function UsuarioExiste($id_usuario)
    {
        $conexion = new ConexionBD();
        $db = $conexion->getConexion();
        $sql = "SELECT Identificacion FROM usuarios WHERE Identificacion = '$id_usuario'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function mostrarFotoUsuario()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['id_usuario'])) {
            $id_usuario = $_SESSION['id_usuario'];
            $conexion = new ConexionBD;
            $bd = $conexion->getConexion();
            $sql = "SELECT foto_usuario FROM login WHERE id_usuario = '$id_usuario'";
            $resultado = $bd->query($sql);
            if ($row = $resultado->fetch_assoc()) {
                $_SESSION['foto_usuario'] = $row['foto_usuario'];
                return $row['foto_usuario'];
            } else {
                return null;
            }
        }
        return null;
    }

    public function ActualizarFotoUsuario($foto_usuario)
    {
        $conexion = new ConexionBD();
        $bd = $conexion->getConexion();
        $id_usuario = $_SESSION['id_usuario'];
        $stmt = $bd->prepare("UPDATE login SET foto_usuario = ? WHERE id_usuario = ?");
        if ($stmt) {
            $stmt->bind_param("ss", $foto_usuario, $id_usuario);
            $result = $stmt->execute();
            $stmt->close();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function RecuperarContraseña($correo)
    {
        $stmt = $this->db->prepare("SELECT * FROM login WHERE correo = ? ");
        $stmt->bind_param("s", $correo);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function ConsularContraseña($correo)
    {
        $contraseña = null;
        $stmt = $this->db->prepare("SELECT contraseña FROM login WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($contraseña);
            $stmt->fetch();
            $stmt->close();
            return $contraseña;
        } else {
            return false;
        }
    }

    public function MostrarPlanPerfil($id_usuario)
    {
        $stmt = $this->db->prepare('SELECT p.nombre_plan FROM pagos pa JOIN planes p ON pa.id_plan = p.id_plan
            WHERE pa.id_usuario = ? 
            AND pa.estado = 1
            AND pa.fecha_expiracion >= CURDATE()
            ORDER BY pa.fecha_expiracion DESC
            LIMIT 1;
            ');
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function CambiarDatosUsuario($id, $nombre, $apellido, $correo, $contraseña = null)
    {
        if ($contraseña) {
            $sql = "UPDATE login SET nombre_usuario = ?, apellido = ?, correo = ?, contraseña = ? WHERE id_usuario = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ssssi", $nombre, $apellido, $correo, $contraseña, $id);
        } else {
            $sql = "UPDATE login SET nombre_usuario = ?, apellido = ?, correo = ? WHERE id_usuario = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("sssi", $nombre, $apellido, $correo, $id);
        }
        $resultado = $stmt->execute();
        $stmt->close();
        $this->db->close();
        return $resultado;
    }
}

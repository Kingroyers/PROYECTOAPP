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

    function loginValidar($correo, $contraseña)
    {


        $conexion = new ConexionBD();
        $conexion->getConexion();

        $sql = "select * from login where correo ='$correo'and contraseña='$contraseña'";
        $result = $conexion->getConexion()->query($sql);


        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['id_login'] = $row->id_login;
            $_SESSION['nombre_usuario'] = $row->nombre_usuario;
            $_SESSION['id_usuario'] = $row->id_usuario;
            $_SESSION['correo'] = $row->correo;
            $_SESSION['foto_usuario'] = $row->foto_usuario;

            if ($row['correo'] == $correo && $row['contraseña'] == $contraseña) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
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
            return true;  // Usuario encontrado
        } else {
            return false; // Usuario no encontrado
        }
    }

    public function mostrarFotoUsuario()
    {

        // Iniciar sesión si no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verificar si el usuario está logueado
        if (isset($_SESSION['id_usuario'])) {

            // Obtener el ID del usuario desde la sesión
            $id_usuario = $_SESSION['id_usuario'];

            // Crear la conexión a la base de datos
            $conexion = new ConexionBD;
            $bd = $conexion->getConexion();

            // Consulta para obtener la foto del usuario
            $sql = "SELECT foto_usuario FROM login WHERE id_usuario = '$id_usuario'";
            $resultado = $bd->query($sql);

            // Verificar si la consulta devuelve un resultado
            if ($row = $resultado->fetch_assoc()) {
                // Almacenar la foto del usuario en la sesión
                $_SESSION['foto_usuario'] = $row['foto_usuario'];
                return $row['foto_usuario']; // Retornar la foto para mostrarla
            } else {
                // Si no se encuentra la foto, retornar null
                return null;
            }
        }
        return null; // Si el usuario no está logueado, retornar null
    }


    public function ActualizarFotoUsuario($foto_usuario)
    {
        $conexion = new ConexionBD();
        $bd = $conexion->getConexion();

        $id_usuario = $_SESSION['id_usuario'];

        // Preparamos la consulta de actualización
        $stmt = $bd->prepare("UPDATE login SET foto_usuario = ? WHERE id_usuario = ?");

        if ($stmt) {
            $stmt->bind_param("ss", $foto_usuario, $id_usuario); // Dos strings
            $result = $stmt->execute();
            $stmt->close();

            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false; // Falló preparar la consulta
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
}

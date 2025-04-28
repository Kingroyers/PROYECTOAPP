<?php

require_once realpath(dirname(__FILE__) . '/../Model/LoginModel.php');


class loginController
{


    function loginValidar()
    {


        if (isset($_POST['btnlogin'])) {
            if (!empty($_POST['correo']) && !empty($_POST['pass'])) {
                $correo = $_POST['correo'];
                $contraseña = $_POST['pass'];

                $conexion = new ConexionBD();
                $conexion->getConexion();

                $sql = "select * from login where correo ='$correo'and contraseña='$contraseña'";
                $result = $conexion->getConexion()->query($sql);

                if ($datos = $result->fetch_assoc()) {
                    // echo '<pre>';
                    // print_r($datos);  // 👈 Muestra lo que tiene la fila
                    // echo '</pre>';
                    // exit();
                    session_start();
                    $_SESSION['id_login'] = $datos['id_login'];
                    $_SESSION['nombre_usuario'] = $datos['nombre_usuario'];
                    $_SESSION['apellido'] = $datos['apellido'];
                    $_SESSION['id_usuario'] = $datos['id_usuario'];
                    $_SESSION['foto_usuario'] = $datos['foto_usuario'];



                    header("Location: ../dashboard.php");
                    exit();
                } else {
                    echo '<div class="alert alert-danger fs-6">Acceso denegado</div>';
                }
            } else {
                echo '<div class="alert alert-danger fs-6">Por favor complete todos los campos</div>';
            }
        }



        //   session_start();

        //     if (isset($_POST['btnlogin'])) {

        //         $correo = $_POST['correo'];
        //         $contraseña = $_POST['pass'];

        //         $login = new LoginModel();
        //         $usuario = $login->loginValidar($correo, $contraseña);

        //         if ($usuario == true) {


        //             $_SESSION['nombre_usuario'];

        //             header("Location: ../dashboard.php");

        //         } else {
        //             echo '<div class="alert alert-danger fs-6">Acceso denegado</div>';
        //         }
        //     }

    }

    function registrarUsuario()
    {
        if (isset($_POST['btnRegistrar'])) {
            if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo_register']) && !empty($_POST['id']) && !empty($_POST['contraseña'])) {
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $correo = $_POST['correo_register'];
                $identificacion = $_POST['id'];
                $contraseña = $_POST['contraseña'];

                $login = new LoginModel();
                $usuario = $login->registrarUsuario($nombre, $apellido, $correo, $identificacion, $contraseña);

                if ($usuario == true) {
                    echo '<div class="alert alert-success fs-6">Usuario registrado correctamente</div>';
                } else {
                    echo '<div class="alert alert-danger fs-6">Error al registrar el usuario</div>';
                }
            } else {
                echo '<div class="alert alert-danger fs-6">Por favor complete todos los campos</div>';
            }
        }
    }

    public function mostrarFotoUsuario()
    {
        $modelo = new LoginModel();
        $foto = $modelo->mostrarFotoUsuario();

        
        if (isset($_SESSION['foto_usuario']) && !empty($_SESSION['foto_usuario'])) {
            echo '<img src="src/uploads/' . htmlspecialchars($_SESSION['foto_usuario']) . '" alt="Foto de perfil" style="width:100%; height:100%; border-radius:50%;" >';
        } else {
            echo '<img src="src/uploads/perfil_default.png" alt="Foto de perfil" style="width:100%; border-radius:50%;">';
        }
    }


    public function ActualizarFoto()
    {
        if (isset($_POST['actualizarFoto'])) {
            if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
                if (empty($_POST['foto'])) {
                    
                    $model = new LoginModel();
                    $model->ActualizarFotoUsuario(null); 
                    header("Location: dashboard.php?mensaje=foto_borrada");
                    exit();
                } else {
                    echo "Error: No se seleccionó ninguna imagen o hubo un error en la subida.";
                    return; 
                }
            }
    
            // 2. Procesar la subida del archivo si no hubo errores
            $archivoFoto = $_FILES['foto'];
            $nombreFoto = $archivoFoto['name'];
            $rutaTemporal = $archivoFoto['tmp_name'];
            $tamañoFoto = $archivoFoto['size'];
            $tipoFoto = $archivoFoto['type'];
    
            $carpetaDestino = 'src/uploads/';
    
            // 3. Validar el tipo de archivo (ejemplo: permitir solo imágenes JPEG, PNG, GIF)
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($tipoFoto, $tiposPermitidos)) {
                echo "Error: Solo se permiten archivos con formato JPEG, PNG o GIF.";
                return;
            }
    
            // 4. Validar el tamaño del archivo (ejemplo: máximo 2MB)
            $tamañoMaximo = 2 * 1024 * 1024; // 2MB en bytes
            if ($tamañoFoto > $tamañoMaximo) {
                echo "Error: El tamaño de la imagen no puede exceder los 2MB.";
                return;
            }
    
            // 5. Generar un nombre de archivo único para evitar colisiones
            $nombreUnico = uniqid() . "_" . pathinfo($nombreFoto, PATHINFO_FILENAME) . "." . pathinfo($nombreFoto, PATHINFO_EXTENSION);
            $rutaDestino = $carpetaDestino . $nombreUnico;
    
            // 6. Mover la foto al servidor
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                // 7. Actualizar la base de datos con el nuevo nombre de archivo
                $model = new LoginModel();
                $model->ActualizarFotoUsuario($nombreUnico);
    
                // 8. Redirigir con un mensaje de éxito
                header("Location: dashboard.php?mensaje=foto_actualizada");
                exit();
            } else {
                // 9. Manejar el error al mover el archivo
                echo "Error al guardar la imagen en el servidor.";
            }
        }
    }

}

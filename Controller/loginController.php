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

        // Si la foto está en la sesión, mostrarla
        if (isset($_SESSION['foto_usuario']) && !empty($_SESSION['foto_usuario'])) {
            echo '<img src="src/uploads/' . htmlspecialchars($_SESSION['foto_usuario']) . '" alt="Foto de perfil" style="width:100%; border-radius:50%;" >';
        } else {
            echo '<img src="src/uploads/perfil_default.png" alt="Foto de perfil" style="width:100%; border-radius:50%;">';
        }
    }


    public function ActualizarFoto()
    {
        if (isset($_POST['actualizarFoto'])) {
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0 || !empty($_POST['foto'])) {
    
                // Obtener datos de la imagen
                $nombreFoto = $_FILES['foto']['name'];
                $rutaTemporal = $_FILES['foto']['tmp_name'];
                $tipoArchivo = $_FILES['foto']['type'];
                $tamañoArchivo = $_FILES['foto']['size'];
    
                // Carpeta donde se guardarán las fotos
                $carpetaDestino = 'src/uploads/';
    
                // Definir tipos de archivo permitidos (solo imágenes)
                $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
    
                // Definir tamaño máximo permitido (por ejemplo, 2MB)
                $tamañoMaximo = 2 * 1024 * 1024;  // 2MB en bytes
    
                // Verificar que el tipo de archivo sea válido
                if (!in_array($tipoArchivo, $tiposPermitidos)) {
                    echo "Solo se permiten archivos de imagen (JPEG, PNG, GIF).";
                    exit();
                }
    
                // Verificar que el tamaño del archivo sea menor o igual al permitido
                if ($tamañoArchivo > $tamañoMaximo) {
                    echo "El archivo es demasiado grande. El tamaño máximo permitido es 2 MB.";
                    exit();
                }
    
                // Crear un nombre único para la foto (opcional)
                $nombreUnico = uniqid() . "_" . $nombreFoto;
    
                // Mover la foto al servidor
                if (move_uploaded_file($rutaTemporal, $carpetaDestino . $nombreUnico)) {
    
                    // Llamar al modelo para actualizar en la base de datos
                    $model = new LoginModel();
                    $model->ActualizarFotoUsuario($nombreUnico);
    
                    // Opcional: redirigir o mostrar éxito
                    echo '<script>
                          setTimeout(function() {
                              location.reload();
                          }, 3000);
                        </script>';
                    exit();
                } else {
                    echo '<div class="container mt-4 d-flex justify-content-center">
                    <div class="alert alert-danger alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 400px; width: 100%;">
                     <strong>Error al subir la imagen</strong>
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                   </div>';
                }
            } else {
                echo '<div class="container mt-4 d-flex justify-content-center">
                           <div class="alert alert-danger alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 400px; width: 100%;">
                            <strong>No selecciono ninguna imagen</strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                           </div>
                          </div>';
            }
        }
    }

}

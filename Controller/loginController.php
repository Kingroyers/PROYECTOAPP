<?php

require_once realpath(dirname(__FILE__) . '/../Model/LoginModel.php');
require_once realpath(dirname(__FILE__) . '/../Model/PlanesModel.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
                    $_SESSION['correo'] = $datos['correo'];
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
                    echo "<script>
                        setTimeout(function() {
                            window.location.href = '../index.php';
                        }, 2000);
                     </script>";
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
            echo '<img src="src/uploads/' . htmlspecialchars($_SESSION['foto_usuario']) . '" alt="Foto de perfil" style="object-fit: cover; width:100%; height:100%; border-radius:50%;" >';
        } else {
            echo '<img src="src/uploads/perfil_default.png" class="img-fluid" alt="Foto de perfil" style="width:100%; border-radius:50%;">';
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

            $carpetaDestino = __DIR__ . '/../src/uploads/';

            // 3. Validar el tipo de archivo (ejemplo: permitir solo imágenes JPEG, PNG, GIF)
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($tipoFoto, $tiposPermitidos)) {
                echo "Error: Solo se permiten archivos con formato JPEG, PNG o GIF.";
                return;
            }

            // 4. Validar el tamaño del archivo (ejemplo: máximo 2MB)
            $tamañoMaximo = 2 * 1024 * 1024; // 2MB en bytes
            if ($tamañoFoto > $tamañoMaximo) {
                echo '<div class="container mt-4 d-flex justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.5); z-index: 1000;">
                                    <div class="alert alert-danger alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;">
                                     <strong>Error la imagen no puedo exeder de los 2MB</strong>                                
                                    </div>
                                  </div>';
                echo '<script>
                                  setTimeout(function() {
                                      location.reload();
                                  }, 2000);
                                </script>';
                echo "<script>
                                    setTimeout(function() {
                                    window.location.href = 'dashboard.php';
                                    }, 2000);
                                </script>";
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
                header("Location: dashboard.php");
                exit();
            } else {
                // 9. Manejar el error al mover el archivo
                echo "Error al guardar la imagen en el servidor.";
            }
        }
    }

    public function RecuperarContraseña()
    {
        if (isset($_POST['btnRC'])) {
            if (!empty($_POST['correo'])) {

                $correo = $_POST['correo'];

                $login = new LoginModel();
                $result = $login->RecuperarContraseña($correo);

                if ($result == true) {


                    require '../libs/PHPMailer/Exception.php';
                    require '../libs/PHPMailer/PHPMailer.php';
                    require '../libs/PHPMailer/SMTP.php';

                    $mail = new PHPMailer(true);
                    $contraseña = $login->ConsularContraseña($correo);

                    try {


                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'antonioroyero12@gmail.com';
                        $mail->Password   = 'qbtd ivdi pyzb safw';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port       = 465;

                        //Recipients
                        $mail->setFrom('antonioroyero12@gmail.com', 'Soporte Fitness Life');
                        $mail->addAddress($correo);
                        $mail->isHTML(true);
                        $mail->Subject = 'Soporte Tecnico - Fitness Life';
                        $mail->addEmbeddedImage('../src/img/inconos/logo.png', 'logo_id', 'logo.png');
                        $mail->Body = '
                                <html>
                                <head>
                                    <style>
                                        body {
                                            font-family: Arial, sans-serif;
                                            background-color: #f4f4f9;
                                            margin: 0;
                                            padding: 0;
                                        }
                                        .container {
                                            width: 600px;
                                            margin: 0 auto;
                                            background-color: #ffffff;
                                            border-radius: 8px;
                                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                            padding: 20px;
                                        }
                                        .header {
                                            display: flex;
                                            justify-content: center;
                                            align-items: center;
                                            background-color: #2F3148;
                                            margin-bottom: 20px;
                                        }
                                        .header img {
                                            width: 50px;
                                            
                                        }
                                        .content {
                                            text-align: center;
                                            color: #333333;
                                        }
                                        .button {
                                            display: inline-block;
                                            padding: 10px 20px;
                                            background-color: #4CAF50;
                                            color: white;
                                            text-decoration: none;
                                            border-radius: 5px;
                                            margin-top: 20px;
                                        }
                                        .footer {
                                            text-align: center;
                                            margin-top: 20px;
                                            color: #777777;
                                        }
                                    </style>
                                </head>
                                <body>
                                    <div class="container">
                                        <div class="header">
                                            <div class="" style="padding:1em; width: 50px; height: 50px;">
                                             <img src="cid:logo_id" alt="Logo del Gimnasio" />
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h2>¡Recupera tu contraseña!</h2>
                                            <p>Hola, hemos recibido una solicitud para recuperar tu contraseña en <b>Fitness Life</b>.</p>
                                            <p>Contraseña:</p>
                                            <h1>' . $contraseña . '</h1>
                                            <p>Si no solicitaste la recuperación, puedes ignorar este correo.</p>
                                        </div>
                                        <div class="footer">
                                            <p>Gracias por ser parte de <b>Fitness Life</b>.</p>
                                            <p>Si tienes alguna duda, no dudes en ponerte en contacto con nosotros.</p>
                                        </div>
                                    </div>
                                </body>
                                </html>';

                        $mail->AltBody = 'Hola, hemos recibido una solicitud para recuperar tu contraseña en Fitness Life. Para restablecerla, visita el siguiente enlace: http://www.tugimnasio.com/restaurar?email=' . $correo . '. Si no solicitaste la recuperación, ignora este correo.';


                        $mail->send();
                        echo '<div class="container mt-4 d-flex justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.5); z-index: 1000;">
                        <div id="alerta-exito" class="alert alert-success alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;">
                               <div class="row">
                                <div class="col-12" style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                                <i class="bi bi-check-circle-fill" style="font-size: 10px;"></i> 
                                 <strong style="font-size: 10px;">¡El Mesaje se ha enviado a su correo!</strong>
                                </div>
                               </div>
                        </div>
                      </div>';
                        echo '<script>
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                        </script>';
                        echo "<script>
                        setTimeout(function() {
                        window.location.href = '../index.php';
                        }, 2000);
                     </script>";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    echo '<div class="alert alert-danger fs-6">El correo no existe</div>';
                }
            }
        }
    }


    public function mostrarPlan()
    {
        $modelo = new LoginModel();

        $id_usuario = $_SESSION['id_usuario'];

        $resultado = $modelo->MostrarPlanPerfil($id_usuario);

        if ($resultado) {
            $plan = $resultado['nombre_plan'];

            switch ($plan) {
                case 'Básico':
                    echo "<p style='font-size: 30px'>basico</p>";
                    break;
                case 'Estándar':
                    echo "<p style='font-size: 30px'>estandar</p>";
                    break;
                case 'VIP':
                    echo "<p style='font-size: 30px'>VIP</p>";
                    break;
                default:
                    echo "";
                    break;
            }
        }
    }

    public function mostrarNotificacionesPlanVencido()
    {
        $id_usuario = $_SESSION['id_usuario'];

        $modelo = new PlanesModel();
        $result =  $modelo->getPlanActivo($id_usuario);

        if ($result == null) {
            echo ' <span style="
        position: absolute;
        top: -7px;
        right: -7px;
        background: red;
        color: white;
        padding: 2px 8px;
        font-size: 12px;
        border-radius: 50%;
        font-weight: bold;">
        1
         </span>';
        } else {
            echo '';
        }
    }

    public function actualizarPerfil()
    {
        if (isset($_POST['actualizarPerfil'])) {

            $id_usuario = $_SESSION['id_usuario'];
            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $correo = trim($_POST['correo']);

            $contraseña = null;
            if (!empty($_POST['password'])) {
                $contraseña = trim($_POST['password']);
            }



            $loginModel = new LoginModel();
            $resultado = $loginModel->CambiarDatosUsuario($id_usuario, $nombre, $apellido, $correo, $contraseña);

            if ($resultado) {
                
                $_SESSION['nombre_usuario'] = $nombre;
                $_SESSION['apellido'] = $apellido;
                $_SESSION['correo'] = $correo;

                echo '<div class="container mt-4 d-flex justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.5); z-index: 1000;">
                <div class="alert alert-success alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;">
                    <strong>Perfil actualizado correctamente.</strong>
                </div>
            </div>';
                echo '<script>
                          setTimeout(function() {
                              location.reload();
                          }, 2000);
                        </script>';
                echo "<script>
                                setTimeout(function() {
                                window.location.href = 'dashboard.php';
                                }, 2000);
                            </script>";
            } else {
                echo '<div class="container mt-4 d-flex justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.5); z-index: 1000;">
                <div class="alert alert-danger alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;">
                    <strong>Error al actualizar el perfil.</strong>
                </div>
            </div>';
                echo '<script>
                          setTimeout(function() {
                              location.reload();
                          }, 2000);
                        </script>';
                echo "<script>
                                setTimeout(function() {
                                window.location.href = 'dashboard.php';
                                }, 2000);
                            </script>";
            }
        }
    }
}

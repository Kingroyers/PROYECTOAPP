<?php
require_once realpath(dirname(__FILE__) . '/../Model/ClaseModel.php');
require_once realpath(dirname(__FILE__) . '/../Model/LoginModel.php');

class ClaseController
{
    private $modelo;

    public function mostrarClasesPorFecha()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id_usuario = $_SESSION['id_usuario'];
        $LoginModel = new LoginModel();
        $usuarioExiate = $LoginModel->UsuarioExiste($id_usuario);
        if (!$usuarioExiate) {
            echo '
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10">
                          <div class="alert alert-danger d-flex align-items-center flex-wrap" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-3"></i>
                             <div class="me-2 justify-content-center d-flex">
                                Usuario debe pagar un plan o estar registrado para que pueda visualizar las clases
                              </div>
                              <div class="col-12 mt-4">
                              <a href="/ProyectoAPP/View/Planes.php" class="btn btn-primary w-100">Comprar Plan</a>
                              </div>
                           </div>
                        </div>
                    </div>
                </div>
                ';
        } else {
            $modelo = new ModeloClases();
            $clases = $modelo->obtenerClases();
            date_default_timezone_set('America/Bogota');
            $fecha_actual = isset($_GET['fecha_seleccionada']) ? $_GET['fecha_seleccionada'] : date('Y-m-d');
            $actual_timestamp = strtotime(date('Y-m-d H:i'));
            foreach ($clases as $row) {
                if ($row['fecha'] != $fecha_actual) continue;
                $nombre_clase = strtolower($row['nombre_clase']);
                switch ($nombre_clase) {
                    case 'yoga':
                        $icon = 'src/img/inconos/iconos-Yoga.png';
                        break;
                    case 'zumba':
                        $icon = 'src/img/inconos/iconos-zumba.png';
                        break;
                    case 'boxing':
                        $icon = 'src/img/inconos/iconos-Boxing.png';
                        break;
                    case 'cardio':
                        $icon = 'src/img/inconos/iconos-Running.png';
                        break;
                    case 'spinning':
                        $icon = 'src/img/inconos/iconos-spinning.png';
                        break;
                    case 'ironcwout':
                        $icon = 'src/img/inconos/Icons-Biceps.png';
                        break;
                    case 'crossfit':
                        $icon = 'src/img/inconos/muscle.png';
                        break;

                    default:
                        $icon = 'src/img/inconos/logo.png';
                        break;
                }
                $imagenEntrenador = match (strtolower($row['entrenador'])) {
                    "antonio royero" => "src/img/Entrenador3.png",
                    "samuel alzate" => "src/img/entrenadorcopia.png",
                    "camilo aguilar"   => "src/img/entrenador4.png",
                    default         => "src/img/default.png"
                };
                $horario_clase = strtotime($row['fecha'] . ' ' . $row['horario']);
                if ($horario_clase < $actual_timestamp) {
                    $estado = "<button class='btn btn-secondary' disabled>Cerrada</button>";
                    $desabilitar = "pointer-events: ; opacity: 0.5;";
                } else {
                    $controller = new ClaseController();
                    $controller->inscribirClase();
                    $model = new ModeloClases();
                    $inscripcion = $model->ValidarInscripcion($row['id_clase'], $id_usuario);
                    if ($inscripcion) { //si el vale esta inscrito a la clase 
                        $controller->ElimnarInscripcion();
                        $id_clase = $row['id_clase'];
                        $id_usuario = $_SESSION['id_usuario'];
                        $estado = "
                        <form method='POST' action=''> 
                         <input type='hidden' name='id_clase' value='$id_clase'>
                         <input type='hidden' name='id_usuario' value='$id_usuario'>
                         <button type='submit' class='btn btn-outline-danger'name='btnEliminarInscripcion' >Eliminar Inscripcion</button>
                        </form> 
                         ";
                        $desabilitar = "";
                    } else {
                        $id_clase = $row['id_clase'];
                        $model = new ModeloClases;
                        $verificarCapacidad = $model->VerificarCapacidadMaxima($id_clase);
                        if ($verificarCapacidad) {
                            $estado = "
                            <form method='POST' action=''>
                                <input type='hidden' name='id_clase' value='$id_clase'>
                              <button type='submit' name='btnInscripcion' id={$row['fecha']}' class='btn btn-success' style='width:100%;  margin-left:10px; ' >
                               Inscribirse
                               </button>
                            </form>";
                            $desabilitar = "pointer-events: auto; opacity: 1;";
                        } else {
                            $estado = "
                            <button type='submit' class='btn btn-outline-secondary' style='width:100%;  margin-left:10px; border:1px solid ; height:auto;' >
                               No hay cupo disponible
                               </button>
                            ";
                            $desabilitar = "pointer-events: none; opacity: 0.5;";
                        }
                    }
                }

                echo "
            <div class='col-12 d-flex col-md-4 p-3 justify-align-content-between' style='$desabilitar margin:4px 4px; border: 1px solid #ccc; max-height: 280px; border-radius: 64px 10px 10px 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);'>
                <div class='col-5 d-flex justify-content-center align-items-center position-relative'>
                    <img src='$imagenEntrenador' alt='Imagen' class='img-fluid position-absolute bottom-0' width='100% '>
                    <div class='' style='display: flex; justify-content: center; align-items: center; position: absolute; top: -18px; left: -16px; border-radius: 50%; width: 50px; height: 50px; background: #587099; overflow: hidden; padding: 3px;'>
                      <img src='$icon' alt='icono' class='img-fluid' style='width: 2rem; height: 2rem'>
                    </div>
                </div>
                <div class='col-6 d-flex flex-column justify-content-center align-align-items-center'>
                    <h5 class='align-self-center'>{$row['nombre_clase']}</h5>
                    <p style='font-size: 16px;'>{$row['entrenador']}</p>
                    <p>{$row['fecha']}</p>
                    <p>{$row['horario']}</p>
                    $estado
                </div>

            </div>";
            }
        }
    }

    public function ObtenerDiaSemana()
    {
        date_default_timezone_set('America/Bogota');
        $fecha_actual = date('Y-m-d');
        $inicio_semana = date('Y-m-d', strtotime('Monday this week'));
        $nombres_dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $dia_semana = [];
        for ($i = 0; $i < 7; $i++) {
            $dia_semana[] = date('Y-m-d', strtotime("+$i day", strtotime($inicio_semana)));
        }
        foreach ($dia_semana as $index => $dia) {
            $es_hoy = ($dia == $fecha_actual);
            if ($es_hoy) {
                $clase_hoy = "hoy";
            } else {
                $clase_hoy = "bg-light";
            }
            $id = $es_hoy ? "id='hoy'" : "";
            echo "<form method='GET' action=''>
            <input type='hidden' name='fecha_seleccionada' value='$dia'>
            <button type='submit' class='dia $clase_hoy' $id style='all:unset; cursor:pointer; flex: 0 0 auto; width: 110px; text-align: center; border: 1px solid #ddd; border-radius: 10px; padding: 15px; transition: transform 0.2s, box-shadow 0.2s; scroll-snap-align: center; margin-right:3px;'>
                <p class='numero-dia'>" . date("d", strtotime($dia)) . "</p>
                <p class='nombre-dia'>" . $nombres_dias[$index] . "</p>
            </button>
        </form>";
        }
    }

    public function mostrarClasesDashboard()
    {
        $modelo = new ModeloClases();
        $clases = $modelo->obtenerClasesOrdenadas();
        date_default_timezone_set('America/Bogota');
        $fecha_actual = date('Y-m-d');
        $actual_timestamp = strtotime(date('Y-m-d H:i'));
        foreach ($clases as $row) {
            if ($row['fecha'] != $fecha_actual) continue;
            $nombre_clase = strtolower($row['nombre_clase']);
            switch ($nombre_clase) {
                case 'yoga':
                    $icon = 'src/img/Icons-Yoga.png';
                    break;
                case 'zumba':
                    $icon = 'src/img/inconos/icons-zumba.png';
                    break;
                case 'boxing':
                    $icon = 'src/img/inconos/icons-boxing.png';
                    break;
                case 'cardio':
                    $icon = 'src/img/running.png';
                    break;
                case 'spinning':
                    $icon = 'src/img/inconos/GuidanceSpinning.png';
                    break;
                case 'ironcwout':
                    $icon = 'src/img/Icons-Biceps.png';
                    break;
                case 'crossfit':
                    $icon = 'src/img/icons-peso-rusa.png';
                    break;

                default:
                    $icon = 'src/img/inconos/logo.png';
                    break;
            }
            $horario_clase = strtotime($row['fecha'] . ' ' . $row['horario']);
            if ($horario_clase < $actual_timestamp) {
                $estado = "pointer-events: none; opacity: 0.5;";
            } else {
                $estado = "pointer-events: auto; opacity: 1;";
            }
            if ($nombre_clase == "ironcwout") {
                $estilos = "min-width: 150px; height: 3.5rem;";
            } else {
                $estilos = "min-width: 120px; height: 3.5rem;";
            }
            echo "
            <div class='custom-proximas-clases' style='$estilos border:1px solid #fff; border-radius: 15px; box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 4px, rgba(14, 12, 110, 0.16) 0px 7px 13px -3px, rgba(16, 9, 83, 0.06) 0px -3px 0px inset;' >
                <div class='row' style='width: 100%; $estado;'>
                    <div class='col-4' style='display: flex; padding: 0; justify-content: center; align-items: center;'>
                        <img src='$icon' alt='icono' style='width: 40px; height: 40px;'>
                    </div>
                    <div class='col-8' style='display: flex; justify-content: center; align-items: center;'>
                        <p style='font-size: 14px; margin-top: 20px;'>{$row['nombre_clase']}</p>
                    </div>
                </div>
            </div>";
        }
    }

    public function inscribirClase()
    {
        if (isset($_POST['btnInscripcion'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $id_usuario = $_SESSION['id_usuario'];
            $id_clase = $_POST['id_clase'];
            $fecha = date('Y-m-d H:i:s');
            $LoginModel = new LoginModel();
            $usuarioExiste = $LoginModel->UsuarioExiste($id_usuario);
            if (!$usuarioExiste) {
                echo '<div class="container mt-4 d-flex justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.5);">
                <div class="alert alert-danger alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;">
                 <strong>Usuario no Registrado</strong>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
               </div>';
                echo "<script>
               setTimeout(function() {
               window.location.href = 'View/ClasesView.php';
               }, 2000);
                </script>";
                exit;
            } else {
                $model = new ModeloClases;
                $verificarCapacidad = $model->VerificarCapacidadMaxima($id_clase);
                if ($verificarCapacidad) {
                    $model = new ModeloClases();
                    $inscripcion = $model->ValidarInscripcion($id_clase, $id_usuario);
                    if (!$inscripcion) {
                        $modelo = new ModeloClases();
                        $resultado = $modelo->InscripcionClases($id_clase, $id_usuario, $fecha);
                        if ($resultado) {
                            echo '<div class="container mt-4 d-flex justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.5); z-index: 1000;">
                                    <div id="alerta-exito" class="alert alert-success alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;">
                                           <div class="row">
                                            <div class="col-12" style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                                            <i class="bi bi-check-circle-fill" style="font-size: 10px;"></i> 
                                             <strong style="font-size: 10px;">¡Inscripción exitosa!</strong>
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
                                    window.location.href = 'View/ClasesView.php';
                                    }, 2000);
                                </script>";
                        } else {
                            echo '<div class="container mt-4 d-flex justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.5); z-index: 1000;">
                                    <div class="alert alert-danger alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;">
                                     <strong>Error al inscribirse.</strong>                                
                                    </div>
                                  </div>';
                            echo '<script>
                                  setTimeout(function() {
                                      location.reload();
                                  }, 2000);
                                </script>';
                            echo "<script>
                                    setTimeout(function() {
                                    window.location.href = 'View/ClasesView.php';
                                    }, 2000);
                                </script>";
                        }
                    }
                }
            }
        }
    }

    public function ElimnarInscripcion()
    {
        if (isset($_POST['btnEliminarInscripcion'])) {
            $id_usuario = $_POST['id_usuario'];
            $id_clase = $_POST['id_clase'];
            $modelo = new ModeloClases();
            $resultado = $modelo->EliminarInscripcion($id_clase, $id_usuario);
            if ($resultado) {
                echo '<div class="container mt-4 d-flex justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.5); z-index: 1000;">
                           <div class="alert alert-danger alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;">
                             <div class="row">
                                <div class="col-12" style="display: flex; justify-content: center; align-items: center; gap: 5px;">
                                        <strong style="font-size: 10px;">¡Eliminaste Inscripcion!</strong>
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
                           window.location.href = 'View/ClasesView.php';
                       }, 2000);
                   </script>";
            } else {
                echo '<div class="container mt-4 d-flex justify-content-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(1.5); z-index: 1000;">
                           <div class="alert alert-danger alert-dismissible fade show shadow p-4 rounded text-center" role="alert" style="max-width: 100%; height: 50px; display: flex; justify-content: center; align-items: center;">
                            <strong>Error al eliminar </strong>
                           </div>
                          </div>';
                echo '<script>
                          setTimeout(function() {
                              location.reload();
                          }, 2000);
                        </script>';
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'View/ClasesView.php';
                        }, 2000);
                    </script>";
            }
        }
    }

    public function MostrarCLasesInscritas()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $fecha = date('Y-m-d');
        $id_usuario = $_SESSION['id_usuario'];
        $modelo = new ModeloClases();
        $clasesInscritas = $modelo->MostrarClasesInscritas($id_usuario, $fecha);
        date_default_timezone_set('America/Bogota');
        $actual_timestamp = strtotime(date('Y-m-d H:i'));
        foreach ($clasesInscritas as $row) {
            $nombre_clase = strtolower($row['nombre_clase']);
            $nombre_clase = strtolower($row['nombre_clase']);
            switch ($nombre_clase) {
                case 'yoga':
                    $icon = 'src/img/inconos/iconos-Yoga.png';
                    break;
                case 'zumba':
                    $icon = 'src/img/inconos/iconos-zumba.png';
                    break;
                case 'boxing':
                    $icon = 'src/img/inconos/iconos-Boxing.png';
                    break;
                case 'cardio':
                    $icon = 'src/img/inconos/iconos-Running.png';
                    break;
                case 'spinning':
                    $icon = 'src/img/inconos/iconos-spinning.png';
                    break;
                case 'ironcwout':
                    $icon = 'src/img/inconos/Icons-Biceps.png';
                    break;
                case 'crossfit':
                    $icon = 'src/img/inconos/muscle.png';
                    break;

                default:
                    $icon = 'src/img/inconos/logo.png';
                    break;
            }
            $imagenEntrenador = match (strtolower($row['entrenador'])) {
                "antonio royero" => "src/img/Entrenador3.png",
                "samuel alzate" => "src/img/entrenadorcopia.png",
                "uso carruso"   => "src/img/entrenador4.png",
                default         => "src/img/default.png"
            };
            $horario_clase = strtotime($row['fecha'] . ' ' . $row['horario']);
            if ($horario_clase < $actual_timestamp) {
                $estado = "<button class='btn btn-secondary' disabled>Cerrada</button>";
                $desabilitar = "pointer-events: ; opacity: 0.5;";
            } else {
                $controller = new ClaseController();
                $controller->inscribirClase();
                $model = new ModeloClases();
                $inscripcion = $model->ValidarInscripcion($row['id_clase'], $id_usuario);

                if ($inscripcion) {
                    $controller->ElimnarInscripcion();
                    $id_clase = $row['id_clase'];
                    $id_usuario = $_SESSION['id_usuario'];
                    $estado = "
                    <form method='POST' action=''> 
                     <input type='hidden' name='id_clase' value='$id_clase'>
                     <input type='hidden' name='id_usuario' value='$id_usuario'>
                     <button type='submit' class='btn btn-outline-danger'name='btnEliminarInscripcion' >Eliminar Inscripcion</button>
                    </form> 
                     ";
                    $desabilitar = "";
                } else {
                    $id_clase = $row['id_clase'];
                    $model = new ModeloClases;
                    $verificarCapacidad = $model->VerificarCapacidadMaxima($id_clase);
                    if ($verificarCapacidad) {
                        $estado = "
                        <form method='POST' action=''>
                            <input type='hidden' name='id_clase' value='$id_clase'>
                          <button type='submit' name='btnInscripcion' id={$row['fecha']}' class='btn btn-success' style='width:100%;  margin-left:10px; ' >
                           Inscribirse
                           </button>
                        </form>";
                        $desabilitar = "pointer-events: auto; opacity: 1;";
                    } else {
                        $estado = "
                        <button type='submit' class='btn btn-outline-secondary' style='width:100%;  margin-left:10px; border:1px solid ; height:auto;' >
                           No hay cupo disponible
                           </button>
                        ";
                        $desabilitar = "pointer-events: none; opacity: 0.5;";
                    }
                }
            }

            echo "
        <div class='col-12 d-flex col-md-4 p-3 justify-align-content-between' style='$desabilitar margin:4px 4px; border: 1px solid #ccc; max-height: 280px; border-radius: 64px 10px 10px 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);'>
            <div class='col-5 d-flex justify-content-center align-items-center position-relative'>
                <img src='$imagenEntrenador' alt='Imagen' class='img-fluid position-absolute bottom-0' width='100% '>
                <div class='' style='display: flex; justify-content: center; align-items: center; position: absolute; top: -18px; left: -16px; border-radius: 50%; width: 50px; height: 50px; background: #587099; overflow: hidden; padding: 3px;'>
                  <img src='$icon' alt='icono' class='img-fluid' style='width: 2rem; height: 2rem'>
                </div>
            </div>
            <div class='col-6 d-flex flex-column justify-content-center align-align-items-center'>
                <h5 class='align-self-center'>{$row['nombre_clase']}</h5>
                <p style='font-size: 16px;'>{$row['entrenador']}</p>
                <p>{$row['fecha']}</p>
                <p>{$row['horario']}</p>
                $estado
            </div>
        </div>";
        }
    }
}

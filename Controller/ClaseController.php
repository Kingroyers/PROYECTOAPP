<?php
require_once realpath(dirname(__FILE__) . '/../Model/ClaseModel.php');

class ClaseController{
    private $modelo;

    public function mostrarClasesHoy() 
    {
        $modelo = new ModeloClases();
        $clases = $modelo->obtenerClases();

        date_default_timezone_set('America/Bogota');
        $fecha_actual = date('Y-m-d');
        $actual_timestamp = strtotime(date('Y-m-d H:i'));

        foreach ($clases as $row) {
            if ($row['fecha'] != $fecha_actual) continue;

            // Icono según tipo de clase
            $icon = "bi-calendar-check";
            switch (strtolower($row['nombre_clase'])) {
                case "yoga": $icon = "src/img/icons-yoga.png"; break;
                case "zumba": $icon = "src/img/inconos/icons-zumba.png"; break;
                case "boxing": $icon = "src/img/inconos/icons-boxing.png"; break;
                case "cardio": $icon = "src/img/running.png"; break;
            }

            // Imagen del entrenador
            $imagenEntrenador = match (strtolower($row['entrenador'])) {
                "antonio royero" => "src/img/Entrenador3.png",
                "samuel alzate" => "src/img/entrenadorcopia.png",
                "uso carruso"   => "src/img/entrenador.png",
                default         => "default.jpg"
            };

            // Estado de la clase
            $horario_clase = strtotime($row['fecha'] . ' ' . $row['horario']);
            $estado = $horario_clase < $actual_timestamp
                ? "<button class='btn btn-secondary' disabled>Clase Finalizada</button>"
                : "<a href='inscribirse.php?id={$row['fecha']}' class='btn btn-success'>Inscribirse</a>";

            // Mostrar HTML
            echo "
            <div class='col-12 d-flex col-md-5 p-3 justify-align-content-between' style='margin:4px 4px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);'>

                <div class='col-5 d-flex justify-content-center align-items-center position-relative'>
                    <img src='$imagenEntrenador' alt='Imagen' class='img-fluid position-absolute bottom-0' width='100%'>
                    <img src='$icon' alt='icono' class='img-fluid' style='width: 40px; height: 40px; position: absolute; top: 10px; left: 10px;'>
                </div>

                <div class='col-6 d-flex flex-column justify-content-center align-align-items-center'>
                    <h5 class='align-self-center'>{$row['nombre_clase']}</h5>
                    <p>Entrenador: {$row['entrenador']}</p>
                    <p>Fecha: {$row['fecha']}</p>
                    <p>Hora: {$row['horario']}</p>
                    $estado
                </div>

            </div>";
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
            $clase_hoy = ($dia == $fecha_actual) ? "hoy" : "bg-light";

            echo "<div class='dia $clase_hoy' style='flex: 0 0 auto; width: 130px; text-align: center; border: 1px solid #ddd; border-radius: 10px; padding: 15px; transition: transform 0.2s, box-shadow 0.2s; scroll-snap-align: center; scrollbar-width: 1px;'>
                    
             <p class='numero-dia'>" . date("d", strtotime($dia)) . "</p>
             <p class='nombre-dia'>" . $nombres_dias[$index] . "</p>
            
            </div>";
        }

        echo "</div>";
    }

    public function mostrarClasesDashboard() {
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
                    $icon = 'src/img/inconos/iconos-spinning.png';
                    break;
                case 'IronCWout':
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

            echo "
            <div class='custom-proximas-clases item'>
                <div class='row' style='width: 100%; $estado;'>
                    <div class='col-4' style='display: flex; padding: 0; justify-content: center; align-items: center;'>
                        <img src='$icon' alt='icono' style='width: 40px; height: 40px;'>
                    </div>
                    <div class='col-8' style='display: flex; justify-content: center; align-items: center;'>
                        <h6>{$row['nombre_clase']}</h6>
                    </div>
                </div>
            </div>";
        }
    }

    
}


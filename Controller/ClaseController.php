<?php
require_once '../Model/ClaseModel.php';


class ClaseController
{
    private $modelo;

    public function obtenerClases()
    {
        $conexion = new ConexionBD();
        $db = $conexion->getConexion();

        // Consultar todas las clases ordenadas por fecha y hora
        $sql = "SELECT * FROM clases ORDER BY fecha >= CURDATE() DESC, fecha ASC, horario ASC;"; 
        $result = $db->query($sql);

        while ($row = $result->fetch_assoc()) { //fetch_assoc() obtiene una fila como un array asociativo
            $icon = "bi-calendar-check"; // Ícono por defecto
            if (strtolower($row['nombre_clase']) == "yoga") $icon = "src/img/icons-yoga.png";
            if (strtolower($row['nombre_clase']) == "zumba") $icon = "bi-music-note";
            if (strtolower($row['nombre_clase']) == "boxing") $icon = "bi-box";

            // $imagenEntrenador = "src/img/Entrenador4.png";

            // switch (strtolower($row['entrenador'])) {
            //     case "Antonio Royero":
            //         $imagenEntrenador = "../ProyectoAPP/src/img/Entrenador3.png";
            //         break;
            //     case "Samuel Alzate":
            //         $imagenEntrenador = "maria_lopez.jpg";
            //         break;
            //     case "carlos gomez":
            //         $imagenEntrenador = "carlos_gomez.jpg";
            //         break;
            //     // Agrega más casos según sea necesario
            //     default:
            //         $imagenEntrenador = "default.jpg";
            //         break;
            // }

            // Convertir la fecha de la clase en timestamp
            $fecha_clase = strtotime($row['fecha']);
            $horario_clase = strtotime($row['horario']);


            if ($fecha_clase < time()) {
                $estado = "<button class='btn btn-secondary' disabled>Clase Finalizada</button>";
            } else {
                $estado = "<a href='inscribirse.php?id={$row['id_clase']}' class='btn btn-success'>Inscribirse</a>";
            }


            echo "
            
            <div class='col-12 d-flex col-md-3 p-3 justify-align-content-between' style='margin:4px 4px; border: 1px solid #ccc; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);'>"
                
                // . "<div class='col-6 d-flex justify-content-center align-items-center' style='border:1px solid;' >"
                //    . "<img src='src/img/$imagenEntrenador' alt='Imagen' class='img-fluid rounded-circle' style='width: 100px; height: 100px;'>"
                // . "</div>"

                . "<div class='col-12 d-flex flex-column justify-content-center align-align-items-center'>"

                   . "<i class='bi $icon icon'></i>"
                   . "<h5 class='align-self-center'>{$row['nombre_clase']}</h5>"
                   . "<p>Entrenador: {$row['entrenador']}</p>"
                   . "<p>Fecha: {$row['fecha']}</p>"
                   . "<p>hora: {$row['horario']}</p>"
                   . $estado // Botón de inscripción o mensaje de clase finalizada

                .  "</div>"
                
            . "</div>";
        }
    }
}

<?php

$conexion = new mysqli("localhost", "root", "", "appBD") or die("Error de conexion: " . mysqli_error($conexion));

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
} else {
    //  echo "Conectado correctamente a la base de datos";
}



?>
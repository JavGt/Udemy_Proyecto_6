<?php
function conectarDB() : mysqli {
    $conexion = mysqli_connect('localhost','root','','bienes_raices');

    if (!$conexion) {
       echo "Fallo en la conexión";
       exit;
    }
    
    return $conexion;
}

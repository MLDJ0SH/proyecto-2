<?php


$conexion = mysqli_connect("localhost","root","","hospital_db");

if($conexion){
    echo 'Conectado exitosamente a la base de datos';
}else{
    echo 'No se ha podido conectar a la Base de Datos';
}



?>
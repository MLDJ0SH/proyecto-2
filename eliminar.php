<?php
include 'conexion.php';

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM hospitals WHERE id = $id";

    if (mysqli_query($conexion, $query)) {
        header("Location: listado.php");
        exit;
    } else {
        echo "Error al eliminar el hospital: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>

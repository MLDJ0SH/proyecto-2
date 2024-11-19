<?php
include 'conexion.php';

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$hospital_n = isset($_POST['hospital_n']) ? $_POST['hospital_n'] : null;
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;
$estado = isset($_POST['estado']) ? $_POST['estado'] : null;
$codigo_postal = isset($_POST['codigo_postal']) ? $_POST['codigo_postal'] : null;
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$registared_date = (new DateTime())->format('Y-m-d H:i:s');

// Manejar la imagen del hospital
$hospital_image = null;
if (isset($_FILES['hospital_image']) && $_FILES['hospital_image']['error'] == UPLOAD_ERR_OK) {
    $image_tmp_name = $_FILES['hospital_image']['tmp_name'];
    $image_name = basename($_FILES['hospital_image']['name']);
    $upload_dir = 'uploads/';

    // Crear el directorio si no existe
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $upload_file = $upload_dir . $image_name;

    if (move_uploaded_file($image_tmp_name, $upload_file)) {
        $hospital_image = $upload_file;
    } else {
        echo "Error al subir la imagen.";
    }
}

// Insertar datos en la base de datos
$query = "INSERT INTO hospitals (hospital_n, direccion, ciudad, estado, codigo_postal, descripcion, telefono, email, registared_date, hospital_image) 
VALUES ('$hospital_n', '$direccion', '$ciudad', '$estado', '$codigo_postal', '$descripcion', '$telefono', '$email', '$registared_date', '$hospital_image')";

if (mysqli_query($conexion, $query)) {
    echo "Hospital registrado con éxito!";
} else {
    echo "Error al registrar el hospital: " . mysqli_error($conexion);
}



mysqli_close($conexion);
?>





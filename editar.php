<?php
include 'conexion.php';

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener datos actuales del hospital
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM hospitals WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);
    $hospital = mysqli_fetch_assoc($resultado);
}

// Actualizar datos del hospital
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $hospital_n = $_POST['hospital_n'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $estado = $_POST['estado'];
    $codigo_postal = $_POST['codigo_postal'];
    $descripcion = $_POST['descripcion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $query = "UPDATE hospitals SET hospital_n = '$hospital_n', direccion = '$direccion', ciudad = '$ciudad', estado = '$estado', codigo_postal = '$codigo_postal', descripcion = '$descripcion', telefono = '$telefono', email = '$email' WHERE id = $id";

    if (mysqli_query($conexion, $query)) {
        header("Location: listado.php");
        exit;
    } else {
        echo "Error al actualizar el hospital: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Hospital</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Editar Hospital</h2>
    <form method="POST" action="editar.php">
        <input type="hidden" name="id" value="<?php echo $hospital['id']; ?>" />

        <label for="hospital_n">Nombre del Hospital:</label>
        <input type="text" name="hospital_n" value="<?php echo $hospital['hospital_n']; ?>" required />

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" value="<?php echo $hospital['direccion']; ?>" required />

        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" value="<?php echo $hospital['ciudad']; ?>" required />

        <label for="estado">Estado:</label>
        <input type="text" name="estado" value="<?php echo $hospital['estado']; ?>" required />

        <label for="codigo_postal">Código Postal:</label>
        <input type="text" name="codigo_postal" value="<?php echo $hospital['codigo_postal']; ?>" required />

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?php echo $hospital['descripcion']; ?></textarea>

        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" value="<?php echo $hospital['telefono']; ?>" />

        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" value="<?php echo $hospital['email']; ?>" />

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>

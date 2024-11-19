<?php
include 'conexion.php';

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Configuración de la paginación
$limite = 5;
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina > 1) ? ($pagina * $limite) - $limite : 0;

$resultado_total = mysqli_query($conexion, "SELECT COUNT(*) as total FROM hospitals");
$total_hospitales = mysqli_fetch_assoc($resultado_total)['total'];
$total_paginas = ceil($total_hospitales / $limite);

$query = "SELECT * FROM hospitals LIMIT $inicio, $limite";
$resultado = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Hospitales</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Listado de Hospitales</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Estado</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($hospital = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $hospital['hospital_n']; ?></td>
                <td><?php echo $hospital['direccion']; ?></td>
                <td><?php echo $hospital['ciudad']; ?></td>
                <td><?php echo $hospital['estado']; ?></td>
                <td><?php echo $hospital['telefono']; ?></td>
                <td><?php echo $hospital['email']; ?></td>
                <td>
                    <a href="editar.php?id=<?php echo $hospital['id']; ?>">Editar</a>
                    <a href="eliminar.php?id=<?php echo $hospital['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este hospital?');">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
            <a href="listado.php?pagina=<?php echo $i; ?>" class="<?php if ($pagina == $i) echo 'active'; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>

<?php
mysqli_close($conexion);
?>

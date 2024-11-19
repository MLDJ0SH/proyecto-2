<?php
session_start();

include 'conexion.php';

$full_name = $_POST['full_name'];
$contra = $_POST['contra'];

$validar = mysqli_query($conexion, "SELECT * FROM users WHERE full_name = '$full_name' and contra = '$contra' ");

if (mysqli_num_rows($validar) > 0) {
 
    $_SESSION['users'] = $full_name;

 
    echo '<script>
        sessionStorage.setItem("login", 1);
        window.location.href = "http://localhost/Hospital/home.html";
    </script>';
    exit;
} else {

    echo '<script>
        alert("Usuario no existe, por favor verifique los datos introducidos");
        window.location.href = "http://localhost/Hospital/sesion.html";
    </script>';
    exit;
} 
 
?>
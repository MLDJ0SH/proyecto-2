<?php
include 'conexion.php';

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$contra = $_POST['contra'];
$phone = $_POST['phone'];

$query = "INSERT INTO users(full_name, email, contra , telefono)
          VALUES ('$full_name','$email','$contra','$phone')";
 $ejecutar = mysqli_query($conexion, $query);
 // Registro
$password_hashed = password_hash($password, PASSWORD_BCRYPT);
// Login
if (password_verify($password, $password_hashed)) { /* Login exitoso */ }


 if($ejecutar){
     echo '
     <script>
     alert("Usuario almacenado exitosamente");
     window.location = "sesion.html";
     </script>
     ';
 } else{
     echo '
     <script>
     alert("Intentalo de nuevo, usuario no almacenado ");
     window.location = "login_usuario.html";
     </script>
     ';
 }
 
 mysqli_close($conexion);
?>
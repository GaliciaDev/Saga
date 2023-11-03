<?php
/* Definir que trabajaremos con variables de sesion */
session_start();
include '../php/conexion.php';

/* Variables de acceso */
$matricula = $_POST['matricula'];
$clave = $_POST['clave'];

/* Consulta y verificación del usuario */
$validar_login = mysqli_query($conexion, "SELECT Clave_A FROM alumnos WHERE id_alumno ='$matricula' LIMIT 1;");
$password_hash = mysqli_fetch_array($validar_login);

if (password_verify($clave, $password_hash['Clave_A'])) {
    /* Variables de sesión */
    $_SESSION['alumno'] = $matricula;
    header("location: ../index_alumno.php");
    exit;
} else {
    echo '
        <script>
            alert("Usuario no existe o la contraseña es incorrecta, por favor verifique los datos introducidos");
            window.location = "../views/formulario_alumnos.php";
        </script>
    ';
    exit;
}
?>


<?php
    /* Definir que trabajaremos con variables de sesion */
    session_start();
    include '../php/conexion.php';

    /* Variables de acceso */
    $matricula = $_POST['matricula'];
    $clave = $_POST['clave'];
    //Recuerda hashear la contraseña cuando la guardes en la base de datos  :D
    //$clave = hash('sha512', $clave);

    /* Consulta y verificacion del usuario */
    $validar_login = mysqli_query($conexion, "SELECT * FROM alumnos WHERE id_alumno ='$matricula'
    and Clave_A='$clave'");

    if (mysqli_num_rows($validar_login) > 0) {
        /* Variables de sesion */
        $_SESSION['alumno'] = $matricula;
        header("location: ../index_alumno.php");
        exit;

    }
    else {
        echo '
            <script>
                alert("Usuario no existe, por favor verifique los datos introducidos");
                window.location = "../views/formulario_alumnos.php";
            </script>
        ';

        exit;
    }


?>


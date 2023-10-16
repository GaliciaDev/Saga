<?php
    /* Definir que trabajaremos con variables de sesion */
    session_start();
    include '../php/conexion_be.php';

    /* Variables de acceso */
    $matricula = $_POST['matricula'];
    $clave = $_POST['clave'];
    //Recuerda hashear la contraseña cuando la guardes en la base de datos  :D
    //$clave = hash('sha512', $clave);

    /* Consulta y verificacion del usuario */
    $validar_login = mysqli_query($conexion, "SELECT * FROM docentes WHERE id_docente ='$matricula'
    and Clave='$clave'"); 

    if (mysqli_num_rows($validar_login) > 0) {
        /* Variables de sesion */
        $_SESSION['tutor'] = $matricula;
        header("location: ../index_docente.php");
        exit;

    }
    else {
        echo '
            <script>
                alert("Usuario no existe, por favor verifique los datos introducidos");
                window.location = "../views/formulario_docente.php";
            </script>
        ';

        exit;
    }


?>


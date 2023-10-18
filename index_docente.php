<?php
include 'php/variabledS.php';
include 'php/conexion_be.php';
validarSd();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="shortcut icon" href="assets/img/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Index del Docente</title>
</head>
<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="views/consulta_horarios_D.php">Horario</a></li>
                <li class="dropdown">
                    <button class="dropbtn">Captura Calificaciones</button>
                    <div class="dropdown-content">
                        <a href="views/capturas_calificaciones_D.php">Captura Calificaciones</a>
                        <a href="views/modificar_calificacion_D.php">Modificar Calificacion</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropbtn">Estadisticas Alumnos</button>
                    <div class="dropdown-content">
                        <a href="views/estadisticas_alumno_D.php">Alumno</a>
                        <a href="views/estadisticas_grupal_D.php">Grupal</a>
                    </div>
                </li>
                <li><a href="views/contactos_tutores_D.php">Contacto Tutores</a></li>
                <li><a href="php/cerrar_sesion">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>

    <br><br>    
    <table class="tabla_informacion">
        <tr>
            <h2>Información General</h2>
            <?php
            // Obtén la matrícula del docente desde la variable de sesión
            $matricula = $_SESSION['docente'];

            // Conexión a la BD
            $conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
            mysqli_select_db($conexion, "sagadb");

            // Realiza consulta
            $resultado = mysqli_query($conexion, "SELECT * FROM `docentes` WHERE `id_docente` = '$matricula' LIMIT 1;");

            $campo = mysqli_fetch_array($resultado);
            echo '
            <tr>
                <th rowspan="2"><img src="assets/img/img3.png" alt="MDN"></th>
                <th>Nombre</th>
                <td>' . $campo['nombreD'] . ' ' . $campo['apellidoPd'] . ' ' . $campo['apellidoMd'] . '</td>
                <th>Matricula</th>
                <td>' . $campo['id_docente'] . '</td>
                <th>Cargo</th>
                <td>' . $campo['cargoD'] . '</td>
            </tr>
            <tr>
                <th>Area</th>
                <td>' . $campo['areaD'] . '</td>
                <th>Telefono</th>
                <td>' . $campo['telefonoD'] . '</td>
                <th>Telefono de Emergencias</th>
                <td>' . $campo['telefonoEd'] . '</td>
            </tr>
            ';
            ?>
        </tr>
    </table><br><br><br>
</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
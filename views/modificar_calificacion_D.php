<?php
include '../php/variabledS.php';
validarSd();

// Conexión a la base de datos
include '../php/conexion.php';

// Obtén el nombre completo del docente desde la tabla `docentes`
$nombreDocente = "";
$consultaNombreDocente = "SELECT CONCAT(nombreD, ' ', apellidoPd, ' ', apellidoMd) AS nombre_completo FROM docentes WHERE id_docente = '{$_SESSION['docente']}'";
$resultadoNombreDocente = mysqli_query($conexion, $consultaNombreDocente);

if ($fila = mysqli_fetch_assoc($resultadoNombreDocente)) {
    $nombreDocente = $fila['nombre_completo'];
}

// Consulta para obtener las materias asociadas al docente desde la tabla `tira_materias`
$consultaMaterias = "SELECT * FROM tira_materias WHERE docente = '$nombreDocente'";
$resultadoMaterias = mysqli_query($conexion, $consultaMaterias);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilo_modificar_calificacion.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <title>Editar Calificaciones</title>
</head>
<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="../index_docente.php">Inicio</a></li>
                <li><a href="consulta_horarios_D.php">Horario</a></li>
                <li><a href="capturas_calificaciones_D.php">Captura Calificaciones</a></li>
                <li class="dropdown">
                    <button class="dropbtn">Estadisticas Alumnos</button>
                    <div class="dropdown-content">
                        <a href="estadisticas_alumno_D.php">Alumno</a>
                        <a href="estadisticas_grupal_D.php">Grupal</a>
                    </div>
                </li>
                <li><a href="contactos_tutores_D.php">Contacto Tutores</a></li>
                <li><a href="../php/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <h1>Editar Calificaciones</h1>
    <br><br>

    <?php
    // Recorremos las materias asociadas al docente
    while ($filaMaterias = mysqli_fetch_assoc($resultadoMaterias)) {
        $selectedMateria = $filaMaterias['Materias'];

        // Consulta para obtener las calificaciones de los estudiantes en la materia seleccionada
        $consultaCalificaciones = "SELECT * FROM `materias` WHERE `Nom_Materia` = '$selectedMateria'";
        $resultadoCalificaciones = mysqli_query($conexion, $consultaCalificaciones);

        echo "<h2>$selectedMateria</h2>";
        echo "<table class='tabla_calificaciones'>";
        echo "<tr>";
        echo "<th>ID Alumno</th>";
        echo "<th>Calificación 1</th>";
        echo "<th>Calificación 2</th>";
        echo "<th>Calificación 3</th>";
        echo "<th>Faltas 1</th>";
        echo "<th>Faltas 2</th>";
        echo "<th>Faltas 3</th>";
        echo "</tr>";

        // Recorremos los datos de las calificaciones de la materia actual
        while ($filaCalificaciones = mysqli_fetch_assoc($resultadoCalificaciones)) {
            echo "<tr>";
            echo "<td>" . $filaCalificaciones['id_alumno'] . "</td>";
            echo "<td>" . $filaCalificaciones['Calificacion_1'] . "</td>";
            echo "<td>" . $filaCalificaciones['Calificacion_2'] . "</td>";
            echo "<td>" . $filaCalificaciones['Calificacion_3'] . "</td>";
            echo "<td>" . $filaCalificaciones['Faltas_1'] . "</td>";
            echo "<td>" . $filaCalificaciones['Faltas_2'] . "</td>";
            echo "<td>" . $filaCalificaciones['Faltas_3'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>
</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
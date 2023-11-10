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
    <link rel="stylesheet" type="text/css" href="../css/estilo_modificar_D.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../css/diseño_movil.css">
    <title>Editar Calificaciones</title>
</head>
<body>
    <?php include '../php/nav_D.php'; ?>
    <center><br><h1>Modificar Calificaciones</h1><br><br>
<!-- Formulario para ingresar el ID del alumno -->
<form action="modificar_calificacion_D.php" method="POST">
    <label for="id">Ingrese el ID del alumno:</label>
    <input class="dato" autofocus type="text" name="id_alumno" id="id_alumno" placeholder="Ingrese una Matricula">
    <input type="submit" value="Buscar">
</form>
<?php
// Verificar si se ha enviado el formulario
if ($_POST) {
    // Obtener el ID del alumno desde el formulario
    $id_alumno = $_POST['id_alumno'];

    // Conexión a la BD
    include '../php/conexion.php';
    mysqli_select_db($conexion, "sagadb");

    // Consulta para obtener los datos de calificaciones y faltas del alumno
    $consulta_calificaciones = "SELECT * FROM materias WHERE id_alumno = '$id_alumno'";
    $resultado_calificaciones = mysqli_query($conexion, $consulta_calificaciones);

    // Verificar si se encontraron resultados
    if (mysqli_num_rows($resultado_calificaciones) > 0) {
        echo '<h2>Calificaciones del Alumno</h2>';
        echo '<form method="POST">';
        echo '<input type="hidden" name="id_alumno" value="' . $id_alumno . '">';
        echo '<table class="tabla_informacion">';
        echo '
        <tr>
            <th>Materia</th>
            <th>1er Trimestre</th>
            <th>2do Trimestre</th>
            <th>3er Trimestre</th>
            <th>Faltas 1er Trimestre</th>
            <th>Faltas 2do Trimestre</th>
            <th>Faltas 3er Trimestre</th>            
        </tr>';

        $i = 0; // Inicializamos el índice
        while ($fila_calificaciones = mysqli_fetch_assoc($resultado_calificaciones)) {
            echo '<tr>';
            echo '<td>' . $fila_calificaciones['Nom_Materia'] . '</td>';
            echo '<td><input class="dato" type="number" max=100 name="calificacion_1['.$i.']" value="' . $fila_calificaciones['Calificacion_1'] . '"></td>';
            echo '<td><input class="dato" type="number" max=100 name="calificacion_2['.$i.']" value="' . $fila_calificaciones['Calificacion_2'] . '"></td>';
            echo '<td><input class="dato" type="number" max=100 name="calificacion_3['.$i.']" value="' . $fila_calificaciones['Calificacion_3'] . '"></td>';
            echo '<td><input class="dato" type="number" max=100 name="faltas_1['.$i.']" value="' . $fila_calificaciones['Faltas_1'] . '"></td>';
            echo '<td><input class="dato" type="number" max=100 name="faltas_2['.$i.']" value="' . $fila_calificaciones['Faltas_2'] . '"></td>';
            echo '<td><input class="dato" type="number" max=100 name="faltas_3['.$i.']" value="' . $fila_calificaciones['Faltas_3'] . '"></td>';            
            echo '</tr>';
            $i++; // Incrementamos el índice en cada iteración
        }
        echo '</table>';
        echo '<br><br><input type="submit" name="guardar_cambios" value="Guardar Cambios"><br><br>';
        echo '</form>';
    } else {
        echo '<p>El alumno no fue encontrado o no tiene calificaciones registradas.</p>';
    }

    // Procesar los cambios en la base de datos si se envió el formulario
    if (isset($_POST['guardar_cambios'])) {
        // Recuperar el ID del alumno
        $id_alumno = $_POST['id_alumno'];

        // Recuperar los valores actualizados del formulario
        $calificaciones_1 = $_POST['calificacion_1'];
        $calificaciones_2 = $_POST['calificacion_2'];
        $calificaciones_3 = $_POST['calificacion_3'];
        $faltas_1 = $_POST['faltas_1'];
        $faltas_2 = $_POST['faltas_2'];
        $faltas_3 = $_POST['faltas_3'];

        // Obtener la lista de nombres de materias
        $consulta_materias = "SELECT DISTINCT Nom_Materia FROM materias WHERE id_alumno = '$id_alumno'";
        $resultado_materias = mysqli_query($conexion, $consulta_materias);
        $materias = array();

        while ($fila_materia = mysqli_fetch_assoc($resultado_materias)) {
            $materias[] = $fila_materia['Nom_Materia'];
        }

        // Iterar sobre los valores actualizados y realizar las actualizaciones en la BD
        for ($i = 0; $i < count($materias); $i++) {
            // Obtener los valores actualizados
            $nombre_materia = $materias[$i];
            $nueva_calificacion_1 = mysqli_real_escape_string($conexion, $calificaciones_1[$i]);
            $nueva_calificacion_2 = mysqli_real_escape_string($conexion, $calificaciones_2[$i]);
            $nueva_calificacion_3 = mysqli_real_escape_string($conexion, $calificaciones_3[$i]);
            $nuevas_faltas_1 = mysqli_real_escape_string($conexion, $faltas_1[$i]);
            $nuevas_faltas_2 = mysqli_real_escape_string($conexion, $faltas_2[$i]);
            $nuevas_faltas_3 = mysqli_real_escape_string($conexion, $faltas_3[$i]);

            // Construir la consulta de actualización
            $query_actualizar = "UPDATE materias SET ";
            if (!empty($nueva_calificacion_1)) {
                $query_actualizar .= "Calificacion_1 = '$nueva_calificacion_1', ";
            }
            if (!empty($nueva_calificacion_2)) {
                $query_actualizar .= "Calificacion_2 = '$nueva_calificacion_2', ";
            }
            if (!empty($nueva_calificacion_3)) {
                $query_actualizar .= "Calificacion_3 = '$nueva_calificacion_3', ";
            }
            if (!empty($nuevas_faltas_1)) {
                $query_actualizar .= "Faltas_1 = '$nuevas_faltas_1', ";
            }
            if (!empty($nuevas_faltas_2)) {
                $query_actualizar .= "Faltas_2 = '$nuevas_faltas_2', ";
            }
            if (!empty($nuevas_faltas_3)) {
                $query_actualizar .= "Faltas_3 = '$nuevas_faltas_3', ";
            }
            // Eliminar la coma final
            $query_actualizar = rtrim($query_actualizar, ', ');
            // Agregar la condición WHERE
            $query_actualizar .= " WHERE id_alumno = '$id_alumno' AND Nom_Materia = '$nombre_materia'";

            // Ejecutar la consulta de actualización
            mysqli_query($conexion, $query_actualizar);

            if (isset($_POST['guardar_cambios'])) {
                // ... (código anterior)
            
                // Iterar sobre los valores actualizados y realizar las actualizaciones en la BD
                for ($i = 0; $i < count($materias); $i++) {
                    // ... (código anterior)
                }
            
                echo '<p>Los cambios se han guardado correctamente. Modificación realizada.</p></center>';
            }
        }

        echo '<p>Los cambios se han guardado correctamente.</p></center>';
    }

    

    // Cerrar la conexión a la BD
    mysqli_close($conexion);
}
?>
</body>
<footer>
    <?php include '../php/footerG.php';?>
</footer>
</html>
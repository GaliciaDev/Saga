<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/capturas.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../css/diseño_movil.css">
    <title>Captura Calificacion Definitiva</title>
</head>
<body>
    <?php include '../php/nav_Admin.php'; ?>
    <body>
        <br><h1>Tabla de Calificaciones de Alumnos</h1>

        <br>
        <form method="POST" onsubmit="return confirmarCaptura()">
            <input type="submit" name="capturar" value="Capturar Calificaciones">
        </form>        
        <br><br>
        <script>
        function confirmarCaptura() {
            return confirm("¿Deseas capturar las calificaciones de los alumnos?");
        }
        </script>
        <table>
            <tr>
                <th>ID Alumno</th>
                <th>Nombre Completo</th>
                <th>Grado</th>
                <th>Grupo</th>
                <th>Nombre Materia</th>
                <th>Calificación</th>
                <th>Periodo</th>
                <th>Situación</th>
            </tr>

            <?php
            // Realizar la conexión a la base de datos
            include '../php/conexion.php';            

            // Obtener los datos de la tabla materias y alumnos
            $consulta_materias = "SELECT * FROM materias";
            $resultado_materias = mysqli_query($conexion, $consulta_materias);

            // Mostrar los datos en la tabla HTML si existen
            if(mysqli_num_rows($resultado_materias) > 0) {
                while ($row = mysqli_fetch_assoc($resultado_materias)) {
                    $id_alumno = $row['id_alumno'];
                    $materia = $row['Nom_Materia'];
                    $calificacion = $row['Promedio_Mat'];
                    $periodo = date('Y'); // Obtener el año actual

                    // Obtener el grado y grupo del alumno
                    $consulta_alumno = "SELECT nombre, apellidoP, apellidoM, grado, grupo FROM alumnos WHERE id_alumno = $id_alumno";
                    $resultado_alumno = mysqli_query($conexion, $consulta_alumno);
                    $fila_alumno = mysqli_fetch_assoc($resultado_alumno);

                    $nombre_completo = $fila_alumno['nombre'] . ' ' . $fila_alumno['apellidoP'] . ' ' . $fila_alumno['apellidoM'];
                    $grado = $fila_alumno['grado'];
                    $grupo = $fila_alumno['grupo'];

                    // Determinar la situación (aprobado o reprobado)
                    $situacion = ($calificacion >= 60) ? 'Aprobado' : 'Reprobado';

                    // Verificar si ya existe una fila con los mismos valores
                    $consulta_existencia = "SELECT COUNT(*) FROM calificaciones WHERE id_alumno = $id_alumno AND materia = '$materia'";
                    $resultado_existencia = mysqli_query($conexion, $consulta_existencia);
                    $fila_existencia = mysqli_fetch_row($resultado_existencia);
                    $existe_registro = $fila_existencia[0] > 0;

                    if (!$existe_registro) {
                        // Realizar la inserción en la tabla calificaciones con los nuevos datos
                        $insertar_calificacion = "INSERT INTO `calificaciones`(`materia`, `id`, `situacion`, `calificacion`, `periodo`, `id_alumno`, `grado`) VALUES ('$materia', null,'$situacion','$calificacion','$periodo','$id_alumno','$grado')";
                        mysqli_query($conexion, $insertar_calificacion);
                    }

                    // Mostrar los datos en la tabla HTML
                    echo "<tr>";
                    echo "<td>$id_alumno</td>";
                    echo "<td>$nombre_completo</td>";
                    echo "<td>$grado</td>";
                    echo "<td>$grupo</td>";
                    echo "<td>$materia</td>";
                    echo "<td>$calificacion</td>";
                    echo "<td>$periodo</td>";
                    echo "<td>$situacion</td>";
                    echo "</tr>";
                }
            } else {
                // Mostrar un mensaje si no hay datos en la tabla materias
                echo "<tr><td colspan='8'>No hay datos en la tabla materias.</td></tr>";
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
            ?>
        </table>
    </body>    

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            font-size: 15px;
            font-family: Arial, Helvetica, sans-serif;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>

    <footer>
    <?php include '../php/footerG.php';?>
    </footer>
</html>

<?php
if (isset($_POST['capturar'])) {
    // Realizar la conexión a la base de datos
    include '../php/conexion.php';    

    // Verificar si hay datos en la tabla materias
    $consulta_verificar = "SELECT COUNT(*) FROM materias";
    $resultado_verificar = mysqli_query($conexion, $consulta_verificar);
    $fila_verificar = mysqli_fetch_row($resultado_verificar);
    $hay_datos = $fila_verificar[0] > 0;

    if ($hay_datos) {
        // Obtener los datos de la tabla materias
        $consulta_materias = "SELECT * FROM materias";
        $resultado_materias = mysqli_query($conexion, $consulta_materias);

        while ($row = mysqli_fetch_assoc($resultado_materias)) {
            $id_alumno = $row['id_alumno'];
            $materia = $row['Nom_Materia'];
            $calificacion = $row['Promedio_Mat'];
            $periodo = date('Y'); // Obtener el año actual

            // Obtener el grado del alumno
            $consulta_grado = "SELECT grado FROM id_alumno WHERE id_alumno = $id_alumno";
            $resultado_grado = mysqli_query($conexion, $consulta_grado);
            $fila_grado = mysqli_fetch_assoc($resultado_grado);
            $grado = $fila_grado['grado'];

            // Determinar la situación (aprobado o reprobado)
            $situacion = ($calificacion >= 60) ? 'Aprobado' : 'Reprobado';

            // Verificar si ya existe una fila con los mismos valores
            $consulta_existencia = "SELECT COUNT(*) FROM calificaciones WHERE id_alumno = $id_alumno AND materia = '$materia'";
            $resultado_existencia = mysqli_query($conexion, $consulta_existencia);
            $fila_existencia = mysqli_fetch_row($resultado_existencia);
            $existe_registro = $fila_existencia[0] > 0;

            if (!$existe_registro) {
                // Realizar la inserción en la tabla calificaciones 
                $insertar_calificacion = "INSERT INTO `calificaciones`(`materia`, `id`, `situacion`, `calificacion`, `periodo`, `id_alumno`, `grado`) VALUES ('$materia', null,'$situacion','$calificacion','$periodo','$id_alumno','$grado')";
                mysqli_query($conexion, $insertar_calificacion);

                echo '<META HTTP-EQUIV="REFRESH" CONTENT="0.5;URL=capturar_calif_definitiva.php">';
            }
        }

        //Eliminar los datos de la tabla materias
        $eliminar_materias = "DELETE FROM materias";
        mysqli_query($conexion, $eliminar_materias);
    } else {
        // Mostrar mensaje si no hay datos en la tabla materias
        echo '<script>alert("No hay Calificaciones por capturar.");</script>';
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Redirigir a la página de captura después de procesar el formulario
    header('Location: capturar_calif_definitiva.php');
    exit(); // Asegura que el script se detenga después de la redirección
}
?>
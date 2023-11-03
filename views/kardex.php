<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/consulta_horarios.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">  
    <link rel="stylesheet" href="../css/diseño_movil.css">
    <title>Kardex</title>
    <style>
        /* Estilos de las tablas */
        .tabla-grande {
            float: left;
            width: 80%;
        }
        .tabla-pequena {
            float: right;
            width: 20%;
        }
        .tabla-grande th, .tabla-grande td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .tabla-pequena th, .tabla-pequena td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php include '../php/nav_A.php'; ?>

    <h1>Kardex</h1>

    <?php
        // Iniciar la sesión
        session_start();
        include '../php/variabledS.php';

        // Verificar si la variable de sesión 'alumno' está configurada
        if (isset($_SESSION['alumno'])) {
            // Obtener la matrícula del alumno de la variable de sesión
            $id_alumno = $_SESSION['alumno'];

            // Conexión a la base de datos
            include '../php/conexion.php';
            mysqli_select_db($conexion, "sagadb");

            // Consulta para obtener los datos de la tabla calificaciones
            $consulta_calificaciones = "SELECT materia, calificacion, periodo, situacion FROM calificaciones WHERE id_alumno = '$id_alumno'";
            $resultado_calificaciones = mysqli_query($conexion, $consulta_calificaciones);

            // Muestra los datos en la tabla grande
            if (mysqli_num_rows($resultado_calificaciones) > 0) {
                echo '<table class="tabla-grande">';
                echo '<tr>';
                echo '<th>Materia</th>';
                echo '<th>Calificación</th>';
                echo '<th>Periodo</th>';
                echo '<th>Situación</th>';
                echo '</tr>';

                while ($fila_calificacion = mysqli_fetch_assoc($resultado_calificaciones)) {
                    $materia = $fila_calificacion['materia'];
                    $calificacion = $fila_calificacion['calificacion'];
                    $periodo = $fila_calificacion['periodo'];
                    $situacion = ($calificacion >= 60) ? 'Aprobado' : 'Reprobado';

                    echo "<tr>";
                    echo "<td>$materia</td>";
                    echo "<td>$calificacion</td>";
                    echo "<td>$periodo</td>";
                    echo "<td>$situacion</td>";
                    echo "</tr>";
                }

                echo '</table>';
            } else {
                echo "No se encontraron calificaciones para el alumno con matrícula $id_alumno.";
            }

            // Tabla pequeña con grados cursados y promedio
            echo '<table class="tabla-pequena">';
            echo '<tr>';
            echo '<th>Año Cursado</th>';
            echo '<td>';
            $consulta_grados = "SELECT DISTINCT grado FROM calificaciones WHERE id_alumno = '$id_alumno'";
            $resultado_grados = mysqli_query($conexion, $consulta_grados);
            $grados_cursados = array();
            while ($fila_grado = mysqli_fetch_assoc($resultado_grados)) {
                $grado = $fila_grado['grado'];
                $grados_cursados[] = $grado;
            }
            echo implode(", ", $grados_cursados);
            echo '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<th>Promedio</th>';
            echo '<td>';
            $consulta_promedio = "SELECT AVG(calificacion) AS promedio FROM calificaciones WHERE id_alumno = '$id_alumno'";
            $resultado_promedio = mysqli_query($conexion, $consulta_promedio);
            $fila_promedio = mysqli_fetch_assoc($resultado_promedio);
            $promedio = $fila_promedio['promedio'];
            echo round($promedio, 2);
            echo '</td>';
            echo '</tr>';
            echo '</table>';
            $id = $id_alumno;
            echo '<br><br><br><br><a target="_blank" href="../php/imprimir_kardex.php?id_alumno='.$id.'"><button class="btnguardar">Imprimir PDF</button></a><br><br>';

            // Cierra la conexión a la base de datos
            mysqli_close($conexion);
        } else {
            echo "La variable de sesión 'alumno' no está configurada.";
        }
        ?>
            </td>
        </tr>
    </table>

</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
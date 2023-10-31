<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/consulta_horarios.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">  
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
    <header>
        <nav>
            <ul class="menu"> 
                <li><a href="../index_alumno.php">Inicio</a></li>                               
                <li><a href="consultar_horario_alumnos.php">Horario</a></li>
                <li><a href="tira_materias_alumno.php">Tira Materias</a></li>                                                                                    
                <li><a href="../php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>

    <h1>Kardex</h1>

    <!-- Formulario para ingresar el ID del alumno -->
    <form action="" method="POST" style="margin-bottom: 20px;">
        <label for="id_alumno">ID del Alumno:</label>
        <input type="text" id="id_alumno" name="id_alumno" required>
        <input type="submit" value="Buscar">
    </form>

    <!-- Tabla grande -->
    <table class="tabla-grande">
        <tr>
            <th>Materia</th>
            <th>Calificación</th>
            <th>Periodo</th>
            <th>Situación</th>
        </tr>
        <?php
            if (isset($_POST['id_alumno'])) {
                $id_alumno = $_POST['id_alumno'];

                // Conexión a la base de datos
                include '../php/conexion.php';
                mysqli_select_db($conexion, "sagadb");

                // Consulta para obtener los datos de la tabla calificaciones
                $consulta_calificaciones = "SELECT materia, calificacion, periodo, situacion FROM calificaciones WHERE id_alumno = '$id_alumno'";
                $resultado_calificaciones = mysqli_query($conexion, $consulta_calificaciones);

                // Recorre los resultados y muestra los datos en la tabla grande
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

                // Cierra la conexión a la base de datos
                mysqli_close($conexion);
            }
        ?>
    </table>

    <!-- Tabla pequeña -->
    <table class="tabla-pequena">
        <tr>
            <th>Año Cursado</th>
            <td>
                <?php
                    if (isset($_POST['id_alumno'])) {
                        // Conexión a la base de datos
                        include '../php/conexion.php';
                        mysqli_select_db($conexion, "sagadb");

                        // Consulta para obtener los grados cursados por el alumno
                        $consulta_grados = "SELECT DISTINCT grado FROM calificaciones WHERE id_alumno = '$id_alumno'";
                        $resultado_grados = mysqli_query($conexion, $consulta_grados);

                        // Recorre los resultados y muestra los grados en la tabla pequeña
                        $grados_cursados = array();
                        while ($fila_grado = mysqli_fetch_assoc($resultado_grados)) {
                            $grado = $fila_grado['grado'];
                            $grados_cursados[] = $grado;
                        }

                        // Muestra los grados cursados
                        echo implode(", ", $grados_cursados);

                        // Cierra la conexión a la base de datos
                        mysqli_close($conexion);
                    }
                ?>
            </td>
        </tr>
        <tr>
            <th>Promedio</th>
            <td>
                <?php
                    if (isset($_POST['id_alumno'])) {
                        // Conexión a la base de datos
                        include '../php/conexion.php';
                        mysqli_select_db($conexion, "sagadb");

                        // Consulta para calcular el promedio de todas las materias
                        $consulta_promedio = "SELECT AVG(calificacion) AS promedio FROM calificaciones WHERE id_alumno = '$id_alumno'";
                        $resultado_promedio = mysqli_query($conexion, $consulta_promedio);
                        $fila_promedio = mysqli_fetch_assoc($resultado_promedio);
                        $promedio = $fila_promedio['promedio'];

                        // Muestra el promedio
                        echo round($promedio, 2);

                        // Cierra la conexión a la base de datos
                        mysqli_close($conexion);
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
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../css/diseño_movil.css">
    <title>Consultar Materias</title>
</head>
<body>
    <?php include '../php/nav_A.php'; ?>
    <body>
        <?php
        // Iniciar la sesión
        session_start();
        include '../php/variabledS.php';

        // Verificar si la variable de sesión 'alumno' está configurada
        if (isset($_SESSION['alumno'])) {
            // Obtener la matrícula del alumno de la variable de sesión
            $matricula = $_SESSION['alumno'];
            $id = $matricula;

            // Conexión a la base de datos
            include '../php/conexion.php';
            mysqli_select_db($conexion, "sagadb");

            // Consulta para obtener el grado, grupo y turno del alumno
            $consultaAlumno = "SELECT grado, grupo, turno FROM alumnos WHERE id_alumno = '$matricula'";
            $resultadoAlumno = mysqli_query($conexion, $consultaAlumno);

            // Verificar si se encontraron resultados
            if (mysqli_num_rows($resultadoAlumno) > 0) {
                $filaAlumno = mysqli_fetch_assoc($resultadoAlumno);
                $grado = $filaAlumno['grado'];
                $grupo = $filaAlumno['grupo'];
                $grado_grupo = $grado . '' . $grupo;
                $turno = $filaAlumno['turno'];

                // Consulta para obtener las materias del alumno según el grado, grupo y turno
                $consultaMaterias = "SELECT * FROM horarios WHERE grado_grupo = '$grado_grupo' AND turno = '$turno'";
                $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

                if (mysqli_num_rows($resultadoMaterias) > 0) {
                    echo "<h2>Materias del Alumno</h2>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Materia</th>";
                    echo "<th>Turno</th>";
                    echo "<th>Docente</th>";
                    echo "</tr>";

                    // Iniciar una lista vacía para llevar un registro de las materias
                    $materias_registradas = array();

                    while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {
                        $materia = $filaMateria['Materias'];

                        // Verificar si la materia ya se ha registrado en la tabla
                        if (!in_array($materia, $materias_registradas)) {
                            // Agregar la materia a la lista de materias registradas
                            $materias_registradas[] = $materia;

                            echo "<tr>";
                            echo "<td>" . $materia . "</td>";
                            echo "<td>" . $filaMateria['turno'] . "</td>";
                            echo "<td>" . $filaMateria['Docentes'] . "</td>";
                            echo "</tr>";
                        }
                    }

                    echo "</table>";
                    echo '<br><a target="_blank" href="../php/imprimir_materias_alumno.php?id_alumno='.$id.'"><button class="btnguardar">Imprimir Materias</button></a><br><br>';
                } else {
                    echo "No se encontraron calificaciones ni materias para el alumno con matrícula $matricula.";
                }
            } else {
                echo "No se encontraron datos del alumno con matrícula $matricula.";
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
        } else {
            echo "La variable de sesión 'alumno' no está configurada.";
        }
        ?>
        <style>
            table {
                width: 80%;
                border-collapse: collapse;
                margin: 20px auto;
                background-color: #f8f8f8;
                border: 1px solid #ddd;
                font-family: Arial, sans-serif;
            }

            /* Estilo para las celdas del encabezado */
            table th {
                background-color: #333;
                color: #fff;
                padding: 10px;
            }

            /* Estilo para las celdas de datos */
            table td {
                padding: 8px;
                border: 1px solid #ddd;
            }

            /* Estilo para las filas impares */
            table tr:nth-child(odd) {
                background-color: #f2f2f2;
            }

            /* Estilo para las filas cuando se pasa el mouse por encima */
            table tr:hover {
                background-color: #ddd;
            }
        </style>
    </body>
    <footer>
    <?php include '../php/footerG.php';?>
    </footer>
</body>
</html>
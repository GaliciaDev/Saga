<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/estilo_index_G.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../css/diseño_movil.css">
    <title>Consultar Materias</title>
</head>
<body>
    <?php include '../php/nav_A.php'; ?>
    <body>
        <?php        
        include '../php/variabledS.php';

        // Verificar si la variable de sesión 'alumno' está configurada
        if (isset($_SESSION['alumno'])) {
            // Obtener la matrícula del alumno de la variable de sesión
            $matricula = $_SESSION['alumno'];
            $id = $matricula;

            // Conexión a la base de datos
            include '../php/conexion.php';            

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
                    echo "<br><h2>Materias del Alumno</h2><br><br>";
                    echo '<table class="tabla_informacion">';
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
            .tabla_informacion {
            border-collapse: collapse;
            width: 100%;
            text-align: center;    
        }

        .tabla_informacion th, .tabla_informacion td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;    
        }

        td {
            text-align: center;
        }

        .tabla_informacion th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .tabla_informacion tr:hover {
            background-color: #f5f5f5;
        }
        
        .btnguardar {
            width: 16%;
            padding: 10px;
            color: white;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #944d1e;
        }
        .btnguardar:hover {
            background-color: #522303;
        }
    </style>
    </body>
    <footer>
    <?php include '../php/footerG.php';?>
    </footer>
</body>
</html>
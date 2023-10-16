<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Index del Alumno</title>
</head>
<body>
    <header>
        <nav>
            <ul class="menu">     
                <li><a href="../index_alumno.php">Inicio</a></li>                                           
                <li><a href="consultar_horario_alumnos.php">Horario</a></li>            
                <li><a href="calificaciones_alumno.php">Calificaciones</a></li>                
                <li><a href="kardex.php">Kardex</a></li>                                
                <li><a href="../php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <body>
        <h1>Consultar Calificaciones y Materias</h1>
        <form method="POST" action="">
            <label>Ingrese el ID del Alumno:</label>
            <input type="text" name="id_alumno">
            <input type="submit" value="Consultar">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener el ID del Alumno
            $id_alumno = $_POST["id_alumno"];

            // Conexión a la base de datos
            $conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
            mysqli_select_db($conexion, "sagadb");

            // Consulta para obtener las materias del alumno
            $consultaMaterias = "SELECT m.Nom_Materia, tm.Materias, tm.Horas_Clases, tm.docente 
                                 FROM materias AS m
                                 INNER JOIN tira_materias AS tm ON m.Nom_Materia = tm.Materias
                                 WHERE m.id_alumno = '$id_alumno'";

            $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

            // Verificar si se encontraron resultados
            if (mysqli_num_rows($resultadoMaterias) > 0) {
                echo "<h2>Calificaciones y Materias del Alumno</h2>";
                echo "<table>";
                echo "<tr>";
                echo "<th>Materia</th>";
                echo "<th>Horas de Clases</th>";
                echo "<th>Docente</th>";
                echo "</tr>";

                while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {
                    echo "<tr>";
                    echo "<td>" . $filaMateria['Nom_Materia'] . "</td>";
                    echo "<td>" . $filaMateria['Horas_Clases'] . "</td>";
                    echo "<td>" . $filaMateria['docente'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No se encontraron calificaciones ni materias para el alumno con ID $id_alumno.";
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
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
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>
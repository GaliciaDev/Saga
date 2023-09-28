<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="shortcut icon" href="img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Modificar Calificacion</title>
    </head>
<body>
    <header>
        <nav>
            <ul class="menu">                                                
                <li><a href="consulta_horarios_D.php">Horario</a></li>                
                <li><a href="capturas_calificaciones_D.php">Captura Calificaciones</a></li>
                <li><a href="contactos_tutores_D.php">Contacto Tutores</a></li>
                <li><a href="estadisticas_alumno_D.php">Estadisticas Alumnos</a></li>
                <li><a href="apoyo_D.html">Apoyo Tecnico</a></li>
                <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <body>
    <div class="container">
        <h1>Calificaciones del Alumnado</h1>
        <form method="POST" action="modificar_calificacion_D    .php">
            <label for="materia">Seleccione una materia:</label>
            <select name="materia">
                <!-- Aquí obtienes las materias disponibles desde tu base de datos y las agregas como opciones -->
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sagadb";

                // Crear conexión
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Comprobar la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta para obtener las materias disponibles
                $sql = "SELECT DISTINCT Nom_Materia FROM materias";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Nom_Materia'] . "'>" . $row['Nom_Materia'] . "</option>";
                    }
                }
                ?>
            </select>
            <input type="submit" value="Consultar">
        </form>
        
        <?php
        // Verificar si se envió el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $materia = $_POST["materia"];
            // Realizar una consulta para obtener los datos de los alumnos con la materia seleccionada
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sagadb";

            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Comprobar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta de calificaciones por materia
            $sql = "SELECT alumnos.id_alumno, alumnos.nombre, alumnos.apellidoP, alumnos.apellidoM, materias.* FROM alumnos JOIN materias ON alumnos.id_alumno = materias.id_alumno WHERE materias.Nom_Materia = '$materia'";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Nombre del Alumno</th><th>Calificación 1</th><th>Calificación 2</th><th>Calificación 3</th><th>Faltas 1</th><th>Faltas 2</th><th>Faltas 3</th><th>Acciones</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nombre"] . " " . $row["apellidoP"] . " " . $row["apellidoM"] . "</td>";
                    echo "<td>" . $row["Calificacion_1"] . "</td>";
                    echo "<td>" . $row["Calificacion_2"] . "</td>";
                    echo "<td>" . $row["Calificacion_3"] . "</td>";
                    echo "<td>" . $row["Faltas_1"] . "</td>";
                    echo "<td>" . $row["Faltas_2"] . "</td>";
                    echo "<td>" . $row["Faltas_3"] . "</td>";
                    echo "<td><a href='calificaciones_alumnado.php?id=" . $row["id_alumno"] . "'>Editar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron registros.";
            }

            // Cerrar conexión
            $conn->close();
        }
        ?>
    </div>
    </body>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>  
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="shortcut icon" href="img/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Calificaciones del Alumnado</title>
</head>
<body>
    <header>
        <nav>
            <!-- Tu menú de navegación aquí -->
        </nav>
    </header>
    
    <div class="container">
        <h1>Editar Calificaciones</h1>
        
        <?php
        // Verificar si se proporcionó un ID de alumno válido
        if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
            $id_alumno = $_GET["id"];

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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Recuperar las calificaciones y faltas enviadas por el formulario
                $calificacion1 = $_POST["calificacion1"];
                $calificacion2 = $_POST["calificacion2"];
                $calificacion3 = $_POST["calificacion3"];
                $faltas1 = $_POST["faltas1"];
                $faltas2 = $_POST["faltas2"];
                $faltas3 = $_POST["faltas3"];

                // Consulta para actualizar las calificaciones en la base de datos
                $sql = "UPDATE materias SET Calificacion_1 = $calificacion1, Calificacion_2 = $calificacion2, Calificacion_3 = $calificacion3, Faltas_1 = $faltas1, Faltas_2 = $faltas2, Faltas_3 = $faltas3 WHERE id_alumno = $id_alumno";

                if ($conn->query($sql) === TRUE) {
                    echo "Calificaciones actualizadas con éxito.";
                    echo '<meta http-equiv="refresh" content="1;url=modificar_calificacion_D.php">';
                } else {
                    echo "Error al actualizar calificaciones: " . $conn->error;
                }
            }

            // Consulta para obtener los datos del alumno
            $sql = "SELECT nombre, apellidoP, apellidoM FROM alumnos WHERE id_alumno = $id_alumno";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nombre = $row["nombre"];
                $apellidoP = $row["apellidoP"];
                $apellidoM = $row["apellidoM"];

                // Consulta para obtener las calificaciones del alumno
                $sql = "SELECT * FROM materias WHERE id_alumno = $id_alumno";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $calificacion1 = $row["Calificacion_1"];
                    $calificacion2 = $row["Calificacion_2"];
                    $calificacion3 = $row["Calificacion_3"];
                    $faltas1 = $row["Faltas_1"];
                    $faltas2 = $row["Faltas_2"];
                    $faltas3 = $row["Faltas_3"];

                    // Formulario para editar las calificaciones
                    echo "<form method='POST' action='calificaciones_alumnado.php?id=$id_alumno'>";
                    echo "<input type='hidden' name='id_alumno' value='$id_alumno'>";
                    echo "<p><strong>Nombre del Alumno:</strong> $nombre $apellidoP $apellidoM</p>";
                    echo "<p><strong>Calificación 1:</strong> <input type='text' name='calificacion1' value='$calificacion1'></p>";
                    echo "<p><strong>Calificación 2:</strong> <input type='text' name='calificacion2' value='$calificacion2'></p>";
                    echo "<p><strong>Calificación 3:</strong> <input type='text' name='calificacion3' value='$calificacion3'></p>";
                    echo "<p><strong>Faltas 1:</strong> <input type='text' name='faltas1' value='$faltas1'></p>";
                    echo "<p><strong>Faltas 2:</strong> <input type='text' name='faltas2' value='$faltas2'></p>";
                    echo "<p><strong>Faltas 3:</strong> <input type='text' name='faltas3' value='$faltas3'></p>";
                    echo "<p><input type='submit' value='Guardar'></p>";
                    echo "</form>";
                } else {
                    echo "No se encontraron calificaciones para este alumno.";
                }
            } else {
                echo "No se encontró el alumno.";
            }

            // Cerrar conexión
            $conn->close();
        } else {
            echo "ID de alumno no válido.";
        }
        ?>
    </div>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</body>
</html>x
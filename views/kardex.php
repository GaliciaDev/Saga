<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/consulta_horarios.css">
    <link rel="shortcut icon" href="img/icon.png">  
    <title>Kardex</title>
</head>
<body>
<header>
    <nav>
        <ul class="menu">
            <li><a href="index_alumnos.php">Inicio</a></li>                                  
            <li><a href="calificaciones_alumno.php">Calificaciones</a></li>                                
            <li><a href="kardex.php">Kardex</a></li>                                          
            <li><a href="apoyo.html">Apoyo Tecnico</a></li>
            <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
        </ul>
    </nav>
</header>
<h1>Kardex del Alumno</h1>
<!-- Formulario para ingresar el ID del alumno -->
<form method="POST">
    <label for="id">Ingrese el ID del alumno:</label>
    <input type="text" name="id_alumno" id="id_alumno">
    <input type="submit" value="Buscar">
</form>

<table class="kardex">
    <?php
    // Verificar si se ha enviado el formulario
    if ($_POST) {
        // Obtener el ID del alumno desde el formulario
        $id_alumno = $_POST['id_alumno'];

        // Conexión a la BD
        $conexion = mysqli_connect("localhost", "root", "");
        mysqli_select_db($conexion, "sagadb");

        // Consulta para obtener el kardex del alumno
        $consulta_kardex = "SELECT m.Nom_Materia, m.Calificacion_1, m.Calificacion_2, m.Calificacion_3, m.Faltas_1, m.Faltas_2, m.Faltas_3, m.Promedio_Mat 
                            FROM materias AS m
                            INNER JOIN alumnos AS a ON m.id_alumno = a.id_alumno
                            WHERE m.id_alumno = '$id_alumno'";

        $resultado_kardex = mysqli_query($conexion, $consulta_kardex);

        // Imprimir la tabla del kardex
        echo '
        <tr>
            <th>Materia</th>
            <th>Calificación 1</th>
            <th>Calificación 2</th>
            <th>Calificación 3</th>
            <th>Faltas 1</th>
            <th>Faltas 2</th>
            <th>Faltas 3</th>
            <th>Promedio Materia</th>
        </tr>';

        while ($fila_kardex = mysqli_fetch_assoc($resultado_kardex)) {
            echo '
            <tr>
                <td>' . $fila_kardex['Nom_Materia'] . '</td>
                <td>' . $fila_kardex['Calificacion_1'] . '</td>
                <td>' . $fila_kardex['Calificacion_2'] . '</td>
                <td>' . $fila_kardex['Calificacion_3'] . '</td>
                <td>' . $fila_kardex['Faltas_1'] . '</td>
                <td>' . $fila_kardex['Faltas_2'] . '</td>
                <td>' . $fila_kardex['Faltas_3'] . '</td>
                <td>' . $fila_kardex['Promedio_Mat'] . '</td>
            </tr>';
        }

        // Cerrar la conexión a la BD
        mysqli_close($conexion);
    }
    ?>
</table>
</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
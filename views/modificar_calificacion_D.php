<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
mysqli_select_db($conexion, "sagadb");

// Consulta para obtener las materias desde la tabla "tira_materias"
$consultaMaterias = "SELECT Materias FROM tira_materias";
$resultadoMaterias = mysqli_query($conexion, $consultaMaterias);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilo_modificar_calificacion.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <title>Editar Calificaciones</title>
</head>
<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="../index_docente.php">Inicio</a></li>
                <li><a href="capturas_calificaciones_D.php">Captura Calificaciones</a></li>
                <li><a href="contactos_tutores_D.php">Contacto Tutores</a></li>
                <li><a href="estadisticas_alumno_D.php">Estadisticas Alumnos</a></li>
                <li><a href="apoyo_D.html">Apoyo Tecnico</a></li>
                <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <h1>Editar Calificaciones</h1>
    <br><br>
    <label>Seleccione una Materia:</label>
    <form method="POST" action="">
        <select class="materias" name="materia">
            <?php
            while ($filaMaterias = mysqli_fetch_assoc($resultadoMaterias)) {
                $materia = $filaMaterias['Materias'];
                echo "<option value='$materia'>$materia</option>";
            }
            ?>
        </select>
        <input type="submit" value="Seleccionar">
    </form><br>
    <?php
    if (isset($_POST['materia'])) {
        $selectedMateria = $_POST['materia'];

        // Consulta para obtener los datos de la materia seleccionada
        $consultaMateriaSeleccionada = "SELECT * FROM materias WHERE Nom_Materia = '$selectedMateria'";
        $resultadoMateriaSeleccionada = mysqli_query($conexion, $consultaMateriaSeleccionada);

        echo "<table class='tabla_calificaciones'>";
        echo "<tr>";
        echo "<th>Materia</th>";
        echo "<th>Calificación 1</th>";
        echo "<th>Calificación 2</th>";
        echo "<th>Calificación 3</th>";
        echo "<th>Faltas 1</th>";
        echo "<th>Faltas 2</th>";
        echo "<th>Faltas 3</th>";
        echo "<th>Acciones</th>";
        echo "</tr>";

        // Recorremos los datos de la materia seleccionada
        while ($filaMateria = mysqli_fetch_assoc($resultadoMateriaSeleccionada)) {
            echo "<form method='POST' action='../php/actualizar_calificaciones.php'>";
                echo "<tr>";
                echo "<td>" . $filaMateria['Nom_Materia'] . "</td>";
                echo "<td class='center-input'><input type='text' name='calif1' value='" . $filaMateria['Calificacion_1'] . "'></td>";
                echo "<td class='center-input'><input type='text' name='calif2' value='" . $filaMateria['Calificacion_2'] . "'></td>";
                echo "<td class='center-input'><input type='text' name='calif3' value='" . $filaMateria['Calificacion_3'] . "'></td>";
                echo "<td class='center-input'><input type='text' name='faltas1' value='" . $filaMateria['Faltas_1'] . "'></td>";
                echo "<td class='center-input'><input type='text' name='faltas2' value='" . $filaMateria['Faltas_2'] . "'></td>";
                echo "<td class='center-input'><input type='text' name='faltas3' value='" . $filaMateria['Faltas_3'] . "'></td>";
                echo "<input type='hidden' name='id_materia' value='" . $filaMateria['id_materia'] . "'>";
                echo "<td><button class='editarBtn' type='submit' class='editarBtn'>Editar Calificación</button></td>";
                echo "<input type='hidden' name='id_materia' value='" . $filaMateria['id_materia'] . "'>";
                echo "</tr>";
            echo "</form>";
        }

        echo "</table>";
    }
    ?>
    </body>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>
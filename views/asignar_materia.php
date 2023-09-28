<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/asignar_materias.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Asignar Materias</title>
</head>
<body>
<header>
    <nav>
        <ul class="menu">
            <li class="dropdown">
                <li><a href="../index_administrativo.php">Inicio</a></li>
                <button class="dropbtn">Horarios</button>
                <div class="dropdown-content">
                    <a href="asignar_horarios_alumnos.php">Asignar Horarios</a>
                    <a href="consultar_horarios.php">Consulta Horarios</a>
                </div>
            </li>
            <li><a href="modificar_materias.php">Modificar Materias</a></li>
            <li class="dropdown">
                <button class="dropbtn">Captura Calificaciones</button>
                <div class="dropdown-content">
                    <a href="modificar_calificacion.php">Modificar Calificacion</a>
                    <a href="capturar_calif_definitiva.php">Calificacion Trimestral</a>
                </div>
            </li>
            <li class="dropdown">
                <button class="dropbtn">Estadisticas Alumnos</button>
                <div class="dropdown-content">
                    <a href="estadisticas_alumno.php">Alumno</a>
                    <a href="estadistica_grupal.php">Grupal</a>
                </div>
            </li>
            <li class="dropdown">
                <button class="dropbtn">Registro</button>
                <div class="dropdown-content">
                    <a href="registro_alumnos.html">Registro Alumnos</a>
                    <a href="registro_docentes.html">Registro Docentes</a>
                    <a href="registro_administrativo.html">Registro Administrativo</a>
                </div>
            </li>
            <li><a href="contactos_tutores.php">Contacto Tutores</a></li>
            <li><a href="apoyo.html">Apoyo Tecnico</a></li>
            <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
        </ul>
    </nav>
</header>
<body>
<br>
<form method="post" action="asignar_materia.php">
    <label for="materia">Materia:</label>
    <input type="text" name="materia" id="materia">
    <label for="horas_clases">Horas de Clases Semanales:</label>
    <select name="horas_clases" id="horas_clases">
        <option value="5 Hrs">5 Hrs.</option>
        <option value="4 Hrs">4 Hrs.</option>
        <option value="3 Hrs">3 Hrs.</option>
        <!-- Agrega más opciones si es necesario -->
    </select>
    <label for="docente">Docente:</label>
    <select class="nombre" name="docente" id="docente">
        <?php
        // Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
        mysqli_select_db($conexion, "sagadb");

        // Consulta para obtener los nombres completos de los docentes
        $consulta_docentes = "SELECT CONCAT(nombreD, ' ', apellidoPd, ' ', apellidoMd) AS nombre_completo FROM docentes";
        $resultado_docentes = mysqli_query($conexion, $consulta_docentes);

        // Generar las opciones
        while ($fila_docente = mysqli_fetch_assoc($resultado_docentes)) {
            $nombre_completo = $fila_docente['nombre_completo'];
            echo '<option class="nombre" value="' . $nombre_completo . '">' . $nombre_completo . '</option>';
        }

        // Cerrar la conexión a la BD
        mysqli_close($conexion);
        ?>
    </select><br>
    <input type="submit" value="Guardar"><br><br>
</form>

<!-- Agregamos el div para mostrar el mensaje -->
<div id="mensaje" style="display: none;">Datos guardados</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $materia = $_POST["materia"];
    $horas_clases = $_POST["horas_clases"];
    $docente = $_POST["docente"];

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
    if (!$conexion) {
        die("La conexión a la base de datos falló: " . mysqli_connect_error());
    }

    // Seleccionar la base de datos
    mysqli_select_db($conexion, "sagadb");

    // Verificar si la materia ya existe en la base de datos
    $consulta_existe_materia = "SELECT COUNT(*) AS existe FROM tira_materias WHERE Materias = ?";
    $stmt_existe_materia = mysqli_prepare($conexion, $consulta_existe_materia);
    mysqli_stmt_bind_param($stmt_existe_materia, "s", $materia);
    mysqli_stmt_execute($stmt_existe_materia);
    $resultado_existe_materia = mysqli_stmt_get_result($stmt_existe_materia);
    $fila_existe_materia = mysqli_fetch_assoc($resultado_existe_materia);

    if ($fila_existe_materia["existe"] > 0) {
        $mensaje = "Elemento duplicado.";
    } else {
        // Preparar la consulta SQL para la inserción
        $consulta = "INSERT INTO `tira_materias`(`grado_grupo`, `Materias`, `Horas_Clases`, `docente`) VALUES (NULL, ?, ?, ?)";
        $stmt = mysqli_prepare($conexion, $consulta);

        // Vincular los parámetros a la consulta
        mysqli_stmt_bind_param($stmt, "sss", $materia, $horas_clases, $docente);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Aquí asignamos el mensaje a una variable JavaScript
            echo '<script>
                    var mensajeDiv = document.getElementById("mensaje");
                    mensajeDiv.style.display = "block";
                    mensajeDiv.innerHTML = "Datos guardados correctamente.";
                    setTimeout(function () {
                        mensajeDiv.style.display = "none";
                    }, 2000); // 2 segundos
                  </script>';
        } else {
            $mensaje = "Error al guardar los datos: " . mysqli_error($conexion);
        }

        // Cerrar la conexión y liberar recursos
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conexion);
}
?>

</body>
<br>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
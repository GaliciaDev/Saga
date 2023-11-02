<?php    
    include '../php/variabledS.php';
    validarSd();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/horario.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <title>Horarios</title>
</head>
<body>
    <header>
        <nav>
            <ul class="menu">
                <li><a href="../index_docente.php">Inicio</a></li>                
                <li class="dropdown">
                    <button class="dropbtn">Captura Calificaciones</button>
                    <div class="dropdown-content">
                        <a href="capturas_calificaciones_D.php">Captura Calificaciones</a>
                        <a href="modificar_calificacion_D.php">Modificar Calificacion</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropbtn">Estadisticas Alumnos</button>
                    <div class="dropdown-content">
                        <a href="estadisticas_alumno_D.php">Alumno</a>
                        <a href="estadisticas_grupal_D.php">Grupal</a>
                    </div>
                </li>
                <li><a href="contactos_tutores_D.php">Contacto Tutores</a></li>
                <li><a href="../php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <h1>Horario</h1>
    <br><br>
    <table class="tabla_horarios">
        <?php        
        if (isset($_SESSION['docente'])) {
            $id_usuario = $_SESSION['docente'];

            include '../php/conexion.php';

            // Consulta para obtener el nombre del profesor a partir del ID de usuario
            $consulta_nombre = "SELECT nombreD, apellidoPd, apellidoMd FROM `docentes` WHERE `id_docente` = '$id_usuario';";
            $resultado_nombre = mysqli_query($conexion, $consulta_nombre);

            if ($row = mysqli_fetch_assoc($resultado_nombre)) {
                $nombre_profesor = $row['nombreD'] . ' ' . $row['apellidoPd'] . ' ' . $row['apellidoMd'];

                // Consulta para obtener los horarios del profesor
                $consulta_horarios = "SELECT Dias, grado_grupo, Hora, Aula, Docentes, Materias FROM `horarios` WHERE `Docentes` = '$nombre_profesor';";
                $resultado_horarios = mysqli_query($conexion, $consulta_horarios);

                // Imprimir tabla de horarios
                echo '          
                <tr>
                    <th>Día</th>                        
                    <th>Grupo</th>
                    <th>Horario</th>
                    <th>Materia</th>
                    <th>Salón</th>
                    <th>Profesor</th>                                                                                                                  
                </tr>
                ';

                // Iterar a través de los resultados de la consulta de horarios
                while ($campo = mysqli_fetch_array($resultado_horarios)) {
                    echo '
                    <tr>
                        <td>' . ($campo['Dias']) . '</td>
                        <td>' . ($campo['grado_grupo']) . '</td>
                        <td>' . ($campo['Hora']) . '</td>
                        <td>' . ($campo['Materias']) . '</td>
                        <td>' . ($campo['Aula']) . '</td>
                        <td>' . ($campo['Docentes']) . '</td>  
                    </tr>';
                }
            } else {
                echo 'No se encontró un profesor con el ID de usuario proporcionado.';
            }
            
            mysqli_close($conexion);
        } else {
            echo 'No se ha iniciado sesión. Por favor, inicie sesión para ver los horarios.';
        }
        ?>
    </table>
    <br><a target="_blank" href="../php/imprimir_horario_D.php?nombre_profesor=<?php echo urlencode($nombre_profesor); ?>">
    <button class="btnguardar">Imprimir PDF</button>
    </a><br><br>
    <style>
        /* Estilo para el botón */
        .btnguardar {
            background-color: #000; /* Color de fondo negro para el botón */
            color: #fff; /* Color del texto del botón (blanco) */
            padding: 10px 20px; /* Espaciado interno del botón (ajusta según tus necesidades) */
            border: none; /* Quita el borde del botón */
            border-radius: 5px; /* Añade esquinas redondeadas al botón */
            cursor: pointer; /* Cambia el cursor al pasar el ratón por encima */
            transition: background-color 0.3s ease; /* Agrega una transición suave al color de fondo */
        }

        /* Estilo para el botón cuando se pasa el ratón por encima */
        .btnguardar:hover {
            background-color: #333; /* Cambia el color de fondo a gris oscuro al pasar el ratón por encima */
        }
    </style>
</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
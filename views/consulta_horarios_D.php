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
                <li><a href="capturas_calificaciones_D.php">Captura Calificaciones</a></li>
                <li><a href="contactos_tutores_D.php">Contacto Tutores</a></li>
                <li><a href="estadisticas_alumno_D.php">Estadisticas Alumnos</a></li>
                <li><a href="apoyo_D.html">Apoyo Tecnico</a></li>
                <li><a href="../php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <h1>Horario</h1>
    <br><br>
    <label>Nombre del Profesor: </label>
    <form method="POST" action="consulta_horarios_D.php">
        <input type="text" name="nombre_profesor" placeholder="Ingresa el Nombre del Profesor">
        <input type="submit" value="Buscar">
    </form><br>
    <table class="tabla_horarios">
        <?php
        // Recibir el nombre del profesor del formulario
        if ($_POST) {
            $nombre_profesor = $_POST['nombre_profesor'];

            // Conexion a la BD
            $conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
            mysqli_select_db($conexion, "sagadb");

            // Realizamos consulta para obtener los horarios del profesor
            $consulta = "SELECT Dias, grado_grupo, Hora, Aula, Docentes, Materias FROM `horarios` WHERE `Docentes` = '$nombre_profesor';";
            $resultado = mysqli_query($conexion, $consulta);

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
            
            // Iterar a través de los resultados de la consulta
            while ($campo = mysqli_fetch_array($resultado)) {
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
            
            mysqli_close($conexion);                          
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
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo_tira_materias.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Tira Materias</title>
    </head>
<body>
    <header>
        <nav>
            <ul class="menu">                                                
                <li><a href="../index_administrativo.php">Inicio</a></li>
                <li><a href="asignacion_horarios.php">Asignar Horario</a></li>
                <li><a href="capturas_calificaciones.php">Captura Calificaciones</a></li>
                <li><a href="contactos_tutores.php">Contacto Tutores</a></li>                
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
                <li><a href="apoyo.html">Apoyo Tecnico</a></li>
                <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>
    <h1>Asignación de Materias</h1>
    
    <table>
        <form method="POST" action="tira_materias.php">
            <tr>
                <th>Grado y Grupo</th>
                    <td><input type="text" id="gradogrupo" name="grado_grupo" placeholder="Ingrese Grado y GRupo" requierd></td>
            </tr>
            <tr>
                <th>Materias</th>
                <td><?php
                    for ($i = 1; $i <= 8; $i++) {
                        echo '<input type="text" id="materia' . $i . '" name="materia' . $i . '" required><br>';
                    }
                ?></td>                
            </tr>
            <tr>
                <th>Hora Clase</th>
                <td><?php
                    for ($i = 1; $i <= 8; $i++) {
                        echo '<selet id="hora" name="hora" required>
                            <option value="13:00">1:00pm</option>
                            <option value="13:50">1:50pm</option>
                            <option value="14:40">2:40pm</option>
                            <option value="15:30">3:30pm</option>
                            <option value="16:20">4:20pm</option>
                            <option value="17:10">5:10pm</option>
                            <option value="18:00">6:00pm</option>
                        </selet>';
                    }
                ?></td>
            </tr>
            <tr>
                <th>Docente</th>
                <td><select class="doct" name="nombre_completo_docentes">
                    <option value="">Ingrese un Docente</option>
                    <?php
                    
                    // Conexion a la BD
                    include '../php/conexion.php';
                    mysqli_select_db($conexion, "sagadb");

                    $resultadoDocentes = mysqli_query("SELECT `nombreD`, `apellidoPd`, `apellidoMd` FROM `docentes`");

                    for ($i = 1; $i <= 8; $i++) {
                        while ($campo = mysqli_fetch_array($resultadoDocentes)) {
                            echo '<option value="' . (implode(" ", [$campo['nombreD'], $campo['apellidoPd'], $campo['apellidoMd']])) . '">'
                                . (implode(" ", [$campo['nombreD'], $campo['apellidoPd'], $campo['apellidoMd']])) . '</option>';
                        }
                    }
                    ?>
                </select></td>
            </tr>
    </table>

</body><br>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>';
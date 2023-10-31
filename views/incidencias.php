    <?php
    include '../php/variabledS.php';
    validarSad();
    
    // Conexión a la base de datos
    include '../php/conexion_be.php';
    
    // Variable para almacenar el mensaje
    $mensaje = "";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Procesar el formulario de incidencias
        $alumno = $_POST['alumno'];
        $tipo = $_POST['tipo'];
        $descripcion = $_POST['descripcion'];
        $fecha = date("Y-m-d");
        $resuelta = "No";
        $mensaje = "";
    
        // Consulta para insertar la incidencia en la base de datos
        $consultaIncidencia = "INSERT INTO incidenciasalumnos (id_alumno, fecha, tipo_incidencia, descripcion, resuelta, responsable) VALUES (null, '$fecha', '$tipo', '$descripcion', '$resuelta', '$alumno')";
    
        if (mysqli_query($conexion, $consultaIncidencia)) {
            $mensaje = "Incidencia registrada exitosamente.";
        } else {
            $mensaje = "Error al registrar la incidencia: " . mysqli_error($conexion);
        }
    }
    echo $mensaje;
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="../css/estilo_incidencias.css">
            <link rel="shortcut icon" href="../assets/img/icon.png">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>Registro Incidencias</title>

            <script>
                function mostrarMensaje() {
                    console.log("Mensaje emergente: <?php echo $mensaje; ?>"); // Agrega esta línea
                    var mensaje = "<?php echo $mensaje; ?>";
                    if (mensaje) {
                        alert(mensaje);
                        location.reload();
                    }
                }
            </script>
        </head> 
    <body>
        <header>
            <nav>
                <ul class="menu">                  
                    <li><a href="../index_administrativo.php">Inicio</a></li>                                              
                    <li class="dropdown">                    
                        <button class="dropbtn">Horarios</button>
                        <div class="dropdown-content">
                            <a href="asignar_horarios_alumnos.php">Asignar Horarios</a>
                            <a href="consultar_horarios.php">Consulta Horarios</a>                      
                        </div>
                    </li>                   
                    <li class="dropdown">
                        <button class="dropbtn">Captura Calificaciones</button>
                        <div class="dropdown-content">
                        <a href="modificar_calificacion.php">Modificar Calificacion</a>
                        <a href="capturar_calif_definitiva.php">Captura Trimestral</a>                      
                        </div>
                    </li>       
                    <li class="dropdown">
                        <button class="dropbtn">Materias</button>
                        <div class="dropdown-content">
                        <a href="asignar_materia.php">Asignar Materias</a>
                        <a href="modificar_materias.php">Modificar Materias</a>                      
                        </div>
                    </li>       
                    <li class="dropdown">
                        <button class="dropbtn">Subir Grado</button>
                        <div class="dropdown-content">                    
                        <a href="subir_grado.php">Aumentar Grado</a>
                        <a href="lista_reprobados.php">Lista Reprobados</a>
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
                    <li><a href="lista_incidencias.php">Lista de Incidencias</a></li>    
                    <li><a href="contactos_tutores.php">Contacto Tutores</a></li>                    
                    <li><a href="../php/cerrar_sesion.php">Cerrar Sesion</a></li>
                </ul>            
            </nav>        
        </header>    
        <h2>Registrar Incidencia</h2>
            <form method="post" action="incidencias.php">
                <label for="alumno">Alumno:</label>
                <input type="text" id="alumno" name="alumno" required>

                <label for="tipo">Tipo de Incidencia:</label>
                <select id="tipo" name="tipo" required>
                    <option value="Comportamiento">Comportamiento</option>
                    <option value="Faltas">Faltas</option>
                    <option value="Otro">Otro</option>
                </select>

                <label for="descripcion">Descripción de la Incidencia:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>

                <input type="submit" value="Registrar Incidencia">
            </form>
    </body>
        <footer>
            <p>&copy; 2023 SAGA.</p>
            <p>Contáctanos: info@example.com</p>
        </footer>
    </html>  
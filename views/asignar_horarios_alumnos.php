<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/asignar_horario_alumno.css">
	<link rel="shortcut icon" href="img/icon.png">  
	<title>Asignar Horarios</title>
</head>
<body>
    <header>
		<nav>
            <ul class="menu">
                <li><a href="index_administrativo.php">Inicio</a></li>                                  
                <li><a href="capturas_calificaciones.php">Captura Calificaciones</a></li>
                <li><a href="contactos_tutores.php">Contacto Tutores</a></li>                
                <li><a href="estadisticas_alumno.php">Estadisticas Alumnos</a></li>            
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
    <head>
        <br><form class="formulario" method="POST" action="asignar_horarios_alumnos.php">
            <h1>Asignacion de Horarios</h1>
            <label>Ingrese Un Grupo a Asignar Horario</label>
                
                <input type="text" class="busca" id="grupo" name="asignar_grupo" placeholder="--" required>                
                       
    </head>
     
    <table class="tabla">        
        <tr>
            <th>Día</th>            
            <th>Horario</th>
            <th>Materia</th>
            <th>Salón</th>
            <th>Profesor</th>
        </tr>        
        <tr>
            <td rowspan="9"><select id="dia" name="dia">
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miercoles">Miercoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
            </select></td>            
            <td>7:00 - 7:45</td>
            <td><input type="text" id="materias" name="materia[]" placeholder="Ingrese la Materia" required></td>
            <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
            <td><input type="text" class="nombre_doc" id="docente" name="nombre_docente[]" placeholder="Ingrese el Nombre del Docente" required></td>            
            <tr>                
                <td>7:45 - 8:30</td>
                <td><input type="text" id="materias" name="materia[]" placeholder="Ingrese la Materia" required></td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td><input type="text" class="nombre_doc" id="docente" name="nombre_docente[]" placeholder="Ingrese el Nombre del Docente" required></td> 
            </tr>    
            <tr>                
                <td>8:30 - 9:15</td>
                <td><input type="text" id="materias" name="materia[]" placeholder="Ingrese la Materia" required></td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td><input type="text" class="nombre_doc" id="docente" name="nombre_docente[]" placeholder="Ingrese el Nombre del Docente" required></td>  
            </tr> 
            <tr>                
                <td>9:15 - 10:00</td>
                <td><input type="text" id="materias" name="materia[]" placeholder="Ingrese la Materia" required></td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td><input type="text" class="nombre_doc" id="docente" name="nombre_docente[]" placeholder="Ingrese el Nombre del Docente" required></td>
            </tr>   
            <tr>                           
                <td>10:00 - 10:30</td>
                <td colspan="3">Reseso</td>
            </tr> 
            <tr>                
                <td>10:30 - 11:15</td>
                <td><input type="text" id="materias" name="materia[]" placeholder="Ingrese la Materia" required></td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td><input type="text" class="nombre_doc" id="docente" name="nombre_docente[]" placeholder="Ingrese el Nombre del Docente" required></td>
            </tr>  
            <tr>                
                <td>11:15 - 12:00</td>
                <td><input type="text" id="materias" name="materia[]" placeholder="Ingrese la Materia" required></td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td><input type="text" class="nombre_doc" id="docente" name="nombre_docente[]" placeholder="Ingrese el Nombre del Docente" required></td>
            </tr>  
            <tr>                
                <td>12:00 - 12:45</td>
                <td><input type="text" id="materias" name="materia[]" placeholder="Ingrese la Materia" required></td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td><input type="text" class="nombre_doc" id="docente" name="nombre_docente[]" placeholder="Ingrese el Nombre del Docente" required></td> 
            </tr>  
            <tr>                
                <td>12:45 - 1:30</td>
                <td><input type="text" id="materias" name="materia[]" placeholder="Ingrese la Materia" required></td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td><input type="text" class="nombre_doc" id="docente" name="nombre_docente[]" placeholder="Ingrese el Nombre del Docente" required></td>
            </tr>  
        </tr>
        </table>              
                            
        <br><input class="btnlimpiar" name="Limpiar" type="reset" id="btnResetear" value="Limpiar"><br>        
        <input class="btnguardar" name="asignar" type="submit" id="btnEnviar" value="Establecer Horarios">     
        <?php
            $servername = "localhost"; // Cambia localhost por el servidor de tu base de datos
            $username = "root";
            $password = "";
            $dbname = "sagadb"; // Nombre de la base de datos

            // Crear una conexión a la base de datos
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }
        ?>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $grupo = $_POST["asignar_grupo"];
            $dia = $_POST["dia"];
            $materias = $_POST["materia"];
            $docentes = $_POST["nombre_docente"];
            $horas = ["7:00 - 7:45", "7:45 - 8:30", "8:30 - 9:15", "9:15 - 10:00", "10:30 - 11:15", "11:15 - 12:00", "12:00 - 12:45", "12:45 - 1:30"];
            $aulas = $_POST["aula"];

            // Iterar a través de los datos y realizar las inserciones en la base de datos
            for ($i = 0; $i < count($materias); $i++) {
                $actualizacion_realizada = false; // Variable para llevar el seguimiento de si se realizó alguna actualización
                $mensaje_no_cambios = "No Se Realizaron Cambios Existen Cruces de Materias."; // Mensaje que se mostrará si no se realizan cambios

                for ($i = 0; $i < count($materias); $i++) {
                    $hora = $horas[$i];

                    // Verificar si el docente ya tiene una asignación en ese día y hora
                    $sql_verificar = "SELECT * FROM horarios WHERE Docentes = '$docentes[$i]' AND Dias = '$dia' AND Hora = '$hora'";
                    $resultado_verificar = $conn->query($sql_verificar);

                    if ($resultado_verificar->num_rows == 0) {
                        // Realizar la inserción en la base de datos
                        $sql_insertar = "INSERT INTO horarios (grado_grupo, Dias, Materias, Docentes, Hora, Aula)
                                        VALUES ('$grupo', '$dia', '$materias[$i]', '$docentes[$i]', '$hora', '$aulas[$i]')";

                        if ($conn->query($sql_insertar) === TRUE) {
                            $registro_exitoso = true;
                            // Mostrar mensaje emergente si el registro es exitoso
                            if ($registro_exitoso) {
                                echo "<script>
                                        setTimeout(function() {
                                            alert('Registro exitoso');
                                        }, 1000);
                                    </script>";
                            }
                        } else {
                            echo "Error en la inserción: " . $conn->error;
                        }
                    } else {
                        // Mensaje de asignación duplicada
                        $mensaje_duplicado = "Ya existe una asignación para el docente '$docentes[$i]' en el día '$dia' y hora '$hora'.<br><br>";

                        // Preguntar al usuario si quiere actualizar los datos existentes
                        $mensaje_duplicado .= "¿Quieres actualizar esta asignación? (Sí/No)";

                        // Mostrar el mensaje y obtener la respuesta del usuario
                        $respuesta_usuario = strtolower(trim(readline($mensaje_duplicado)));

                        // Verificar la respuesta del usuario
                        if ($respuesta_usuario === 'si' || $respuesta_usuario === 'sí') {
                            // Realizar la actualización en la base de datos
                            $sql_actualizar = "UPDATE horarios 
                                            SET Materias = '$materias[$i]', Aula = '$aulas[$i]'
                                            WHERE Docentes = '$docentes[$i]' AND Dias = '$dia' AND Hora = '$hora'";

                            if ($conn->query($sql_actualizar) === TRUE) {
                                echo "Actualización exitosa.";
                                $actualizacion_realizada = true; // Se ha realizado una actualización
                            } else {
                                echo "Error en la actualización: " . $conn->error;
                            }
                        } else {
                            // No se realizan cambios, no se muestra el mensaje aquí
                        }
                    }
                }

                // Mostrar mensaje "No se realizaron cambios" solo si no se realizó ninguna actualización
                if (!$actualizacion_realizada) {
                    echo $mensaje_no_cambios;
                }                    
            }
            $conn->close();
        }
        ?>   
    </form>        
</body><br>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
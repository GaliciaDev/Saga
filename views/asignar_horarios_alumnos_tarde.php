<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilo_asignar_horario_alumno.css">
	<link rel="shortcut icon" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../css/diseño_movil.css">
	<title>Asignar Horarios</title>
</head>
<body>
<?php include '../php/nav_Admin.php'; ?>
    <head>
        <br><label>Seleccionar Turno: Vespertino</label>
            <a class="boton-personalizado" href="asignar_horarios_alumnos_tarde.php">Vespertino</a>
            <a class="boton-personalizado" href="asignar_horarios_alumnos.php">Matutino</a><br>
            <style>
                .boton-personalizado {
                display: inline-block;
                padding: 5px 10px; 
                background-color: gray; 
                color: #ffffff; 
                text-decoration: none; 
                border-radius: 5px; 
                transition: background-color 0.3s ease; 
                }
                
                .boton-personalizado:hover {
                    background-color: #333;
                }
            </style>
        <br><form class="formulario" method="POST" action="asignar_horarios_alumnos_tarde.php">
            <h1>Asignacion de Horarios</h1>
            <label>Ingrese Un Grupo a Asignar Horario</label>
                
                <input type="text" class="busca" id="grupo" name="asignar_grupo" placeholder="- -" required>                
                       
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
            <td>2:00 pm- 2:45 pm</td>
            <td>
                <select id="materia" name="materia[]" requierd>
                    <?php
                        // Conexión a la base de datos
                        include("../php/conexion.php");

                        // Consulta para obtener las Materias de tira_materias
                        $consultaMaterias = "SELECT Materias FROM tira_materias";
                        $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

                        echo '<option value="">Ingrese una Materia</option>';
                        // Generar las opciones del select
                        while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {                            
                            echo "<option value='" . $filaMateria['Materias'] . "'>" . $filaMateria['Materias'] . "</option>";
                        }

                        // Cerrar la conexión a la base de datos
                        mysqli_close($conexion);
                    ?>
                </select>
            </td>
            <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
            <td>
                <select id="docente" name="nombre_docente[]" requierd>
                    <?php
                        // Conexión a la base de datos
                        include("../php/conexion.php");

                        // Consulta para obtener las Materias de tira_materias
                        $consultaProfesores  = "SELECT docente FROM tira_materias";
                        $resultadoProfesores  = mysqli_query($conexion, $consultaProfesores );

                        echo '<option value="">Ingrese un Docente</option>';
                        // Generar las opciones del select
                        while ($filaProfesor = mysqli_fetch_assoc($resultadoProfesores )) {                            
                            echo "<option value='" . $filaProfesor['docente'] . "'>" . $filaProfesor['docente'] . "</option>";
                        }

                        // Cerrar la conexión a la base de datos
                        mysqli_close($conexion);
                    ?>
                </select>
            </td>
            <tr>                
                <td>2:45 pm - 3:30 pm</td>
                <td>
                    <select id="materia" name="materia[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaMaterias = "SELECT Materias FROM tira_materias";
                            $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

                            echo '<option value="">Ingrese una Materia</option>';
                            // Generar las opciones del select
                            while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {                             
                                echo "<option value='" . $filaMateria['Materias'] . "'>" . $filaMateria['Materias'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td>
                    <select id="docente" name="nombre_docente[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaProfesores  = "SELECT docente FROM tira_materias";
                            $resultadoProfesores  = mysqli_query($conexion, $consultaProfesores );

                            echo '<option value="">Ingrese un Docente</option>';
                            // Generar las opciones del select
                            while ($filaProfesor = mysqli_fetch_assoc($resultadoProfesores )) {                                
                                echo "<option value='" . $filaProfesor['docente'] . "'>" . $filaProfesor['docente'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
            </tr>    
            <tr>                
                <td>3:30 pm - 4:15 pm</td>
                <td>
                    <select id="materia" name="materia[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaMaterias = "SELECT Materias FROM tira_materias";
                            $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

                            echo '<option value="">Ingrese una Materia</option>';
                            // Generar las opciones del select
                            while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {                                
                                echo "<option value='" . $filaMateria['Materias'] . "'>" . $filaMateria['Materias'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td>
                    <select id="docente" name="nombre_docente[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaProfesores  = "SELECT docente FROM tira_materias";
                            $resultadoProfesores  = mysqli_query($conexion, $consultaProfesores );

                            echo '<option value="">Ingrese un Docente</option>';
                            // Generar las opciones del select
                            while ($filaProfesor = mysqli_fetch_assoc($resultadoProfesores )) {                                
                                echo "<option value='" . $filaProfesor['docente'] . "'>" . $filaProfesor['docente'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
            </tr> 
            <tr>                
                <td>4:15 pm - 5:00 pm</td>
                <td>
                    <select id="materia" name="materia[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaMaterias = "SELECT Materias FROM tira_materias";
                            $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

                            echo '<option value="">Ingrese una Materia</option>';
                            // Generar las opciones del select
                            while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {                                
                                echo "<option value='" . $filaMateria['Materias'] . "'>" . $filaMateria['Materias'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td>
                    <select id="docente" name="nombre_docente[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaProfesores  = "SELECT docente FROM tira_materias";
                            $resultadoProfesores  = mysqli_query($conexion, $consultaProfesores );

                            echo '<option value="">Ingrese un Docente</option>';
                            // Generar las opciones del select
                            while ($filaProfesor = mysqli_fetch_assoc($resultadoProfesores )) {                                
                                echo "<option value='" . $filaProfesor['docente'] . "'>" . $filaProfesor['docente'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
            </tr>   
            <tr>                           
                <td>5:00 pm - 5:30 pm</td>
                <td colspan="3">Reseso</td>
            </tr> 
            <tr>                
                <td>5:30 pm - 6:15 pm</td>
                <td>
                    <select id="materia" name="materia[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaMaterias = "SELECT Materias FROM tira_materias";
                            $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

                            echo '<option value="">Ingrese una Materia</option>';
                            // Generar las opciones del select
                            while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {                                
                                echo "<option value='" . $filaMateria['Materias'] . "'>" . $filaMateria['Materias'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td>
                    <select id="docente" name="nombre_docente[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaProfesores  = "SELECT docente FROM tira_materias";
                            $resultadoProfesores  = mysqli_query($conexion, $consultaProfesores );

                            echo '<option value="">Ingrese un Docente</option>';
                            // Generar las opciones del select
                            while ($filaProfesor = mysqli_fetch_assoc($resultadoProfesores )) {                                
                                echo "<option value='" . $filaProfesor['docente'] . "'>" . $filaProfesor['docente'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
            </tr>  
            <tr>                
                <td>6:15 pm - 7:00 pm</td>
                <td>
                    <select id="materia" name="materia[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaMaterias = "SELECT Materias FROM tira_materias";
                            $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

                            echo '<option value="">Ingrese una Materia</option>';
                            // Generar las opciones del select
                            while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {                                
                                echo "<option value='" . $filaMateria['Materias'] . "'>" . $filaMateria['Materias'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td>
                    <select id="docente" name="nombre_docente[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaProfesores  = "SELECT docente FROM tira_materias";
                            $resultadoProfesores  = mysqli_query($conexion, $consultaProfesores );

                            echo '<option value="">Ingrese un Docente</option>';
                            // Generar las opciones del select
                            while ($filaProfesor = mysqli_fetch_assoc($resultadoProfesores )) {                                
                                echo "<option value='" . $filaProfesor['docente'] . "'>" . $filaProfesor['docente'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
            </tr>  
            <tr>                
                <td>7:00 pm - 7:45 pm</td>
                <td>
                    <select id="materia" name="materia[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaMaterias = "SELECT Materias FROM tira_materias";
                            $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

                            echo '<option value="">Ingrese una Materia</option>';
                            // Generar las opciones del select
                            while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {                                
                                echo "<option value='" . $filaMateria['Materias'] . "'>" . $filaMateria['Materias'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td>
                    <select id="docente" name="nombre_docente[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaProfesores  = "SELECT docente FROM tira_materias";
                            $resultadoProfesores  = mysqli_query($conexion, $consultaProfesores );

                            echo '<option value="">Ingrese un Docente</option>';
                            // Generar las opciones del select
                            while ($filaProfesor = mysqli_fetch_assoc($resultadoProfesores )) {                                
                                echo "<option value='" . $filaProfesor['docente'] . "'>" . $filaProfesor['docente'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
            </tr>  
            <tr>                
                <td>7:45 pm - 8:30 pm</td>
                <td>
                    <select id="materia" name="materia[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaMaterias = "SELECT Materias FROM tira_materias";
                            $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

                            echo '<option value="">Ingrese una Materia</option>';
                            // Generar las opciones del select
                            while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {                                
                                echo "<option value='" . $filaMateria['Materias'] . "'>" . $filaMateria['Materias'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
                <td><input type="text" class="salon" id="salon" name="aula[]" placeholder="Aula" required></td>            
                <td>
                    <select id="docente" name="nombre_docente[]" requierd>
                        <?php
                            // Conexión a la base de datos
                            include("../php/conexion.php");

                            // Consulta para obtener las Materias de tira_materias
                            $consultaProfesores  = "SELECT docente FROM tira_materias";
                            $resultadoProfesores  = mysqli_query($conexion, $consultaProfesores );

                            echo '<option value="">Ingrese un Docente</option>';
                            // Generar las opciones del select
                            while ($filaProfesor = mysqli_fetch_assoc($resultadoProfesores )) {                             
                                echo "<option value='" . $filaProfesor['docente'] . "'>" . $filaProfesor['docente'] . "</option>";
                            }

                            // Cerrar la conexión a la base de datos
                            mysqli_close($conexion);
                        ?>
                    </select>
                </td>
            </tr>  
        </tr>
        </table>              
                            
        <br><input class="btnlimpiar" name="Limpiar" type="reset" id="btnResetear" value="Limpiar"><br>        
        <input class="btnguardar" name="asignar" type="submit" id="btnEnviar" value="Establecer Horarios">     
        <?php
        include '../php/conexion.php';

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $grupo = $_POST["asignar_grupo"];
            $dia = $_POST["dia"];
            $materias = $_POST["materia"];
            $docentes = $_POST["nombre_docente"];
            $horas = ["2:00 - 2:45", "2:45 - 3:30", "3:30 - 4:15", "4:15 - 5:00", "5:30 - 6:15", "6:15 - 7:00", "7:00 - 7:45", "7:45 - 8:30"];
            $aulas = $_POST["aula"];
            $turno = "Vespertino"; // Definir el turno como "Vespertino"

            for ($i = 0; $i < count($materias); $i++) {
                $actualizacion_realizada = false;
                $mensaje_no_cambios = "";

                for ($i = 0; $i < count($materias); $i++) {
                    $hora = $horas[$i];

                    $sql_verificar = "SELECT * FROM horarios WHERE Docentes = '$docentes[$i]' AND Dias = '$dia' AND Hora = '$hora'";
                    $resultado_verificar = $conexion->query($sql_verificar);

                    if ($resultado_verificar->num_rows == 0) {
                        $sql_insertar = "INSERT INTO horarios (grado_grupo, Dias, Materias, Docentes, Hora, Aula, turno)
                                        VALUES ('$grupo', '$dia', '$materias[$i]', '$docentes[$i]', '$hora', '$aulas[$i]', '$turno')";

                        if ($conexion->query($sql_insertar) === TRUE) {
                            $registro_exitoso = true;
                            if ($registro_exitoso) {
                                echo "<script>
                                        setTimeout(function() {
                                            alert('Registro exitoso');
                                        }, 1000);
                                    </script>";
                            }
                        } else {
                            echo "Error en la inserción: " . $conexion->error;
                        }
                    } else {
                        $mensaje_duplicado = "Ya existe una asignación para el docente '$docentes[$i]' en el día '$dia' y hora '$hora'.<br><br>";
                        $mensaje_duplicado .= "¿Quieres actualizar esta asignación? (Sí/No)";
                        $respuesta_usuario = strtolower(trim(readline($mensaje_duplicado)));

                        if ($respuesta_usuario === 'si' || $respuesta_usuario === 'sí') {
                            $sql_actualizar = "UPDATE horarios 
                                            SET Materias = '$materias[$i]', Aula = '$aulas[$i]'
                                            WHERE Docentes = '$docentes[$i]' AND Dias = '$dia' AND Hora = '$hora'";

                            if ($conexion->query($sql_actualizar) === TRUE) {
                                echo "Actualización exitosa.";
                                $actualizacion_realizada = true;
                            } else {
                                echo "Error en la actualización: " . $conexion->error;
                            }
                        } else {
                            // No se realizan cambios
                            $mensaje_no_cambios = "";
                        }
                    }
                }

                if (!$actualizacion_realizada) {
                    echo $mensaje_no_cambios;
                }
            }
            $conexion->close();
        }
    ?>
    </form>        
</body><br>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/estilo_horario.css">
	<link rel="shortcut icon" href="img/icon.png">
	<title>Horarios</title>
</head>
<body>
    <header>
		<nav>
            <ul class="menu">                
                <li><a href="index_docente.php">Inicio</a></li>                
                <li><a href="capturas_calificaciones_D.php">Captura Calificaciones</a></li>
                <li><a href="contactos_tutores_D.php">Contacto Tutores</a></li>
                <li><a href="estadisticas_alumno_D.php">Estadisticas Alumnos</a></li>
                <li><a href="apoyo_D.html">Apoyo Tecnico</a></li>
                <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
	</header>
    <head>
        <h1>Horario</h1>
        <br><br><label>Matricula: </label>
		<form method="POST" action="consulta_horarios.php">
			<input type="text" name="consulta" placeholder="Ingresa el Grupo ">
			<input type="submit" value="Buscar">
		</form><br>
	</head>
    </head>
    <table class="tabla_horarios">
        <?php
                //Recibir los datos del buscador
                if ($_POST) {
                    $consulta_h = $_POST['consulta'];		

                    //Variables para filas
                    $fil_lun = 0;
                    $fil_mar = 0;
                    $fil_mie = 0;
                    $fil_jue = 0;
                    $fil_vie = 0;

                    //Conexion a la BD
                    $conexion = mysqli_connect("localhost", "root", "");
                    mysqli_select_db($conexion, "sagadb");

                    //Realizamos consulta
                    $resultado = mysqli_query($conexion, "SELECT * FROM `horarios` WHERE `grado_grupo` = '$consulta_h';");
                    
                    while ($cont = mysqli_fetch_array($resultado)) {
                        switch ($cont['Dias']) {
                            case 'Lunes':
                                $fil_lun++;
                            break;
                            case 'Martes':
                                $fil_mar++;
                            break;
                            case 'Miercoles':
                                $fil_mie++;
                            break;
                            case 'Jueves':
                                $fil_jue++;
                            break;
                            case 'Viernes':
                                $fil_vie++;
                            break;
                        }
                    }
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
                    if($fil_lun != 0){
                        $res_lunes = mysqli_query($conexion, "SELECT * FROM `horarios` WHERE `grado_grupo` = '$consulta_h' AND `Dias`= 'Lunes';");
                        echo '
                        <!--Lunes-->
                        <tr>
                            <td rowspan="'.(++$fil_lun).'">Lunes</td>
                        </tr>';
                        while ($campo = mysqli_fetch_array($res_lunes)) {
                            echo '
                            <tr>
                                <td>'.($campo['grado_grupo']).'</td>
                                <td>'.($campo['Hora']).'</td>
                                <td>'.($campo['Materias']).'</td>
                                <td>'.($campo['Aula']).'</td>
                                <td>'.($campo['Docentes']).'</td>  
                            </tr>';
                        }
                    }
                    if($fil_mar != 0){
                        $res_martes = mysqli_query($conexion, "SELECT * FROM `horarios` WHERE `grado_grupo` = '$consulta_h' AND `Dias`= 'Martes';");
                        echo '
                        <!--Martes-->
                        <tr>
                            <td rowspan="'.(++$fil_mar).'">Martes</td> 
                        </tr>';
                        
                        while ($campo = mysqli_fetch_array($res_martes)) {                            
                                echo '
                                <tr>
                                    <td>'.($campo['grado_grupo']).'</td>
                                    <td>'.($campo['Hora']).'</td>
                                    <td>'.($campo['Materias']).'</td>
                                    <td>'.($campo['Aula']).'</td>
                                    <td>'.($campo['Docentes']).'</td>  
                                </tr>';                            
                        }
                    }
                    if($fil_mie != 0){
                        $res_mier = mysqli_query($conexion, "SELECT * FROM `horarios` WHERE `grado_grupo` = '$consulta_h' AND `Dias`= 'Miercoles';");
                            echo '
                            <!--Miercoles-->
                            <tr>
                                <td rowspan="'.(++$fil_mie).'">Miercoles</td>
                            </tr>';                    
                            while ($campo = mysqli_fetch_array($res_mier)) {                            
                                    echo '
                                    <tr>
                                        <td>'.($campo['grado_grupo']).'</td>
                                        <td>'.($campo['Hora']).'</td>
                                        <td>'.($campo['Materias']).'</td>
                                        <td>'.($campo['Aula']).'</td>
                                        <td>'.($campo['Docentes']).'</td>  
                                    </tr>';                            
                            }
                    }
                    if($fil_jue != 0){
                        $res_jue = mysqli_query($conexion, "SELECT * FROM `horarios` WHERE `grado_grupo` = '$consulta_h' AND `Dias`= 'Jueves';");
                            echo '                        
                            <!--Jueves-->
                            <tr>
                                <td rowspan="'.(++$fil_jue).'">Jueves</td>
                            </tr>';
                            while ($campo = mysqli_fetch_array($res_jue)) {                            
                                echo '
                                <tr>
                                    <td>'.($campo['grado_grupo']).'</td>
                                    <td>'.($campo['Hora']).'</td>
                                    <td>'.($campo['Materias']).'</td>
                                    <td>'.($campo['Aula']).'</td>
                                    <td>'.($campo['Docentes']).'</td>  
                                </tr>';                            
                            }
                    }
                    if($fil_vie != 0){ 
                        $res_vier = mysqli_query($conexion, "SELECT * FROM `horarios` WHERE `grado_grupo` = '$consulta_h' AND `Dias`= 'Viernes';");
                            echo '
                            </tr>
                            <!--Viernes-->
                            <tr>
                                <td rowspan="'.(++$fil_vie).'">Viernes</td>
                            </tr>';
                            while ($campo = mysqli_fetch_array($res_vier)) {                                
                                    echo '
                                    <tr>
                                        <td>'.($campo['grado_grupo']).'</td>
                                        <td>'.($campo['Hora']).'</td>
                                        <td>'.($campo['Materias']).'</td>
                                        <td>'.($campo['Aula']).'</td>
                                        <td>'.($campo['Docentes']).'</td>  
                                    </tr>';                                
                            }
                    }                    
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
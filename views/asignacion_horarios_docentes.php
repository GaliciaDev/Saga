<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/asignar_horario.css">
	<link rel="shortcut icon" href="../assets/img/icon.png">
	<title>Asignar Horarios</title>
</head>
<body>
    <header>
		<nav>
            <ul class="menu">
                <li><a href="../index_administrativo.php">Inicio</a></li>
                <li><a href="asignacion_horarios.php">Asignar Horario</a></li>
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
        <h1>Horarios a Asignar a Docentes</h1>
    </head>
    <form method="POST" action="php/recibir_datos_asignar_horarios.php">        
        <label for="dias">Dia:</label>
        <select class="dia" id="dias" name="dia" required>
            <option value="">Elije</option>
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miercoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
        </select>
        <label for="grupo">Grado y Grupo:</label>
            <input type="text" id="grupo" name="grupo" placeholder="- - " required>
        <label for="horario">Horario:</label>
        <select class="horario" id="horarios" name="hora" required>                           
                <option value="h">Elije la Hora</option>
                <option value="13:30 - 14:15">1:30 pm - 2:15 pm</option>
                <option value="14:15 - 15:00">2:15 pm - 3:00 pm</option>
                <option value="15:00 - 15:45">3:00 pm - 3:45 pm</option>
                <option value="15:45 - 16:30">3:45 pm - 4:30 pm</option>
                <option value="16:30 - 17:45">5:00 pm - 5:45 pm</option>
                <option value="17:45 - 18:30">5:45 pm - 6:30 pm</option>
                <option value="18:30 - 19:15">6:30 pm - 7:15 pm</option>
                <option value="19:15 - 20:00">7:15 pm - 8:00 pm</option>
            </option>
        </select>
        <label for="materias">Materias:</label>
            <input type="text" id="materias" name="materia" placeholder="Ingrese la Materia" required>
        <label for="salon">Aula:</label>
            <input type="text" id="salon" name="aula" placeholder="Ingrese el Aula" required>
                <?php                                        
                    //Conexion a la BD
                    include '../php/conexion.php';                    

                    //Realizamos consulta
                    $resultado = mysqli_query($conexion, "SELECT `nombreD`, `apellidoPd`, `apellidoMd` FROM `docentes`;");
                    
                    echo '<label for="d">Docentes:</label>
                    <select class="doct" name="nombre_completo_docentes">
                        <option value="">Ingrese un Docente</option>';
                    while ($campo = mysqli_fetch_array($resultado)) {
                        echo '
                        <option value="'.(implode(" ", [$campo['nombreD'], $campo['apellidoPd'], $campo['apellidoMd']])).'">'.(implode(" ", [$campo['nombreD'], $campo['apellidoPd'], $campo['apellidoMd']])).'</option>             
                        ';                            
                    }
                    echo '</select>';    
                    mysqli_close($conexion);                                
                ?>                    
            <br><input class="btnlimpiar" name="Limpiar" type="reset" id="btnResetear" value="Limpiar"><br>        
        <input class="btnguardar" name="asignar" type="submit" id="btnEnviar" value="Establecer Horarios">
    </form>        
</body><br>
<footer>
<?php include '../php/footerG.php';?>
</footer>
</html>
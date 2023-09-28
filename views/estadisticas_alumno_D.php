<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/estilo_estadisticas_alumno.css">
	<link rel="shortcut icon" href="img/icon.png">
	<title>Desempeño Alumno</title>
</head>
<body>	
	<header>
		<nav>
            <ul class="menu">
                <li><a href="index_docente.php">Inicio</a></li>                
                <li><a href="consulta_horarios_D.php">Horario</a></li>
                <li><a href="capturas_calificaciones_D.php">Captura Calificaciones</a></li>
                <li><a href="contactos_tutores_D.php">Contacto Tutores</a></li>                
                <li><a href="apoyo_D.html">Apoyo Tecnico</a></li>
                <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
	</header>
	<head>
		<h1>Desenpeño del Alumno</h1>		
	</head>
	<form action="estadisticas_alumno_D.php" method="POST">
		<label>Matricula del Alumno:</label>
		<input type="number" name="alumno" placeholder="Ingrese la Matricula" requied>
		<input class="btnguardar" name="Enviar" type="submit" id="btnEnviar" value="Buscar"><br>
		
	<table class="estadisticas_promedio_alumno">		
		<h4>Promedio de Materias</h4>
		<tr>				
			<th>Materias</th>
			<th>Primer Parcial</th>
			<th>Faltas</th>
			<th>Segundo Parcial</th>
			<th>Faltas</th>
			<th>Tercer Parcial</th>
			<th>Faltas</th>
			<th>Promedio Materia</th>			
		</tr>
		<?php
			//Recibir los datos del buscador
			if (isset($_POST['Enviar'])) {
				$id = $_POST['alumno'];      				              								
				$total_cal = 0;
				$total_mat = 0;

				//Conexion a la BD
				$conexion = mysqli_connect("localhost", "root", "");
				mysqli_select_db($conexion, "sagadb");

				//Realizamos consulta
				$resultado = mysqli_query($conexion, "SELECT * FROM `materias` WHERE `id_alumno` = '$id';");

				while ($campo = mysqli_fetch_array($resultado)) {
					echo '											
					<tr>								
						<td>'.($campo['Nom_Materia']).'</td>
						<td>'.(number_format($campo['Calificacion_1'], 2)).'</td>
						<td>'.($campo['Faltas_1']).'</td>
						<td>'.(number_format($campo['Calificacion_2'], 2)).'</td>
						<td>'.($campo['Faltas_2']).'</td>
						<td>'.(number_format($campo['Calificacion_3'], 2)).'</td>
						<td>'.($campo['Faltas_3']).'</td>
						<td>'.(number_format($campo['Promedio_Mat'], 2)).'</td>						
					</tr>';

					$total_mat++;
					$total_cal += $campo['Promedio_Mat'];
				}

				$promedio = $total_cal/$total_mat;
				echo '
				<tr>								
					<th colspan=7 style="text-align: right;">Promedio:</th> 
					<td>'.(number_format($promedio, 2)).'</td>					
				</tr>';

				mysqli_close($conexion);
			}
		?>		
	</table><br>
	</form>
</body>
	<footer>
  		<p>&copy; 2023 SAGA.</p>
  		<p>Contáctanos: info@example.com</p>
	</footer>
</html>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/estadisticas_alumno.css">
	<link rel="shortcut icon" href="../assets/img/icon.png">
	<link rel="stylesheet" href="../css/diseño_movil.css">
	<title>Desempeño Alumno</title>
</head>
<body>	
<?php include '../php/nav_Admin.php'; ?>
	<head>
		<h1>Desempeño del Alumno</h1>		
	</head>	
	
	<form action="estadisticas_alumno.php" method="POST">
		<label>Matricula del Alumno:</label>
		<input type="number" name="alumno" placeholder="Ingrese la Matricula" required>
		<input class="btnguardar" name="Enviar" type="submit" id="btnEnviar" value="Buscar"><br>
	</form>

	<?php
	if (isset($_POST['Enviar'])) {
		$id = $_POST['alumno'];
		$total_cal = 0;
		$total_mat = 0;

		// Conexion a la BD
		include '../php/conexion.php';
		mysqli_select_db($conexion, "sagadb");

		// Realizamos consulta con JOIN para obtener datos del alumno y materias
		$alumno = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `id_alumno` = '$id';");

		$resultado = mysqli_query($conexion, "SELECT * FROM `materias` WHERE `id_alumno` = '$id';");		

		$nombreCompleto = ""; // Variable para almacenar el nombre completo del alumno

		 echo '<table class="estadisticas_promedio_alumno">                                
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
				</tr>';

		while ($campo = mysqli_fetch_array($resultado)) {
			
			if (empty($nombreCompleto)) {
				$campos = mysqli_fetch_array($alumno);
				$nombreCompleto = implode(' ', [$campos['nombre'], $campos['apellidoP'], $campos['apellidoM']]);
				


				// Imprimir el ID del alumno, grado y grupo fuera de la tabla
				echo '<div>';
				echo 'ID del Alumno: ' . $campos['id_alumno'] . '<br>';
				echo 'Nombre Completo: ' . $nombreCompleto . '<br>';
				echo 'Grado y Grupo: ' . $campos['grado'] . ' ' . $campos['grupo'] . '<br>';
				echo '</div><br>';
			}								

			echo '
				<tr>                                
					<td>' . ($campo['Nom_Materia']) . '</td>
					<td>' . (number_format($campo['Calificacion_1'], 2)) . '</td>
					<td>' . ($campo['Faltas_1']) . '</td>
					<td>' . (number_format($campo['Calificacion_2'], 2)) . '</td>
					<td>' . ($campo['Faltas_2']) . '</td>
					<td>' . (number_format($campo['Calificacion_3'], 2)) . '</td>
					<td>' . ($campo['Faltas_3']) . '</td>
					<td>' . (number_format($campo['Promedio_Mat'], 2)) . '</td>
				</tr>';

			$total_mat++;
			$total_cal += $campo['Promedio_Mat'];
			

			
		}
		
		// Verificar si se encontraron materias antes de calcular el promedio
		if ($total_mat > 0) {
			$promedio = $total_cal / $total_mat;
			echo '<td colspan=8 style="text-align: right; padding-right: 30px;">Promedio General: ' . number_format($promedio, 2) . '</td>';
		} else {
			echo '<div>No se encontraron materias para el alumno.</div>';
		}
		echo '</table>';
		mysqli_close($conexion);

		echo '<br><a target="_blank" href="../php/imprimir_estadisticas.php?id_alumno='.$id.'"><button class="btnguardar">Imprimir PDF</button></a><br><br>';
	}
?>
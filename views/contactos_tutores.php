<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/contactos_tutores.css">
	<link rel="shortcut icon" href="../assets/img/icon.png">
	<link rel="stylesheet" href="../css/diseño_movil.css">
	<title>Contacto a Tutores</title>
</head>
<body>
<?php include '../php/nav_Admin.php'; ?>
	<head>		
		<br><br><label>Alumno: </label>
		<form method="POST" action="contactos_tutores.php">
			<input type="text" name="contactos" placeholder="Ingrese la Matricula del Alumno">
			<input type="submit" value="Buscar">
		</form>
	</head>

	<table class="contacto_tutores">
		<h4>Informacion</h4>		

		<?php
			//Recibir los datos del buscador
			if ($_POST) {
				$matricula = $_POST['contactos'];		

				//Conexion a la BD
				include '../php/conexion.php';
				mysqli_select_db($conexion, "sagadb");

				//Realizamos consulta
				$resultado = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `id_alumno` = '$matricula' LIMIT 1;");

				$campo = mysqli_fetch_array($resultado);
				echo '
				<tr>							
					<th>Nombre Tutor</th>					
						<td>'.($campo['tutor']).'</td>							
					<th>Telefono</th>			
						<td>'.($campo['telefono']).'</td>						
				</tr>
				<tr>
					<th>Domicilio</th>
						<td>'.($campo['domicilio']).'</td>
					<th>Correo</th>
						<td>'.($campo['correo']).'</td>
				</tr>  
				';                            
			}
    		?>  
	</table>
</body>
	<footer>
	<?php include '../php/footerG.php';?>
	</footer>
</html>
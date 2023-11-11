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
		<center><br><br><label>Alumno: </label><br>
		<form method="POST" action="contactos_tutores.php">
			<input type="text" name="contactos" placeholder="Ingrese la Matricula del Alumno"><br><br>
			<input type="submit" value="Buscar">			
		</form>
	</head>

	<style>
		input[type="text"] {
			width: 16%;
			padding: 10px;
			margin-bottom: 20px;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
	</style>
	<table class="contacto_tutores">
		<br><center><h4>Informacion</h4></center><br>

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
	</table></center><br><br>
</body>
	<footer>
	<?php include '../php/footerG.php';?>
	</footer>
</html>
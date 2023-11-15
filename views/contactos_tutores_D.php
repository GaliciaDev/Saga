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
	<?php include '../php/nav_D.php'; ?>
	<head>	
		<style>
			.dato{
				width: 16%;
				padding: 10px;
				margin-bottom: 20px;
				border: 1px solid #ccc;
				border-radius: 4px;
			}
		</style>	
		<center><br><br><label>Alumno: </label>
		<form method="POST" action="contactos_tutores_D.php">
			<input class="dato" type="text" autofocus name="contactos" placeholder="Ingrese la Matricula del Alumno">
			<input type="submit" value="Buscar">
		</form>
	</head>

	<table class="contacto_tutores">			
		<?php
		//Recibir los datos del buscador
		if ($_POST) {
			$matricula = $_POST['contactos'];        

			//Conexion a la BD
			include '../php/conexion.php';			

			//Realizamos consulta
			$resultado = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `id_alumno` = '$matricula' LIMIT 1;");

			// Verificamos si se encontraron resultados
			if (mysqli_num_rows($resultado) > 0) {
				$campo = mysqli_fetch_array($resultado);
				echo '
				<table class="contacto_tutores">
					<h4>Informacion</h4>
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
				</table></center>
				';
			} else {
				echo "Usuario no encontrado.";
			}   
		}
		?>
  
	</table>
</body>
	<footer>
	<?php include '../php/footerG.php';?>
	</footer>
</html>
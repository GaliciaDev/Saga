<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/contactos_tutores.css">
	<link rel="shortcut icon" href="../assets/img/icon.png">
	<title>Contacto a Tutores</title>
</head>
<body>
	<header>
		<nav>
            <ul class="menu">
                <li><a href="../index_docente.php">Inicio</a></li>
                <li><a href="consulta_horarios_D.php">Horario</a></li>
                <li><a href="capturas_calificaciones_D.php">Captura Calificaciones</a></li>                
                <li><a href="estadisticas_alumno_D.php">Estadisticas Alumnos</a></li>
                <li><a href="apoyo_D.html">Apoyo Tecnico</a></li>
                <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
	</header>
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
				$conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
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
  		<p>&copy; 2023 SAGA.</p>
  		<p>Contáctanos: info@example.com</p>
	</footer>
</html>
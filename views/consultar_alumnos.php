<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/consulta_alumnos.css">
	<link rel="shortcut icon" href="../assets/img/icon.png">
	<link rel="stylesheet" href="../css/diseño_movil.css">
	<title>Consulta</title>
</head>
<body>
    
    <head>
        <h1>Consulta y Actualizacion de Alumnos</h1>
    </head>    	
	<form class="registro" id="registro" action="consultar_alumnos.php" method="POST">   	
		<div id="Botones">			                                                           
			<label>Matricula del Alumno</label>
			<input class="materias" type="text" name="id"  value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" placeholder="Ingrese Matricula">
			<input type="submit" class="busqueda" name="buscar" value="Buscar">			
		
			<img src="../assets/img/img2.png" style="width: 100%;" />            
			<a href="registro_alumnos.html"><input class="btnconsulta" name="Consultar" type="button" id="btnSalir" value="Registrar"></a>
			<br><a href="eliminar_alumno.php"><input class="btneliminar" name="Consultar" type="button" id="btnSalir" value="Eliminar"></a>
			<br><br><br><a href="../index_administrativo.php"><input class="btnsalir" name="Salir" type="button" id="btnSalir" value="Salir"></a><br>
			<img src="../assets/img/img3.png" style="width: 100%;" />		
		</div>		
	
		<?php
			//Recibir los datos del buscador
			if (isset($_POST['buscar'])) {
				$matricula_a = $_POST['id'];                    				
				

				//Conexion a la BD
				include '../php/conexion.php';
				mysqli_select_db($conexion, "sagadb");

				//Realizamos consulta
				$resultado = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `id_alumno` = '$matricula_a';");

				while ($campo = mysqli_fetch_array($resultado)) {
					echo '
					<div id="Campos">
					<table class="tabla">
					<tr>
						<h3>Consulta del Alumno: <p>'.(implode(" ", [$campo['nombre'], $campo['apellidoP'], 	$campo['apellidoM']])).'</p></h3><br>
						
							<h4 class="titulo">Registro de Alumnos</h4>		
							<input type="hidden" name="id" value="'.($campo['id_alumno']).'">											
							<label class="nom">Nombre</label>							
								<input class="nombre" autofocusu type="text" '.($campo['nombre']).' name="nombre" placeholder="Introduzca su Nombre" value="'.($campo	['nombre']).'" required><br><br>
							<label class="nom">Apellido Paterno</label>
								<input class="nombre" autofocusu type="text" '.($campo['apellidoP']).' name="apellidoP" placeholder="Apellido Paterno" value="'.($campo	['apellidoP']).'" required><br><br>
							<label class="nom">Apellido Materno</label>
								<input class="nombre" autofocusu type="text" '.($campo['apellidoM']).' name="apellidoM" placeholder="Apellido Materno" value="'.($campo	['apellidoM']).'" required><br><br>
							<label class="ed">Edad</label>
								<input class="edad" type="number" name="edad" min="11" max="99" '.($campo['edad']).' placeholder="- -" value="'.($campo	['edad']).'" required><br><br>           
							<label class="domi">Dirrecion</label>
								<input class="domicilio" type="text" name="domicilio" '.($campo['domicilio']).' placeholder="Donde Vive" value="'.($campo	['domicilio']).'" required><br><br>							    
							<label class="corr">Correo Electronico</label>
								<input class="correito" type="email" name="correo" '.($campo['correo']).' placeholder="Ejemplo@example.com" value="'.($campo	['correo']).'" required class="formulario"><br><br>            
							<label class="fe">Fecha de Nacimiento</label>
								<input class="na" type="date" name="natalicio" '.($campo['natalicio']).' class="CajasL" value="'.($campo	['natalicio']).'" required><br><br>
							<label class="nomt">Nombre Tutor</label>
								<input class="nombret" autofocusu type="text" '.($campo['tutor']).' name="tutor" placeholder="Nombre Completo" value="'.($campo	['tutor']).'" required><br><br>
							<label class="tel"> Telefono Tutor</label>
								<input class="reg" type="number" name="telefono" '.($campo['telefono']).' placeholder="10 Digitos" min="10" value="'.($campo	['telefono']).'" required><br><br>							
							<label class="grado">Grado</label>
								<input class="g" type="number" name="grado" '.($campo['grado']).' placeholder="Grado" value="'.($campo['grado']).'" required><br><br>
							<label class="grupo">Grupo</label>
								<input class="gr" type="text" name="grupo" '.($campo['grupo']).' placeholder="Grupo" value="'.($campo['grupo']).'" required><br><br>
							<label class="turno">Turno</label>
								<select class="turn" name="turno" '.($campo['turno']).' required>
									<option value="Matutino">Matutino</option>
									<option value="Vespertino">Vespertino</option>
								</select><br><br>
							
								<br><br><input type="submit" name="capturar" value="Actualizar Informacion"> 							
						</div>
					</tr>  
					';                            
				}
				mysqli_close($conexion);
			}                    
			else if (isset($_POST['capturar'])) {		
				$id = $_POST['id'];
				$Nombre = $_POST['nombre'];
				$ApellidoP = $_POST['apellidoP'];
				$ApellidoM = $_POST['apellidoM'];
				$FechaNac = $_POST['natalicio'];
				$Edad = $_POST['edad'];
				$Domicilio = $_POST['domicilio'];
				$Tutor = $_POST['tutor'];		
				$Tel_Tutor = $_POST['telefono'];				
				$Correo = $_POST['correo'];		
				$Grado = $_POST['grado'];
				$Grupo = $_POST['grupo'];	
				$Turno = $_POST['turno'];					

				include '../php/conexion.php';
				mysqli_select_db($conexion, "sagadb");		
					
				$Resultado = mysqli_query($conexion, "UPDATE `alumnos` SET  `nombre` = '$Nombre', `apellidoP` = '$ApellidoP', `apellidoM` = '$ApellidoM', `natalicio` = '$FechaNac', `edad` = '$Edad', `domicilio` = '$Domicilio', `tutor` = '$Tutor', `telefono` = '$Tel_Tutor', `correo` = '$Correo', `grado` = '$Grado', `grupo` = '$Grupo', `turno` = '$Turno' WHERE `id_alumno` = '$id';");	

				if($Resultado==true){
					echo '
					<html lang="en">
					<head>
						<meta charset="UTF-8">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">				
						<title>Centrado de mensaje de carga</title>
					</head>
					<body>
							<div class="loader-container">
							<div class="loader-message">Datos Actualizados...</div>
						</div>
					</body>
					</html>
						<style>
							.loader-container {
								display: flex;
								justify-content: center;
								align-items: center;
								background-color: rgba(0, 0, 0, 0.5);
								position: fixed;
								top: 0;
								left: 0;
								width: 100%;
								height: 100%;
								z-index: 9999;
							}
							
							.loader-message {
								background-color: #fff;
								padding: 20px;
								border-radius: 5px;
								font-size: 18px;
							}
						</style>';
					echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=consultar_alumnos.php">';
				}		
				else  {
					echo "Error en la consulta";
				}
			}			
		?>                            
            </table>
		</form><br>	            	     			
</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
<?php
	if ($_POST){		
		$Matricula_D=$_POST['id_docente'];
		$Nombre=$_POST['nombreD'];
		$ApellidoP=$_POST['apellidoPd'];
		$ApellidoM=$_POST['apellidoMd'];
		$FechaNac=$_POST['natalicioD'];
		$Edad=$_POST['edad'];
		$Domicilio=$_POST['direccionD'];		
		$Telefono=$_POST['telefonoD'];
		$Telefono_Emg=$_POST['telefonoEd'];
		$Genero=$_POST['sexoD'];
		$Correo=$_POST['correoD'];			
		$Cargo=$_POST['cargoD'];
		$Area=$_POST['areaD'];							
		$Clave = password_hash($_POST['Clave'], PASSWORD_BCRYPT);

		include 'conexion.php';
		mysqli_select_db($conexion, "sagadb");		

		$Resultado=mysqli_query($conexion, "INSERT INTO `docentes`(`id_docente`, `nombreD`, `apellidoPd`, `apellidoMd`, `edad`, `sexoD`, `direccionD`, `telefonoD`, `cargoD`, `correoD`, `areaD`, `natalicioD`, `telefonoEd`, `Horario_D`, `Clave`) VALUES ($Matricula_D, '$Nombre', '$ApellidoP', '$ApellidoM', '$Edad', '$Genero', '$Domicilio', '$Telefono', '$Cargo', '$Correo', '$Area', '$FechaNac', '$Telefono_Emg', NULL, '$Clave')");
		if($Resultado==true){
			echo '<html lang="en">
			<head>
				<meta charset="UTF-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">				
				<title>Centrado de mensaje de carga</title>
			</head>
			<body>
					<div class="loader-container">
					<div class="loader-message">Datos Registrados...</div>
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
			echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../views/registro_docentes.php">';
		}
		else{ echo "ERROR En La Consulta";
		mysqli_close($conexion);
		}
	}
	else{
		echo "ERROR";
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=index_administrativo.php>';
	}
?>
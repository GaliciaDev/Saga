<?php
	if ($_POST){		
		$Matricula=$_POST['id_admin'];
		$Nombre_adm=$_POST['nombreAa'];
		$ApellidoP_adm=$_POST['apellidoPa'];
		$ApellidoM_adm=$_POST['apellidoM'];
		$FechaNac_adm=$_POST['natalicioA'];
		$Edad_adm=$_POST['edadA'];
		$Domicilio_adm=$_POST['direccionA'];		
		$Telefono_adm=$_POST['telefonoA'];
		$Telefono_Emg_adm=$_POST['telefonoEa'];
		$Genero_adm=$_POST['sexoA'];
		$Correo_adm=$_POST['correoA'];			
		$Cargo_adm=$_POST['cargoA'];
		$Area_adm=$_POST['areaA'];					
		$Password_adm=$_POST['Clave_adm'];		

		$conexion=mysqli_connect("localhost","DBA-Saga","srvtySDL&");
		mysqli_select_db($conexion, "sagadb");		

		$Resultado=mysqli_query($conexion, "INSERT INTO `administrativo`(`id_admin`, `nombreAa`, `apellidoPa`, `apellidoM`, `Horario_Adm`, `telefonoEa`, `edadA`, `sexoA`, `natalicioA`, `direccionA`, `telefonoA`, `cargoA`, `correoA`, `areaA`, `Clave_adm`) VALUES ($Matricula,'$Nombre_adm','$ApellidoP_adm','$ApellidoM_adm', NULL, '$Telefono_Emg_adm','$Edad_adm','$Genero_adm','$FechaNac_adm','$Domicilio_adm','$Telefono_adm','$Cargo_adm','$Correo_adm','$Area_adm','$Password_adm');");
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
			echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../views/registro_administrativo.html">';
		}
		else{ echo "ERROR En La Consulta";}
		mysqli_close($conexion);
	}
	else{
		echo "ERROR";
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=index_administrativo.php>';
	}
?>
<?php
	if ($_POST){		
		$Matricula=$_POST['id_alumno'];
		$Nombre=$_POST['nombre'];
		$ApellidoP=$_POST['apellidoP'];
		$ApellidoM=$_POST['apellidoM'];
		$FechaNac=$_POST['natalicio'];
		$Edad=$_POST['edad'];
		$Domicilio=$_POST['domicilio'];
		$Tutor=$_POST['tutor'];		
		$Tel_Tutor=$_POST['telefono'];
		$Genero=$_POST['sexo'];
		$Correo=$_POST['correo'];		
		$Grado=$_POST['grado'];
		$Grupo=$_POST['grupo'];
		$Clave=$_POST['Clave_A'];		
		$Turno=$_POST['turno'];
		$Periodo=date("Y-m");

		include 'conexion.php';
		mysqli_select_db($conexion, "sagadb");		

		$Resultado=mysqli_query($conexion,"INSERT INTO `alumnos`(`id_alumno`, `nombre`, `apellidoP`, `apellidoM`, `natalicio`, `edad`, `sexo`, `domicilio`, `tutor`, `telefono`, `correo`, `grado`, `turno`, `materias`, `periodo`, `Horario_A`, `Clave_A`, `grupo`) VALUES ('$Matricula','$Nombre','$ApellidoP','$ApellidoM','$FechaNac','$Edad','$Genero','$Domicilio','$Tutor','$Tel_Tutor','$Correo','$Grado','$Turno', null,'$Periodo', null,'$Clave','$Grupo')");

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
			echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../views/registro_alumnos.html">';
		}		
		else  {
			echo "Error en la consulta";
		}
		mysqli_close($conexion);
	}
	else{
		echo "ERROR";
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=index_administrativo.php>';
	}
?>
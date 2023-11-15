<?php
	if ($_POST){		
		$GradoyGrupo = $_POST['grupo'];				
		$materias = $_POST['materia'];
		$aulas = $_POST['aula'];
		$docentes = $_POST['nombre_completo_docentes'];
		$dias = $_POST['dia'];
		$hora = $_POST['hora'];

		include 'conexion.php';			

		$Resultado=mysqli_query($conexion, "SELECT * FROM `horarios` WHERE `grado_grupo` = '$GradoyGrupo' AND `Dias` =  '$dias' AND `Materias` = '$materias' AND `Docentes` = '$docentes' AND `Hora` = '$hora' AND `Aula` = '$aulas'");
		if(mysqli_num_rows($Resultado) == 0){
			$Resultado=mysqli_query($conexion, "INSERT INTO `horarios`(`grado_grupo`, `Dias`, `Materias`, `Docentes`, `Hora`, `Aula`) VALUES ('$GradoyGrupo','$dias','$materias','$docentes','$hora','$aulas')");
			
			if($Resultado == true){
				echo 'Datos Registrados';
				echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=\'../asignacion_horarios_docentes.php\'">';
			}
		}else {
			echo 'Ya Existe un Registro Igual';
		}
		mysqli_close($conexion);
	}
	else{
		echo 'UwU';	
	}
?>
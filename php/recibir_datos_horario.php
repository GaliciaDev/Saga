<?php
	if ($_POST){
		$Turno=$_POST['turno'];
		$Horario_A=$_POST['horario_a'];
		$Horario_D=$_POST['horario_d'];
		$Horario_Adm=$_POST['horario_adm'];

		include 'conexion.php';			

		$Resultado=mysqli_query($conexion,"INSERT INTO `horarios`(`Turno`, `Horario_A`, `Horario_D`, `Horario_Adm`) VALUES ('".$Turno."','".$Horario_A."','".$Horario_D."','".$Horario_Adm."');");
		if($Resultado==true){
			echo "Gracias Hemos Recibido Tus Datos. Espere un Momento Por Favor\n";
			echo '<META HTTP-EQUIV="REFRESH" CONTENT="15;URL=####login.php">';
		}
		else{ echo "ERROR En La Consulta";
		mysqli_close($conexion);
		}
	}
	else{
		echo "ERROR";
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=#####registro_alumno.html>';
	}
?>
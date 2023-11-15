<?php
	if ($_POST){
		$Matricula=$_POST['matricula'];
		$Nombre=$_POST['nombre'];
		$ApellidoP=$_POST['apellidop'];
		$ApellidoM=$_POST['apellidom'];
		$FechaNac=$_POST['fechanac'];
		$Edad=$_POST['edad'];
		$Domicilio=$_POST['direccion'];
		$Tutor=$_POST['tutor'];		
		$Tel_Tutor=$_POST['tel_tutor'];
		$Genero=$_POST['genero'];
		$Correo=$_POST['correo'];
		$Grado=$_POST['grado'];
		$Turno=$_POST['turno'];
		$Materias=$_POST['materias'];
		$Docentes=$_POST['docentes'];		
		$Horario_A=$_POST['horario_a'];
		$Password=$_POST['password'];		

		include 'conexion.php';			

		$Resultado=mysqli_query($conexion,"INSERT INTO `users`(`Matricula`, `Nombre`, `Apellido_P`, `Apellido_M`, `Fecha_Nac`, `Edad`,`Genero`,`Dirrecion`,`Tutor`,`Tutor`,`Telefono_Tutor`,`Correo`,`Grado`,`Turno`,`Materias`,`Docente`,`Horario_A`,`Password`) VALUES ('".null."','".$Nombre."','".$ApellidoP."','".$ApellidoM."','".$FechaNac."','".$Edad."','".$Domicilio."','".$Tutor."','".$Tel_Tutor."','".$Genero."','".$Correo."','".$Grado."','".$Turno."','".$Materias."','".$Docentes."','".$Horario_A."','".$Password."');");
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
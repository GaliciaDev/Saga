<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/consulta.css">
	<link rel="shortcut icon" href="../assets/img/icon.png">
	<title>Consulta y Actualizacion</title>
</head>
<body>
    
    <head>
        <h1>Consulta y Actualizacion de Docentes</h1>
    </head>    	
	<form class="registro" id="registro" action="consulta_docentes.php" method="POST">   	
		<div id="Botones">			                                                           
			<label class="antes">Matricula del Docente</label>
			<input class="materias" type="text" name="id"  value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" placeholder="Ingrese Matricula">
			<input type="submit" class="busqueda" name="buscar" value="Buscar">			
		
			<img src="../assets/img/img2.png" style="width: 100%;" />        
            <a href="registro_docentes.html"><input class="btnconsulta" name="Consultar" type="button" id="btnSalir" value="Registro"></a><br>
            <a href="eliminar_docente.php"><input class="btneliminar" name="Consultar" type="button" id="btnSalir" value="Eliminar"></a><br><br>    
			<br><a href="../index_administrativo.php"><input class="btnsalir" name="Salir" type="button" id="btnSalir" value="Salir"></a><br>
			<img src="../assets/img/img3.png" style="width: 100%;" />		
		</div>		
	
		<?php
			//Recibir los datos del buscador
			if (isset($_POST['buscar'])) {
				$matricula_d = $_POST['id'];                    				
				

				//Conexion a la BD
				include '../php/conexion.php';
				mysqli_select_db($conexion, "sagadb");

				//Realizamos consulta
				$resultado = mysqli_query($conexion, "SELECT * FROM `docentes` WHERE `id_docente` = '$matricula_d';");

				while ($campo = mysqli_fetch_array($resultado)) {
					echo '
					<div id="Campos">
					<table class="tabla">
					<tr>
						<h3>Consulta del Docente: <p>'.(implode(" ", [$campo['nombreD'], $campo['apellidoPd'], 	$campo['apellidoMd']])).'</p></h3><br>
						
                        <h4 class="titulo">Registro de Docentes</h4>
                            <input type="hidden" name="id" value="'.($campo['id_docente']).'">                        
                        <label class="nom">Nombre</label>
                            <input class="nombre" autofocusu type="text" '.($campo['nombreD']).' name="nombreD" placeholder="Introduzca su Nombre" value="'.($campo	['nombreD']).'" required><br><br>
                        <label class="nom">Apellido Paterno</label>
                            <input class="nombre" autofocusu type="text" '.($campo['apellidoPd']).' name="apellidoPd" placeholder="Apellido Paterno" value="'.($campo	['apellidoPd']).'" required><br><br>
                        <label class="nom">Apellido Materno</label>
                            <input class="nombre" autofocusu type="text" '.($campo['apellidoMd']).' name="apellidoMd" placeholder="Apellido Materno" value="'.($campo	['apellidoMd']).'" required><br><br>
                        <label class="ed">Edad</label>
                            <input class="edad" type="number" name="edad" min="11" max="99" '.($campo['edad']).' placeholder="- -" value="'.($campo	['edad']).'" required>
                        <label class="te">Telefono Particular</label>
                            <input class="telp" type="number" name="telefonoD" '.($campo['telefonoD']).' placeholder="10 Digitos" min="10" value="'.($campo	['telefonoD']).'" required><br><br>
                        <label class="domi"> Dirrecion</label>
                            <input class="domicilio" type="text" '.($campo['direccionD']).' name="direccionD" placeholder="Donde Vive" value="'.($campo	['direccionD']).'" required><br><br>                       
                        <label>Cargo</label>            
                        <select class="car" name="cargoD">
                            <option class="carg" value="'.($campo	['cargoD']).'">'.($campo['cargoD']).'</option>
                            <option class="carg" value="Docente">Docente</option>
                            <option class="carg" value="Coordinacion">Coordinacion</option>
                            <option class="carg" value="Secretaria">Secretaria</option>
                            <option class="carg" value="Prefecto">Prefecto</option>
                            <option class="carg" value="Administrativo">Administrativo</option>
                        </select><br><br>
                        <label class="corr">Correo Electronico</label>
                            <input class="correito" type="email" name="correoD" '.($campo	['correoD']).' placeholder="Ejemplo@example.com" required value="'.($campo	['correoD']).'" class="formulario"><br><br>
                        <label class="a">Area</label>
                        <select class="reg" name="areaD">
                            <option class="reg" value="'.($campo	['areaD']).'">'.($campo	['areaD']).'</option>
                            <option class="reg" value="Docente">Ciencias Administrativas</option>
                            <option class="reg" value="Coordinacion">Control Escolar</option>
                            <option class="reg" value="Secretaria">Nose</option>            
                        </select><br><br>
                        <label class="fe">Fecha de Nacimiento</label>
                        <input class="na" type="date" name="natalicioD" '.($campo['natalicioD']).' class="CajasL" value="'.($campo	['natalicioD']).'" required><br><br>
                        <label class="telpp"> Telefono Emergencia</label>
                            <input class="telp" type="number" name="telefonoEd"placeholder="10 Digitos" '.($campo	['telefonoEd']).' min="10" value="'.($campo	['telefonoEd']).'" required><br><br>                        							
							
								<br><br><input type="submit" name="btnguardar" value="Actualizar Informacion"> 							
						</div>
					</tr>  
					';                            
				}
				mysqli_close($conexion);
			}                    
			else if (isset($_POST['capturar'])) {		
				$id = $_POST['id'];
				$Nombre = $_POST['nombreD'];
				$ApellidoP = $_POST['apellidoPd'];
				$ApellidoM = $_POST['apellidoMd'];
				$FechaNac = $_POST['natalicioD'];
				$Edad = $_POST['edad'];
				$Domicilio = $_POST['direccionD'];
				$Telefono = $_POST['telefonoD'];		
				$Tel_Emg = $_POST['telefonoEd'];				
				$Correo = $_POST['correoD'];	
                $Cargo = $_POST['cargoD'];
                $Area = $_POST['areaD'];

				include '../php/conexion.php';
				mysqli_select_db($conexion, "sagadb");		
					
				$Resultado = mysqli_query($conexion, "UPDATE `docentes` SET  `nombreD` = '$Nombre', `apellidoPd` = '$ApellidoP', `apellidoMd` = '$ApellidoM', `natalicioD` = '$FechaNac', `edad` = '$Edad', `direccionD` = '$Domicilio', `telefonoD` = '$Telefono', `telefonoEd` = '$Tel_Emg', `correoD` = '$Correo', `cargoD` = '$Cargo', `areaD` = '$Area' WHERE `id_docente` = '$id';");	

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
					echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=consulta_docentes.php">';
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
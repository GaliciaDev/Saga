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
        <h1>Consulta y Actualizacion de Administrativo</h1>
    </head>    	
	<form class="registro" id="registro" action="consulta_administrativo.php" method="POST">   	
		<div id="Botones">			                                                           
			<label class="antes">Matricula Docente</label>
			<input class="materias" type="text" name="id"  value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" placeholder="Ingrese Matricula">
			<input type="submit" class="busqueda" name="buscar" value="Buscar">			
		
			<img src="../assets/img/img2.png" style="width: 100%;" />        
            <a href="registro_administrativo.html"><input class="btnconsulta" name="Consultar" type="button" id="btnSalir" value="Registro"></a><br>
            <a href="eliminar_administrativo.php"><input class="btneliminar" name="Consultar" type="button" id="btnSalir" value="Eliminar"></a><br><br>
			<br><a href="../index_administrativo.php"><input class="btnsalir" name="Salir" type="button" id="btnSalir" value="Salir"></a><br><br>
			<img src="../assets/img/img3.png" style="width: 100%;" />		
		</div>		
	
		<?php
			//Recibir los datos del buscador
			if (isset($_POST['buscar'])) {
				$matricula_d = $_POST['id'];                    				
				

				//Conexion a la BD
				$conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
				mysqli_select_db($conexion, "sagadb");

				//Realizamos consulta
				$resultado = mysqli_query($conexion, "SELECT * FROM `administrativo` WHERE `id_admin` = '$matricula_d';");

				while ($campo = mysqli_fetch_array($resultado)) {
					echo '
					<div id="Campos">
					<table class="tabla">
					<tr>
						<h3>Consulta del Docente: <p>'.(implode(" ", [$campo['nombreAa'], $campo['apellidoPa'], 	$campo['apellidoM']])).'</p></h3><br>
						
                        <h4 class="titulo">Registro de Docentes</h4>
                            <input type="hidden" name="id" value="'.($campo['id_admin']).'">                        
                        <label class="nom">Nombre</label>
                            <input class="nombre" autofocusu type="text" '.($campo['nombreAa']).' name="nombre" placeholder="Introduzca su Nombre" value="'.($campo	['nombreAa']).'" required><br><br>
                        <label class="nom">Apellido Paterno</label>
                            <input class="nombre" autofocusu type="text" '.($campo['apellidoPa']).' name="apellidoP" placeholder="Apellido Paterno" value="'.($campo	['apellidoPa']).'" required><br><br>
                        <label class="nom">Apellido Materno</label>
                            <input class="nombre" autofocusu type="text" '.($campo['apellidoM']).' name="apellidoM" placeholder="Apellido Materno" value="'.($campo	['apellidoM']).'" required><br><br>
                        <label class="ed">Edad</label>
                            <input class="edad" type="number" name="edad" min="11" max="99" '.($campo['edadA']).' placeholder="- -" value="'.($campo	['edadA']).'" required>
                        <label class="te">Telefono Particular</label>
                            <input class="tel" type="number" name="telefono" '.($campo['telefonoA']).' placeholder="10 Digitos" min="10" value="'.($campo	['telefonoA']).'" required><br><br>
                        <label class="domi"> Dirrecion</label>
                            <input class="domicilio" type="text" '.($campo['direccionA']).' name="direccion" placeholder="Donde Vive" value="'.($campo	['direccionA']).'" required><br><br>                       
                        <label>Cargo</label>            
                        <select class="car" name="cargo">
                            <option class="carg" value="'.($campo	['cargoA']).'">'.($campo['cargoA']).'</option>
                            <option class="carg" value="Docente">Docente</option>
                            <option class="carg" value="Coordinacion">Coordinacion</option>
                            <option class="carg" value="Secretaria">Secretaria</option>
                            <option class="carg" value="Prefecto">Prefecto</option>
                            <option class="carg" value="Administrativo">Administrativo</option>
                        </select><br><br>
                        <label class="corr">Correo Electronico</label>
                            <input class="correito" type="email" name="correo" '.($campo	['correoA']).' placeholder="Ejemplo@example.com" required value="'.($campo	['correoA']).'" class="formulario"><br><br>
                        <label class="a">Area</label>
                        <select class="reg" name="area">
                            <option class="reg" value="'.($campo	['areaA']).'">'.($campo	['areaA']).'</option>
                            <option class="reg" value="Docente">Ciencias Administrativas</option>
                            <option class="reg" value="Coordinacion">Control Escolar</option>
                            <option class="reg" value="Secretaria">Nose</option>            
                        </select><br><br>
                        <label class="fe">Fecha de Nacimiento</label>
                        <input class="na" type="date" name="natalicio" '.($campo['natalicioA']).' class="CajasL" value="'.($campo	['natalicioA']).'" required><br><br>
                        <label class="tttel"> Telefono Emergencia</label>
                            <input class="reg" type="number" name="telefonoE"placeholder="10 Digitos" '.($campo	['telefonoEa']).' min="10" value="'.($campo	['telefonoEa']).'" required><br><br>                        							
							
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
				$Domicilio = $_POST['direccion'];
				$Telefono = $_POST['telefono'];		
				$Tel_Emg = $_POST['telefonoE'];				
				$Correo = $_POST['correo'];	
                $Cargo = $_POST['cargo'];
                $Area = $_POST['area'];

				$conexion=mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
				mysqli_select_db($conexion, "sagadb");		
					
				$Resultado = mysqli_query($conexion, "UPDATE `administrativo` SET  `nombreAa` = '$Nombre', `apellidoPa` = '$ApellidoP', `apellidoM` = '$ApellidoM', `natalicioA` = '$FechaNac', `edadA` = '$Edad', `direccionA` = '$Domicilio', `telefonoA` = '$Telefono', `telefonoEa` = '$Tel_Emg', `correoA` = '$Correo', `cargoA` = '$Cargo', `areaA` = '$Area' WHERE `id_admin` = '$id';");	

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
					echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=consulta_administrativo.php">';
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
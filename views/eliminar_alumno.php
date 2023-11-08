<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/eliminar.css">
	<link rel="shortcut icon" href="../assets/img/icon.png">
	<link rel="stylesheet" href="../css/diseño_movil.css">
	<title>Eliminar Alumnos</title>
</head>
<body>
    
    <head>
        <h1>Eliminar Alumnos</h1>
    </head>    	
	<form class="registro" id="registro" action="eliminar_alumno.php" method="POST">   	
		<div id="Botones">			                                                           
			<label>Matricula del Alumno</label>
			<input class="materias" type="text" name="id" placeholder="Ingrese Matricula">
			<input type="submit" class="busqueda" name="buscar" value="Buscar">			
		
			<img src="../assets/img/img2.png" style="width: 100%;" />  
			<a href="consultar_alumnos.php"><input class="btnconsulta" name="Consultar" type="button" id="btnSalir" value="Consultar y Actualizar"></a>          
			<br><a href="registro_alumnos.html"><input class="btnconsulta" name="Consultar" type="button" id="btnSalir" value="Registrar"></a>
			<br><br><br><a href="../index_administrativo.php"><input class="btnsalir" name="Salir" type="button" id="btnSalir" value="Salir"></a>
			<img src="../assets/img/img3.png" style="width: 100%;" />		
		</div>		
	
		<?php			
			if (isset($_POST['buscar'])) {
				$matricula_a = $_POST['id'];                    				
				
				include '../php/conexion.php';
				mysqli_select_db($conexion, "sagadb");
				
				$resultado = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `id_alumno` = '$matricula_a';");

				while ($campo = mysqli_fetch_array($resultado)) {
					echo '
					<div id="Campos">
					    <table class="tabla">
					    <th><h2>Eliminar al Alumno</h2></th>
                            <input type="hidden" name="id" value="'.($campo['id_alumno']).'">
                            <td><h4>'.(implode(" ", [$campo['nombre'], $campo['apellidoP'], 	$campo['apellidoM']])).'</h4><td>
							
                        <th><br><br><input type="submit" name="eliminar" value="Eliminar"></th>
					</div>					  
					';                            
				}
				mysqli_close($conexion);
			}                    
			else if (isset($_POST['eliminar'])) {		
				$id = $_POST['id'];								

				include '../php/conexion.php';
				mysqli_select_db($conexion, "sagadb");		
				
				$Resultado = mysqli_query($conexion, "DELETE FROM `alumnos` WHERE `id_alumno` = '$id';");	

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
							<div class="loader-message">Eliminando Datos...</div>
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
					echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=eliminar_alumno.php">';
				}		
				else  {
					echo "Error Matricula esa Matricula no Existe";
				}
			}			
		?>                            
            </table>
		</form><br>	            	     			
</body>
<footer>
<?php include '../php/footerG.php';?>
</footer>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/contactos_tutores.css">
	<link rel="shortcut icon" href="../assets/img/icon.png">
	<title>Contacto a Tutores</title>
</head>
<body>
	<header>
		<nav>
            <ul class="menu">          
                <li><a href="../index_administrativo.php">Inicio</a></li>                                                      
                <li class="dropdown">                    
                    <button class="dropbtn">Horarios</button>
                    <div class="dropdown-content">
                        <a href="asignar_horarios_alumnos.php">Asignar Horarios</a>
                        <a href="consultar_horarios.php">Consulta Horarios</a>                      
                    </div>
                </li>                   
                <li class="dropdown">
                    <button class="dropbtn">Captura Calificaciones</button>
                    <div class="dropdown-content">
                      <a href="modificar_calificacion.php">Modificar Calificacion</a>
                      <a href="capturar_calif_definitiva.php">Captura Trimestral</a>                      
                    </div>
                </li>       
                <li class="dropdown">
                    <button class="dropbtn">Materias</button>
                    <div class="dropdown-content">
                      <a href="asignar_materia.php">Asignar Materias</a>
                      <a href="modificar_materias.php">Modificar Materias</a>                      
                    </div>
                </li>       
                <li class="dropdown">
                    <button class="dropbtn">Subir Grado</button>
                    <div class="dropdown-content">                    
                      <a href="subir_grado.php">Aumentar Grado</a>
                      <a href="lista_reprobados.php">Lista Reprobados</a>
                      <a href="lista_egresados.php">Lista Egresados</a>
                    </div>
                </li>                                               
                <li class="dropdown">
                    <button class="dropbtn">Estadisticas Alumnos</button>
                    <div class="dropdown-content">
                      <a href="estadisticas_alumno.php">Alumno</a>
                      <a href="estadistica_grupal.php">Grupal</a>                      
                    </div>
                </li>        
                <li class="dropdown">
                    <button class="dropbtn">Perfiles</button>
                    <div class="dropdown-content">
                      <a href="registro_alumnos.html">Registro Alumnos</a>
                      <a href="registro_docentes.html">Registro Docentes</a>
                      <a href="registro_administrativo.html">Registro Administrativo</a>
                      <a href="lista_perfiles.php">Lista Perfiles</a>
                    </div>
                </li>   
                <li class="dropdown">
                    <button class="dropbtn">Incidencias</button>
                    <div class="dropdown-content">
                      <a href="incidencias.php">Registro Incidencias</a>
                      <a href="lista_incidencias.php">Lista de Incidencias</a>                      
                    </div>
                </li>                                                              
                <li><a href="../php/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>            
        </nav> 
	</header>
	<head>		
		<br><br><label>Alumno: </label>
		<form method="POST" action="contactos_tutores.php">
			<input type="text" name="contactos" placeholder="Ingrese la Matricula del Alumno">
			<input type="submit" value="Buscar">
		</form>
	</head>

	<table class="contacto_tutores">
		<h4>Informacion</h4>		

		<?php
			//Recibir los datos del buscador
			if ($_POST) {
				$matricula = $_POST['contactos'];		

				//Conexion a la BD
				include '../php/conexion.php';
				mysqli_select_db($conexion, "sagadb");

				//Realizamos consulta
				$resultado = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `id_alumno` = '$matricula' LIMIT 1;");

				$campo = mysqli_fetch_array($resultado);
				echo '
				<tr>							
					<th>Nombre Tutor</th>					
						<td>'.($campo['tutor']).'</td>							
					<th>Telefono</th>			
						<td>'.($campo['telefono']).'</td>						
				</tr>
				<tr>
					<th>Domicilio</th>
						<td>'.($campo['domicilio']).'</td>
					<th>Correo</th>
						<td>'.($campo['correo']).'</td>
				</tr>  
				';                            
			}
    		?>  
	</table>
</body>
	<footer>
  		<p>&copy; 2023 SAGA.</p>
  		<p>Contáctanos: info@example.com</p>
	</footer>
</html>
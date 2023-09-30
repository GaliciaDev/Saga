<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="shortcut icon" href="assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Index Administrativo</title>
    </head> 
<body>
    <header>
        <nav>
            <ul class="menu">                                                                
                <li class="dropdown">                    
                    <button class="dropbtn">Horarios</button>
                    <div class="dropdown-content">
                        <a href="views/asignar_horarios_alumnos.php">Asignar Horarios</a>
                        <a href="views/consultar_horarios.php">Consulta Horarios</a>                      
                    </div>
                </li>                   
                <li class="dropdown">
                    <button class="dropbtn">Captura Calificaciones</button>
                    <div class="dropdown-content">
                      <a href="views/modificar_calificacion.php">Modificar Calificacion</a>
                      <a href="views/capturar_calif_definitiva.php">Captura Trimestral</a>                      
                    </div>
                </li>       
                <li class="dropdown">
                    <button class="dropbtn">Materias</button>
                    <div class="dropdown-content">
                      <a href="views/asignar_materia.php">Asignar Materias</a>
                      <a href="views/modificar_materias.php">Modificar Materias</a>                      
                    </div>
                </li>                                          
                <li class="dropdown">
                    <button class="dropbtn">Estadisticas Alumnos</button>
                    <div class="dropdown-content">
                      <a href="views/estadisticas_alumno.php">Alumno</a>
                      <a href="views/estadistica_grupal.php">Grupal</a>                      
                    </div>
                </li>        
                <li class="dropdown">
                    <button class="dropbtn">Registro</button>
                    <div class="dropdown-content">
                      <a href="views/registro_alumnos.html">Registro Alumnos</a>
                      <a href="views/registro_docentes.html">Registro Docentes</a>
                      <a href="views/registro_administrativo.html">Registro Administrativo</a>
                    </div>
                </li>                 
                <li><a href="views/contactos_tutores.php">Contacto Tutores</a></li>                    
                <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>            
        </nav>        
    </header>
    
    <br><br><label>En base al login direccione este index: </label>
		<form method="POST" action="index_administrativo.php">
			<input type="text" name="index" placeholder="Ingrese su Matricula">
			<input type="submit" value="Buscar">
		</form>

    <table class="tabla_informacion">                    
        <tr>
            <h2>Informacion General</h2>
            <?php
			//Recibir los datos del buscador
			if ($_POST) {
				$matricula = $_POST['index'];		

				//Conexion a la BD
				$conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
				mysqli_select_db($conexion, "sagadb");

				//Realizamos consulta
				$resultado = mysqli_query($conexion, "SELECT * FROM `administrativo` WHERE `id_admin` = '$matricula' LIMIT 1;");

				$campo = mysqli_fetch_array($resultado);
				echo '
				<tr>
                    <th rowspan="2"><img src=" assets/img/img3.png" alt="MDN"></th>							
					<th>Nombre</th>					
                    <td>'.(implode([$campo['nombreAa'], $campo['apellidoPa'], $campo['apellidoM']])).'</td>					
					<th>Matricula</th>			
						<td>'.($campo['id_admin']).'</td>	    
                    <th>Cargo</th>					
                        <td>'.($campo['cargoA']).'</td>
				</tr>
				<tr>
					<th>Area</th>
						<td>'.($campo['areaA']).'</td>
					<th>Telefono</th>
						<td>'.($campo['telefonoA']).'</td>
                    <th>Telefono de Emergencias</th>
                        <td>'.($campo['telefonoEa']).'</td>
				</tr>  
				';                            
			}
    		?>     
        </tr>

    </table><br>
</body>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>  
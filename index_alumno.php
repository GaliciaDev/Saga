<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="shortcut icon" href="assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Index del Alumno</title>
    </head>
<body>
    <header>
        <nav>
            <ul class="menu">                                                
                <li><a href="views/consultar_horario_alumnos.php">Horario</a></li>
                <li><a href="views/tira_materias_alumno.php">Tira Materias</a></li>                
                <li><a href="views/calificaciones_alumno.php">Calificaciones</a></li>                
                <li><a href="views/kardex.php">Estadisticas</a></li>                                
                <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>
        </nav>
    </header>

    <br><br><label>En base al login direccione este index: </label>
		<form method="POST" action="index_alumno.php">
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
				$resultado = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `id_alumno` = '$matricula' LIMIT 1;");

				$campo = mysqli_fetch_array($resultado);
				echo '
				<tr>
                    <th rowspan="2"><img src="assets/img/img3.png" alt="MDN"></th>			
                    <th>Matricula</th>				
                        <td>'.($campo['id_alumno']).'</td>
					<th>Nombre</th>					
                        <td>'.(implode(" ", [$campo['nombre'], $campo['apellidoP'], $campo['apellidoM']])).'</td>					
					<th>Correo</th>			
						<td>'.($campo['correo']).'</td>	                    
				</tr>
				<tr>
					<th>Grado y Grupo</th>
						<td>'.(implode(" ",[$campo['grado'], $campo['grupo']])).'</td>
					<th>Telefono</th>
						<td>'.($campo['telefono']).'</td>
                    <th>Turno</th>
                        <td>'.($campo['turno']).'</td>
				</tr>  
				';                            
			}
    		?>     
        </tr>

    </table>
</body>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>  
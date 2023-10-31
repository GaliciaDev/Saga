<?php
    include 'php/conexion_be.php';
    include 'php/variabledS.php';
    validarS();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="shortcut icon" href="assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Index del Alumno</title>
    </head>
<body>
    <?php include 'php/navegacion_A.php'; ?>

<<<<<<< HEAD

    <table class="tabla_informacion">                    
        <tr>
            <h2>Informacion General</h2>
            <?php
			$matricula = $_SESSION['alumno'];

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
    		?>     
=======
    <table class="tabla_informacion">                    
        <tr>
            <h2>Información General</h2>
            <?php                        
            $matricula = $_SESSION['usuario'];   
            
             // Incluye la conexión a la base de datos
            $conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
            mysqli_select_db($conexion, "sagadb");

            $resultado = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `id_alumno` = '$matricula' LIMIT 1;");

            $campo = mysqli_fetch_array($resultado);
            echo '
            <tr>
                <th rowspan="2"><img src="assets/img/img3.png" alt="MDN"></th>			
                <th>Matrícula</th>				
                    <td>' . ($campo['id_alumno']) . '</td>
                <th>Nombre</th>					
                    <td>'.($campo['nombre']). ' ' .($campo['apellidoP']). ' ' .($campo['apellidoM']).'</td>
                <th>Correo</th>			
                    <td>' . ($campo['correo']) . '</td>	                    
            </tr>
            <tr>
                <th>Grado y Grupo</th>
                    <td>' . ($campo['grado']. ' ' .($campo['grupo'])) . '</td>
                <th>Telefono</th>
                    <td>' . ($campo['telefono']) . '</td>
                <th>Turno</th>
                    <td>' . ($campo['turno']) . '</td>
            </tr>
            ';                            
            ?>
>>>>>>> fcad9cc (lista perfiles y modificacion variables de sesion de horarios)
        </tr>
    </table><br><br>
</body>
<?php include 'php/footerG.php'; ?>
</html>
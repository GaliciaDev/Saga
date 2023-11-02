<?php
    include 'php/variabledS.php';
    include 'php/conexion.php';
    validarSad();
?>

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
                    <button class="dropbtn">Subir Grado</button>
                    <div class="dropdown-content">                    
                      <a href="views/subir_grado.php">Aumentar Grado</a>
                      <a href="views/lista_reprobados.php">Lista Reprobados</a>
                      <a href="views/lista_egresados.php">Lista Egresados</a>
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
                    <button class="dropbtn">Perfiles</button>
                    <div class="dropdown-content">
                      <a href="views/registro_alumnos.html">Registro Alumnos</a>
                      <a href="views/registro_docentes.html">Registro Docentes</a>
                      <a href="views/registro_administrativo.html">Registro Administrativo</a>
                      <a href="views/lista_perfiles.php">Lista Perfiles</a>
                    </div>
                </li>   
                <li class="dropdown">
                    <button class="dropbtn">Incidencias</button>
                    <div class="dropdown-content">
                      <a href="views/incidencias.php">Registro Incidencias</a>
                      <a href="views/lista_incidencias.php">Lista de Incidencias</a>                      
                    </div>
                </li>                                
                <li><a href="views/contactos_tutores.php">Contacto Tutores</a></li>                    
                <li><a href="php/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>            
        </nav>        
    </header>    
        <br><br><table class="tabla_informacion">                    
        <tr>
            <h2>Información General</h2>
            <?php
            // Obtén la matrícula del administrador desde la variable de sesión
            $matricula = $_SESSION['admin'];
            
            // Realiza consulta
            $resultado = mysqli_query($conexion, "SELECT * FROM `administrativo` WHERE `id_admin` = '$matricula' LIMIT 1;");

            $campo = mysqli_fetch_array($resultado);
            echo '
            <tr>
                <th rowspan="2"><img src="assets/img/img3.png" alt="MDN"></th>
                <th>Nombre</th>
                <td>'.($campo['nombreAa']). ' ' .($campo['apellidoPa']). ' ' .($campo['apellidoM']).'</td>
                <th>Matricula</th>
                <td>'.($campo['id_admin']).'</td>
                <th>Cargo</th>
                <td>'.($campo['cargoA']).'</td>
            </tr>

            <tr>
                <th>Area</th>
                <td>' . ($campo['areaA']) . '</td>
                <th>Telefono</th>
                <td>' . ($campo['telefonoA']) . '</td>
                <th>Telefono de Emergencias</th>
                <td>' . ($campo['telefonoEa']) . '</td>
            </tr>
            ';                            
            ?>
        </tr>
    </table><br><br><br>
</body>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>  
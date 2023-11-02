<?php
    include '../php/variabledS.php';
    validarSad();

    include '../php/conexion.php';
    $consultaUsuarios = "SELECT * FROM `alumnos`";
    $resultadoUsuarios = mysqli_query($conexion, $consultaUsuarios);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/perfiles.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Perfiles</title>
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
                    </div>
                </li>   
                <li class="dropdown">
                    <button class="dropbtn">Incidencias</button>
                    <div class="dropdown-content">
                      <a href="incidencias.php">Registro Incidencias</a>
                      <a href="lista_incidencias.php">Lista de Incidencias</a>                      
                    </div>
                </li>                                
                <li><a href="contactos_tutores.php">Contacto Tutores</a></li>                    
                <li><a href="../php/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>            
        </nav>        
    </header>    
        <h2>Usuarios Alumnos</h2>
        <div id="Botones">
            <a href="lista_perfiles_D.php"><button>Perfiles Docentes</button></a>
            <a href="lista_perfiles.php"><button>Perfiles Administrativos</button></a>
        </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Grado</th>                    
                    <th>Grupo</th>
                    <th>Turno</th>
                    <th>Periodo</th>
                    <th>Acciones</th>
                </tr>
                <?php
                while ($fila = mysqli_fetch_assoc($resultadoUsuarios)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_alumno'] . "</td>";
                    $nombreCompleto = implode(' ', [$fila['nombre'], $fila['apellidoP'], $fila['apellidoM']]);
                    echo "<td>" . $nombreCompleto . "</td>";
                    echo "<td>" . $fila['correo'] . "</td>";
                    echo "<td>" . $fila['telefono'] . "</td>";
                    echo "<td>" . $fila['domicilio'] . "</td>";
                    echo "<td>" . $fila['grado'] . "</td>";
                    echo "<td>" . $fila['grupo'] . "</td>";
                    echo "<td>" . $fila['turno'] . "</td>";
                    echo "<td>" . $fila['periodo'] . "</td>";
                    echo "<td><a href='consultar_alumnos.php?id=" . $fila['id_alumno'] . "'>Ver Mas...</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
</body>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>  
<?php
    include '../php/variabledS.php';
    validarSad();

    include '../php/conexion.php';

    // Consulta para obtener las incidencias desde la base de datos
    $consultaIncidencias = "SELECT * FROM `incidenciasalumnos`";
    $resultadoIncidencias = mysqli_query($conexion, $consultaIncidencias);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idIncidencia = $_POST['id'];
        
        if (isset($_POST['marcarSolucionada'])) {
            // Actualiza el valor de "resuelta" a 1 en la base de datos para marcar como resuelta
            $consulta = "UPDATE incidenciasalumnos SET resuelta = 1 WHERE id = $idIncidencia";
            
            if (mysqli_query($conexion, $consulta)) {
                http_response_code(200); // Respuesta exitosa
            } else {
                http_response_code(500); // Error del servidor
            }
        } elseif (isset($_POST['eliminarIncidencia'])) {
            // Eliminar la incidencia de la base de datos
            $consulta = "DELETE FROM incidenciasalumnos WHERE id = $idIncidencia";
            
            if (mysqli_query($conexion, $consulta)) {
                http_response_code(200); // Respuesta exitosa
            } else {
                http_response_code(500); // Error del servidor
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo_incidencias.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Lista Incidencias</title>
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
                      <a href="lista_perfiles.php">Lista Perfiles</a>
                    </div>
                </li>   
                <li><a href="incidencias.php">Registro Incidencias</a></li>                                
                <li><a href="contactos_tutores.php">Contacto Tutores</a></li>                    
                <li><a href="../php/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>            
        </nav>        
    </header>    
    <h2>Lista de Incidencias</h2>
    <table class="tabla_informacion">
        <tr>
            <th>ID</th>
            <th>Alumno</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Resuelta</th>
            <th>Acciones</th>
        </tr>
        <?php
            while ($fila = mysqli_fetch_assoc($resultadoIncidencias)) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['responsable'] . "</td>";
                echo "<td>" . $fila['tipo_incidencia'] . "</td>";
                echo "<td>" . $fila['descripcion'] . "</td>";
                echo "<td>" . ($fila['resuelta'] == 1 ? 'Resuelta' : 'Sin resolver') . "</td>";
                echo "<td>";
                echo "<form method='post' action='lista_incidencias.php'>";
                echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>";
                echo "<input type='submit' name='marcarSolucionada' value='Marcar como Solucionada'>";
                echo " &ensp; &ensp;<input type='submit' name='eliminarIncidencia' value='Eliminar'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        ?>
        <script>
            function marcarSolucionada(idIncidencia) {
            // Realiza una solicitud AJAX para marcar la incidencia como resuelta
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'marcar_resuelta.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Recarga la página después de marcar como resuelta
                    location.reload();
                }
            };
            xhr.send('id=' + idIncidencia);
            echo '<meta http-equiv="refresh" content="0.5; url=../views/lista_incidencias.php">';
        }

        function eliminarIncidencia(idIncidencia) {
            // Realiza una solicitud AJAX para eliminar la incidencia
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'eliminar_incidencia.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Recarga la página después de eliminar la incidencia
                    location.reload();
                }
            };
            xhr.send('id=' + idIncidencia);
            echo '<meta http-equiv="refresh" content="0.5; url=../views/lista_incidencias.php">';
        }
        </script>        
    </table>
</body>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>  
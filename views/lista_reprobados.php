<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo_lista_reprobados.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Lista de Reprobados</title>
    </head> 
<body>
    <header>
        <nav>
            <ul class="menu">       
                <li><a href="../index_administrativo.php">Inicio</a></li>                                                         
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
                <li><a href="subir_grado.php">Aumentar Grado</a></li>                
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
    <!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo_lista_reprobados.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Lista de Reprobados</title>
    </head> 
<body>
    
    <h2><center>Alumnos Reprobados</center></h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Alumnos</th>
            <th>Edad</th>
            <th>Tutor</th>
            <th>Correo</th>
            <th>Grado</th>
            <th>Grupo</th>
            <th>Turno</th>
            <th>Periodo</th>
            <th>Promedio</th>
        </tr>
    <?php
        // Establece la conexión a la base de datos (ajusta la configuración según tus necesidades)
        include '../php/conexion_be.php';

        // Verifica la conexión
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Consulta SQL para obtener los datos de los alumnos con promedio menor o igual a 60
        $sql = "SELECT A.id_alumno, CONCAT(A.nombre, ' ', A.apellidoP, ' ', A.apellidoM) AS nombre_completo, A.edad, A.tutor, A.correo, A.grado, A.grupo, A.turno, A.periodo, AVG(C.calificacion) AS promedio
                FROM alumnos A
                LEFT JOIN calificaciones C ON A.id_alumno = C.id_alumno
                GROUP BY A.id_alumno
                HAVING promedio <= 60
                ORDER BY A.grado, A.id_alumno";

        $result = $conexion->query($sql);

        // Imprimir los datos de los alumnos reprobados
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id_alumno'] . "</td>";
            echo "<td>" . $row['nombre_completo'] . "</td>";
            echo "<td>" . $row['edad'] . "</td>";
            echo "<td>" . $row['tutor'] . "</td>";
            echo "<td>" . $row['correo'] . "</td>";
            echo "<td>" . $row['grado'] . "</td>";
            echo "<td>" . $row['grupo'] . "</td>";
            echo "<td>" . $row['turno'] . "</td>";
            echo "<td>" . $row['periodo'] . "</td>";
            echo "<td>" . $row['promedio'] . "</td>";
            echo "</tr>";
        }

        // Cierra la conexión a la base de datos
        $conexion->close();
    ?>
    </table>
</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/consulta_horarios.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">  
    <title>Consulta de Horarios</title>
</head>
<body>
    <header>
    <nav>
            <ul class="menu">           
                <li><a href="../index_administrativo.php">Inicio</a></li>                                                                     
                <li><a href="views/asignar_horarios_alumnos.php">Asignar Horarios</a></li>
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
                    <button class="dropbtn">Estadisticas Alumnos</button>
                    <div class="dropdown-content">
                      <a href="estadisticas_alumno.php">Alumno</a>
                      <a href="estadistica_grupal.php">Grupal</a>                      
                    </div>
                </li>        
                <li class="dropdown">
                    <button class="dropbtn">Registro</button>
                    <div class="dropdown-content">
                      <a href="registro_alumnos.html">Registro Alumnos</a>
                      <a href="registro_docentes.html">Registro Docentes</a>
                      <a href="registro_administrativo.html">Registro Administrativo</a>
                    </div>
                </li>                 
                <li><a href="contactos_tutores.php">Contacto Tutores</a></li>                    
                <li><a href="../php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>            
        </nav> 
    </header>
    <h1>Consulta de Horarios</h1>                        
    <table class="tabla">        
        <tr>
            <th>Grado y Grupo</th>
            <th>Día</th>            
            <th>Horario</th>
            <th>Materia</th>
            <th>Salón</th>
            <th>Profesor</th>
            <th>Turno</th>
            <th>Acciones</th>
        </tr>

        <?php
        $servername = "localhost"; // Cambia localhost por el servidor de tu base de datos
        $username = "DBA-Saga";
        $password = "srvtySDL&";
        $dbname = "sagadb"; // Nombre de la base de datos

        // Crear una conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta SQL para obtener los datos de la tabla 'horarios'
        $sql = "SELECT grado_grupo, Dias, Materias, Docentes, Hora, Aula, id_horario, Turno FROM horarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los datos en la tabla
            while ($row = $result->fetch_assoc()) {
                $hora = $row["Hora"];
                $turno = $row["Turno"];

                echo "<tr>";
                echo "<td>" . $row["grado_grupo"] . "</td>";
                echo "<td>" . $row["Dias"] . "</td>";
                echo "<td>" . $hora . "</td>";
                echo "<td>" . $row["Materias"] . "</td>";
                echo "<td>" . $row["Aula"] . "</td>";
                echo "<td>" . $row["Docentes"] . "</td>";
                echo "<td>" . $turno . "</td>";
                echo "<td>";
                echo "<button class='eliminar' onclick=\"eliminarFila('" . $row['id_horario'] . "')\">Eliminar</button>";
                echo "<button class='modificar' onclick=\"modificarFila('" . $row['id_horario'] . "')\">Modificar</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "No se encontraron resultados.";
        }

        $conn->close();
        ?>

    </table><br>                   

    <script>
function eliminarFila(id) {
    if (confirm("¿Estás Seguro De Eliminar Estos Datos?")) {
        // Crear un objeto XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Configurar una solicitud POST al script PHP que manejará la eliminación
        xhr.open("POST", "../php/eliminar_fila.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Definir la función de callback para manejar la respuesta del servidor
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // La solicitud se completó y el servidor respondió correctamente
                // Aquí puedes manejar la respuesta del servidor, si es necesario
                alert(xhr.responseText); // Esto mostrará el mensaje del servidor en una alerta
            }
        };

        // Preparar los datos que se enviarán al servidor
        var datos = "id=" + encodeURIComponent(id);

        // Enviar la solicitud al servidor
        xhr.send(datos);
    }
}

function modificarFila(id) {
    if (confirm("¿Deseas Modificar Estos Datos?")) {
        // Redirigir al usuario a la página de formulario de actualización
        window.location.href = "../php/actualizar_fila.php?id=" + encodeURIComponent(id);

        window.location.href = url;
    }
}

</script>

</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
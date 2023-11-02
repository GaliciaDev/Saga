<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilo_modificar_materia.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">  
    <title>Modificar Calificaciones</title>
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
                <li><a href="modificar_materias.php">Modificar Materias</a></li>       
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
<body>
<h1>Tabla de Materias</h1>

<?php
// Conexión a la BD
include '../php/conexion.php';
mysqli_select_db($conexion, "sagadb");

// Función para generar la tabla de materias
function generarTablaMaterias($id, $materia, $horas_clases, $docente) {
    echo '<tr>';
    echo '<td><h2>' . $materia . '</h2></td>';
    echo '<td><h2>' . $horas_clases . '</h2></td>';
    echo '<td><h2>' . $docente . '</h2></td>';
    echo '<td><a href="../php/editar_materia.php?id=' . $id . '"><h2 class="editar">Editar</h2></a></td>';
    echo '<td><a href="../php/eliminar_materia.php?id=' . $id . '"><h2 class="editar">Eliminar</h2></a></td>';
    echo '</tr>';    
}

// Procesar formularios de edición o eliminación
if ($_POST) {
    if (isset($_POST['editar'])) {
        $ids = $_POST['id'];
        $materias = $_POST['materia'];
        $horas_clases = $_POST['horas_clases'];
        $docentes = $_POST['docente'];

        // Iterar a través de los registros para actualizar en la base de datos
        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $materia = $materias[$i];
            $horas_clase = $horas_clases[$i];
            $docente = $docentes[$i];

            // Actualizar los datos en la base de datos
            $query_actualizar = "UPDATE tira_materias SET Materias = '$materia', Horas_Clases = '$horas_clase', docente = '$docente' WHERE id = '$id'";
            mysqli_query($conexion, $query_actualizar);
        }

        echo 'Los cambios se han guardado correctamente.';
    } elseif (isset($_POST['eliminar'])) {
        $id = $_POST['id'];

        // Eliminar el registro de la base de datos
        $query_eliminar = "DELETE FROM tira_materias WHERE id = '$id'";
        mysqli_query($conexion, $query_eliminar);

        echo 'El registro se ha eliminado correctamente.';
    }
}

// Consulta para obtener los datos de la tabla tira_materias
$consulta_materias = "SELECT * FROM tira_materias";
$resultado_materias = mysqli_query($conexion, $consulta_materias);

if (mysqli_num_rows($resultado_materias) > 0) {
    echo '<form method="POST">';
    echo '<table>';
    echo '<tr>';
    echo '<th>Materia</th>';
    echo '<th>Horas de Clases</th>';
    echo '<th>Docente</th>';
    echo '<th></th>';
    echo '<th></th>';
    echo '</tr>';

    while ($fila = mysqli_fetch_assoc($resultado_materias)) {
        generarTablaMaterias($fila['id'], $fila['Materias'], $fila['Horas_Clases'], $fila['docente']);
    }

    echo '</table>';
    echo '<br><input type="submit" name="editar" value="Guardar Cambios"><br><br>';
    echo '</form>';
}
?>
</body>
<style>
    table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

input[type="text"],
select {
    width: 80%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

a.editar,
a.eliminar {
    padding: 5px 10px;
    background-color: black;
    color: #fff;
    text-decoration: none;
}

a.editar:hover,
a.eliminar:hover {
    background-color: #333;
}

</style>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/modificar_materia.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">  
    <title>Modificar Calificaciones</title>
</head>
<body>
<header>
        <nav>
            <ul class="menu">                                                                
                <li class="dropdown">
                    <li><a href="../index_administrativo.php">Inicio</a></li>
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
                      <a href="capturar_calif_definitiva.php">Calificacion Trimestral</a>                      
                    </div>
                </li>       
                <li><a href="asignar_materia.php">Asignar Materias</a></li>                                         
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
                <li><a href="apoyo.html">Apoyo Tecnico</a></li>
                <li><a href="php/cerrarsesion.php">Cerrar Sesion</a></li>
            </ul>            
        </nav>        
    </header>
    <body>
    <h1>Tabla de Materias</h1>

<?php
// Conexión a la BD
$conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
mysqli_select_db($conexion, "sagadb");

// Función para generar la tabla de materias
function generarTablaMaterias($id, $materia, $horas_clases, $docente) {
    echo '<tr>';
    echo '<td><input type="hidden" name="id[]" value="'. $id .'"><input type="text" name="materia[]" value="'. $materia .'"></td>';
    echo '<td><select name="horas_clases[]">';
    echo '<option value="5" '.($horas_clases == '5' ? 'selected' : '').'>5 Hrs.</option>';
    echo '<option value="4" '.($horas_clases == '4' ? 'selected' : '').'>4 Hrs</option>';
    echo '<option value="3" '.($horas_clases == '3' ? 'selected' : '').'>3 Hrs</option>';
    echo '</select></td>';
    echo '<td><input type="text" name="docente[]" value="'. $docente .'"></td>';
    echo '<td><button type="button" class="editar" data-id="' . $id . '">Editar</button></td>';
    echo '<td><button type="button" class="eliminar" data-id="' . $id . '">Eliminar</button></td>';
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
    echo '<th>Editar</th>';
    echo '<th>Eliminar</th>';
    echo '</tr>';

    while ($fila = mysqli_fetch_assoc($resultado_materias)) {
        generarTablaMaterias($fila['id'], $fila['Materias'], $fila['Horas_Clases'], $fila['docente']);
    }

    echo '</table>';
    echo '<input type="submit" name="editar" value="Guardar Cambios">';
    echo '</form>';
}
?>

<script>
    // JavaScript para manejar la edición y eliminación de registros
    document.addEventListener('DOMContentLoaded', function() {
        const editarBotones = document.querySelectorAll('.editar');
        const eliminarBotones = document.querySelectorAll('.eliminar');

        editarBotones.forEach(boton => {
            boton.addEventListener('click', function() {
                // Aquí puedes implementar la lógica para mostrar campos de edición y enviar cambios al servidor
                const id = boton.getAttribute('data-id');
                alert('Editar registro con id: ' + id);
            });
        });

        eliminarBotones.forEach(boton => {
            boton.addEventListener('click', function() {
                // Aquí puedes implementar la lógica para eliminar el registro del servidor
                const id = boton.getAttribute('data-id');
                alert('Eliminar registro con id: ' + id);
            });
        });
    });
</script>
</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
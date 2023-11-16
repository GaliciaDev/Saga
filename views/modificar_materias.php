<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/modificar_materias.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">  
    <link rel="stylesheet" href="../css/diseño_movil.css">
    <title>Modificar Calificaciones</title>
</head>
<body>
<?php include '../php/nav_Admin.php'; ?>
<body>
<br><h1>Tabla de Materias</h1>

<?php
// Conexión a la BD
include '../php/conexion.php';

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
    echo '<center><table>';
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

    echo '</table></center>';
        echo '</form>';
}
?>
</body>
<style>

.tabla_informacion {
    border-collapse: collapse;
    width: 100%;
    text-align: center;    
}

.tabla_informacion th, .tabla_informacion td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;    
}

td {
    text-align: center;
}

.tabla_informacion th {
    background-color: #f2f2f2;
    text-align: center;
}

.tabla_informacion tr:hover {
    background-color: #f5f5f5;
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
<?php include '../php/footerG.php';?>
</footer>
</html>
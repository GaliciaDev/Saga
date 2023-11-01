<?php
include '../php/variabledS.php';
validarS();

include '../php/conexion.php';

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$matricula = $_SESSION['alumno'];

// Consulta SQL para obtener el grado, grupo y turno del alumno
$sql = "SELECT grado, grupo, turno FROM alumnos WHERE id_alumno = '$matricula'";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $grupo = $row['grado'] . '' . $row['grupo'];
    $turno = $row['turno'];
} else {
    $grupo = '';
    $turno = '';
}

// Consulta SQL para obtener los horarios del grupo del alumno
$sql = "SELECT * FROM horarios WHERE grado_grupo = '$grupo'";
$result = $conexion->query($sql);

// Crear un array para almacenar los datos de los horarios
$horarios = array();
while ($row = $result->fetch_assoc()) {
    $horarios[] = $row;
}

$conexion->close();
?>
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
            <li><a href="../index_alumno.php">Inicio</a></li>
            <li><a href="tira_materias_alumno.php">Tira Materias</a></li>
            <li><a href="calificaciones_alumno.php">Calificaciones</a></li>
            <li><a href="views/kardex.php">Kardex</a></li>
            <li><a href="../php/cerrarsesion.php">Cerrar Sesion</a></li>
        </ul>
    </nav>
</header>
<h1>Horario de Alumno</h1>

<?php
// Verificar si se encontraron horarios para el grupo
if (!empty($horarios)) {
    // Crear una matriz para almacenar los horarios organizados por día y hora
    $horarios_organizados = array(
        'Lunes' => array(),
        'Martes' => array(),
        'Miércoles' => array(),
        'Jueves' => array(),
        'Viernes' => array()
    );

    // Organizar los horarios en la matriz
    foreach ($horarios as $horario) {
        $dia = $horario['Dias'];
        $hora = $horario['Hora'];
        $materia = $horario['Materias'];
        $docente = $horario['Docentes'];
        $aula = $horario['Aula'];
        $horarios_organizados[$dia][$hora] = array(
            'materia' => $materia,
            'docente' => $docente,
            'aula' => $aula
        );
    }

    // Lógica para ocultar horarios según el turno
    $horas_mostradas = array(
        '7:00 - 7:45',
        '7:45 - 8:30',
        '8:30 - 9:15',
        '9:15 - 10:00',
        '10:30 - 11:15',
        '11:15 - 12:00',
        '12:00 - 12:45',
        '12:45 - 1:30',
        '2:00 - 2:45',
        '2:45 - 3:30',
        '3:30 - 4:15',
        '4:15 - 5:00',
        '5:30 - 6:15',
        '6:15 - 7:00',
        '7:00 - 7:45',
        '7:45 - 8:30'
    );

    // Filtrar las clases según el turno
    if ($turno === 'Matutino') {
        $horas_mostradas = array_slice($horas_mostradas, 0, 8); // Ocultar después de 1:30 PM
    } else {
        $horas_mostradas = array_slice($horas_mostradas, 8); // Ocultar antes de las 2:00 PM
    }
    
    // Imprimir la tabla de horarios organizados de manera vertical
    echo '<table class="tabla">';
    echo '<tr><th></th><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th></tr>';
    foreach ($horas_mostradas as $hora) {
        echo '<tr>';
        echo '<td>' . $hora . '</td>';
        foreach ($horarios_organizados as $dia => $horas) {
            echo '<td>';
            if (isset($horas[$hora])) {
                $horario = $horas[$hora];
                echo 'Materia: ' . $horario['materia'] . '<br>';
                echo 'Docente: ' . $horario['docente'] . '<br>';
                echo 'Aula: ' . $horario['aula'] . '<br>';
            }
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    $id = $_SESSION['alumno'];
    echo '<br><a target="_blank" href="../php/imprimir_horario_alumno.php?id_alumno='.$id.'"><button class="btnguardar">Imprimir PDF</button></a><br><br>';
} else {
    echo 'No se encontraron horarios para el grupo del alumno.';
}
?>

</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../css/estadisticas_alumno.css">
	<link rel="shortcut icon" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../css/diseño_movil.css">
	<title>Desempeño Grupal</title>
</head>
<body>	
<?php include '../php/nav_Admin.php'; ?>
	<head>
		<h1>Desenpeño del Grupo</h1>		
	</head>
	<form action="estadistica_grupal.php" method="POST">
		<label>Ingrese un Grupo:</label>
		<input autofocus type="text" name="grupo" placeholder="Ingrese un Grupo" requied>
		<input class="btnguardar" name="Enviar" type="submit" id="btnEnviar" value="Buscar"><br>
		
	<table class="estadisticas_promedio_alumno">				
    <?php
if (isset($_POST['Enviar'])) {
    $grupo = $_POST['grupo'];
    $grado = str_split($grupo);

    include '../php/conexion.php';
    mysqli_select_db($conexion, "sagadb");    

    // Obtener datos de los alumnos del mismo grupo
    $alumnos_query = "SELECT * FROM `alumnos` WHERE `grado` = '$grado[0]' AND `grupo` = '$grado[1]';";
    $alumnos_resultado = mysqli_query($conexion, $alumnos_query);

    echo 'Grado y Grupo: ' . $grado[0] . '' . $grupo[1] . '<br>';

    echo '<table class="estadisticas_promedio_alumno">';
    echo '<h4>Promedio de Materias</h4>';
    echo '<tr>';
    echo '<th>Materias</th>';
    echo '<th>Alumno</th>';
    echo '<th>Promedio</th>';
    echo '<th>Faltas Totales</th>';
    echo '<th>Desempeño</th>';
    echo '</tr>';

    while ($nombreC = mysqli_fetch_array($alumnos_resultado)) {
        $alumno_id = $nombreC['id_alumno'];

        $materias_query = "SELECT `Nom_Materia`, `Promedio_Mat`, `Faltas_1`, `Faltas_2`, `Faltas_3` FROM `materias` WHERE `id_alumno` = '$alumno_id';";
        $materias_resultado = mysqli_query($conexion, $materias_query);

        $total_cal = 0;
        $total_mat = 0;
        $total_faltas = 0;

        while ($campo = mysqli_fetch_array($materias_resultado)) {
            $faltaT = ($campo['Faltas_1'] + $campo['Faltas_2'] + $campo['Faltas_3']);
            $total_faltas += $faltaT;

            $desempeño = "NA";

            if ($campo['Promedio_Mat'] <= 60) {
                $desempeño = 'MALO';
            } elseif ($campo['Promedio_Mat'] <= 70) {
                $desempeño = 'MEDIO';
            } elseif ($campo['Promedio_Mat'] <= 80) {
                $desempeño = 'BUENO';
            } elseif ($campo['Promedio_Mat'] <= 90) {
                $desempeño = 'EXCELENTE';
            } else {
                $desempeño = 'DESTACABLE';
            }

            echo '<tr>';
            echo '<td>' . ($campo['Nom_Materia']) . '</td>';
            echo '<td>' . (implode(' ', [$nombreC['nombre'], $nombreC['apellidoP'], $nombreC['apellidoM']])) . '</td>';
            echo '<td>' . (number_format($campo['Promedio_Mat'], 2)) . '</td>';
            echo '<td>' . $faltaT . '</td>';
            echo '<td>' . $desempeño . '</td>';
            echo '</tr>';

            $total_mat++;
            $total_cal += $campo['Promedio_Mat'];
        }

        // Calcular el promedio general y desempeño general
        $promedio = $total_mat > 0 ? $total_cal / $total_mat : "N/A";
        $desempeño_general = "NA";

        if ($promedio !== "N/A") {
            if ($promedio <= 60) {
                $desempeño_general = 'MALO';
            } elseif ($promedio <= 70) {
                $desempeño_general = 'MEDIO';
            } elseif ($promedio <= 80) {
                $desempeño_general = 'BUENO';
            } elseif ($promedio <= 90) {
                $desempeño_general = 'EXCELENTE';
            } else {
                $desempeño_general = 'DESTACABLE';
            }
        }

        echo '<tr>';
        echo '<td colspan="2"><strong>Promedio General:</strong></td>';
        echo '<td>' . ($promedio !== "N/A" ? number_format($promedio, 2) : $promedio) . '</td>';
        echo '<td>' . $total_faltas . '</td>';
        echo '<td>' . $desempeño_general . '</td>';
        echo '</tr>';
    }

    echo '</table><br>';

    mysqli_close($conexion);

    echo '
    </table><br>
	</form>
    <a target="_blank" href="../php/imprimir_estadisticas_grupales.php?grado='.$grado[0].'&grupo='.$grado[1].'" ><button class="btnguardar">Imprimir PDF</button></a><br><br>';
}
?>
</body>
	<footer>
    <?php include '../php/footerG.php';?>
	</footer>
</html>
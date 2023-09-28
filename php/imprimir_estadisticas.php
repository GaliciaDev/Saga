<?php
/*
 * Generar archivo PDF con las estadísticas individuales
 */

// Comprueba si se ha proporcionado un ID de alumno
if (isset($_GET['id_alumno'])) {
    $id = $_GET['id_alumno']; // Cambia $_POST a $_GET para recibir el ID de alumno

    require('../fpdf/fpdf.php');
    $pdf = new FPDF();

    // Conexion a la BD
    $conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
    mysqli_select_db($conexion, "sagadb");

    // Realizamos consulta con JOIN para obtener datos del alumno y materias
	$alumno = mysqli_query($conexion, "SELECT * FROM `alumnos` WHERE `id_alumno` = '$id';");

	$resultado = mysqli_query($conexion, "SELECT * FROM `materias` WHERE `id_alumno` = '$id';");    

    $campos = mysqli_fetch_array($alumno);

    $nombreCompleto = implode(' ', [$campos['nombre'], $campos['apellidoP'], $campos['apellidoM']]); // Variable para almacenar el nombre completo del alumno

    //Establecer parametros de texto, letras y margenes
    $pdf -> AddPage();
    $pdf -> SetFont('Arial', 'B', 25);
    $pdf -> SetTextColor(0, 0, 0);
    $pdf -> SetFillColor(171, 171, 171);
    $pdf -> SetTitle('ESTADISTICAS ALUMNO');
    $pdf->SetFont('Arial', '', 12);

    //Titulo
    $pdf->Cell(180, 10, 'ESTADISTICAS ALUMNO', 1, 1, 'C', True);

    //DAtos ALumno
    $pdf -> SetXY(10, 25);
    $pdf->Cell(20, 10, 'Matricula: ',0,0,'L',false);
    $pdf->Cell(20, 10, utf8_decode($id),0,0,'L',false);
    $pdf->Cell(30, 10, 'Grado y Grupo: ',0,0,'L',false);
    $pdf->Cell(115, 10, utf8_decode($campos['grado'].$campos['grupo']), 0, 1,'L',false);
    $pdf->Cell(35, 10, 'Nombre Alumno: ', 0, 0, 'L', false);
    $pdf->Cell(145, 10, utf8_decode($nombreCompleto), 0, 1, 'L', false);

    // Encabezado de la tabla
    $pdf->Cell(180, 10, 'Materia', 1, 1, 'C', True);
    $pdf->Cell(30, 10, 'Calificacion 1', 1);
    $pdf->Cell(20, 10, 'Faltas 1', 1);
    $pdf->Cell(30, 10, 'Calificacion 2', 1);
    $pdf->Cell(20, 10, 'Faltas 2', 1);
    $pdf->Cell(30, 10, 'Calificacion 3', 1);
    $pdf->Cell(20, 10, 'Faltas 3', 1);
    $pdf->Cell(30, 10, 'Promedio Mat', 1);
    $pdf->Ln();

    $total_mat = 0;
    $total_cal = 0;

    while ($campo = mysqli_fetch_array($resultado)) {
        $faltaT = $campo['Faltas_1'] + $campo['Faltas_2'] + $campo['Faltas_3'];
        $promedioMat = $campo['Promedio_Mat'];

        $pdf->Cell(180, 10, utf8_decode($campo['Nom_Materia']), 1, 1, 'C' ,True);
        $pdf->Cell(30, 10, number_format($campo['Calificacion_1'], 2), 1, 0, 'C');
        $pdf->Cell(20, 10, $campo['Faltas_1'], 1, 0, 'C');
        $pdf->Cell(30, 10, number_format($campo['Calificacion_2'], 2), 1, 0, 'C');
        $pdf->Cell(20, 10, $campo['Faltas_2'], 1, 0, 'C');
        $pdf->Cell(30, 10, number_format($campo['Calificacion_3'], 2), 1, 0, 'C');
        $pdf->Cell(20, 10, $campo['Faltas_3'], 1, 0, 'C');
        $pdf->Cell(30, 10, number_format($promedioMat, 2), 1, 1, 'C');        

        $total_mat++;
        $total_cal += $promedioMat;
    }

    if ($total_mat > 0) {
        $promedio = $total_cal / $total_mat;
        $pdf->Cell(150, 10, 'Promedio:', 1, 0, 'R',True);
        $pdf->Cell(30, 10, number_format($promedio, 2), 1, 1, 'C');
        $pdf->Ln();
    } else {
        $pdf->Cell(190, 10, 'No se encontraron materias para el alumno.', 1);
        $pdf->Ln();
    }

    mysqli_close($conexion);

    $pdf->Output();
}
?>
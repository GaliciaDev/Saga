<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Calificaciones del Alumno', 0, 1, 'C');
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

include 'conexion.php';
mysqli_select_db($conexion, "sagadb");

if (isset($_GET['id_alumno'])) {
    $id = $_GET['id_alumno'];

    // Consulta para obtener los datos de calificaciones del alumno
    $consultaCalificaciones = "SELECT * FROM materias WHERE id_alumno = '$id'";
    $resultadoCalificaciones = mysqli_query($conexion, $consultaCalificaciones);

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10, 'Materia', 1);    
    $pdf->Cell(20, 10, 'Faltas 1er', 1);
    $pdf->Cell(20, 10, 'Calif. 1er', 1);
    $pdf->Cell(20, 10, 'Faltas 2do', 1);
    $pdf->Cell(20, 10, 'Calif. 2do', 1);
    $pdf->Cell(20, 10, 'Faltas 3er', 1);
    $pdf->Cell(20, 10, 'Calif. 3er', 1);
    $pdf->Cell(20, 10, 'Promedio', 1);
    $pdf->Ln();

    while ($filaCalificacion = mysqli_fetch_assoc($resultadoCalificaciones)) {
        $materia = utf8_decode($filaCalificacion['Nom_Materia']);        
        $faltas1 = $filaCalificacion['Faltas_1'];
        $calif1 = $filaCalificacion['Calificacion_1'];
        $faltas2 = $filaCalificacion['Faltas_2'];
        $calif2 = $filaCalificacion['Calificacion_2'];
        $faltas3 = $filaCalificacion['Faltas_3'];
        $calif3 = $filaCalificacion['Calificacion_3'];
        $promedioMateria = number_format($filaCalificacion['Promedio_Mat'], 2);

        $pdf->Cell(40, 10, $materia, 1);        
        $pdf->Cell(20, 10, $faltas1, 1);
        $pdf->Cell(20, 10, $calif1, 1);
        $pdf->Cell(20, 10, $faltas2, 1);
        $pdf->Cell(20, 10, $calif2, 1);
        $pdf->Cell(20, 10, $faltas3, 1);
        $pdf->Cell(20, 10, $calif3, 1);
        $pdf->Cell(20, 10, $promedioMateria, 1);
        $pdf->Ln();
    }
}

mysqli_close($conexion);

// Generar el PDF
$pdf->Output();
?>

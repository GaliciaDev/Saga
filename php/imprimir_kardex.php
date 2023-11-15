<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Kardex del Alumno', 0, 1, 'C');
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

if (isset($_GET['id_alumno'])) {
    $id = $_GET['id_alumno'];

    // Consulta para obtener los datos de calificaciones del alumno
    $consultaCalificaciones = "SELECT materia, calificacion, periodo, situacion FROM calificaciones WHERE id_alumno = '$id'";
    $resultadoCalificaciones = mysqli_query($conexion, $consultaCalificaciones);

    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(40, 10, 'Materia', 1);
    $pdf->Cell(40, 10, 'Calificacion', 1);
    $pdf->Cell(40, 10, 'Periodo', 1);
    $pdf->Cell(40, 10, 'Situacion', 1);
    $pdf->Ln();

    while ($filaCalificacion = mysqli_fetch_assoc($resultadoCalificaciones)) {
        $materia = utf8_decode($filaCalificacion['materia']);
        $calificacion = utf8_decode($filaCalificacion['calificacion']);
        $periodo = utf8_decode($filaCalificacion['periodo']);
        $situacion = utf8_decode($filaCalificacion['situacion']);

        $pdf->Cell(40, 10, $materia, 1);
        $pdf->Cell(40, 10, $calificacion, 1);
        $pdf->Cell(40, 10, $periodo, 1);
        $pdf->Cell(40, 10, $situacion, 1);
        $pdf->Ln();
    }
}

mysqli_close($conexion);

// Generar el PDF
$pdf->Output();
?>
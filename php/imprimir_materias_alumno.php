<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        // Conexión a la base de datos y consulta para obtener el nombre del alumno
        include 'conexion.php';        

        if (isset($_GET['id_alumno'])) {
            $id = $_GET['id_alumno'];

            $consultaAlumno = "SELECT grado, grupo, turno, nombre, apellidoP, apellidoM FROM alumnos WHERE id_alumno = '$id'";
            $resultadoAlumno = mysqli_query($conexion, $consultaAlumno);

            if (mysqli_num_rows($resultadoAlumno) > 0) {
                $filaAlumno = mysqli_fetch_assoc($resultadoAlumno);
                $nombreCompleto = implode(' ', [$filaAlumno['nombre'], $filaAlumno['apellidoP'], $filaAlumno['apellidoM']]);

                // Imprime el nombre del alumno encima del encabezado
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(0, 10, 'Alumno: ' . utf8_decode($nombreCompleto), 0, 1, 'L');
            }
        }
        
        // Título
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Materias del Alumno', 0, 1, 'C');

        // Encabezado de la tabla
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(60, 10, 'Materia', 1);
        $this->Cell(40, 10, 'Turno', 1);
        $this->Cell(80, 10, 'Docente', 1);
        $this->Ln();
    }

    function Footer() {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Conexión a la base de datos y consulta para obtener las materias
include 'conexion.php';

if (isset($_GET['id_alumno'])) {
    $id = $_GET['id_alumno'];

    $consultaAlumno = "SELECT grado, grupo, turno, nombre, apellidoP, apellidoM FROM alumnos WHERE id_alumno = '$id'";
    $resultadoAlumno = mysqli_query($conexion, $consultaAlumno);

    if (mysqli_num_rows($resultadoAlumno) > 0) {
        $filaAlumno = mysqli_fetch_assoc($resultadoAlumno);
        $grado = $filaAlumno['grado'];
        $grupo = $filaAlumno['grupo'];
        $grado_grupo = $grado . '' . $grupo;
        $turno = $filaAlumno['turno'];

        $materias_registradas = array(); // Para llevar un registro de las materias

        $consultaMaterias = "SELECT DISTINCT Materias, turno, Docentes FROM horarios WHERE grado_grupo = '$grado_grupo' AND turno = '$turno'";
        $resultadoMaterias = mysqli_query($conexion, $consultaMaterias);

        if (mysqli_num_rows($resultadoMaterias) > 0) {
            while ($filaMateria = mysqli_fetch_assoc($resultadoMaterias)) {
                $pdf->SetFont('Arial', '', 10);
                // Utiliza utf8_decode para imprimir caracteres especiales como la "Ñ"
                $pdf->Cell(60, 10, utf8_decode($filaMateria['Materias']), 1);
                $pdf->Cell(40, 10, utf8_decode($filaMateria['turno']), 1);
                $pdf->Cell(80, 10, utf8_decode($filaMateria['Docentes']), 1);
                $pdf->Ln();
            }
        }
    }
}

mysqli_close($conexion);

$pdf->Output();
?>
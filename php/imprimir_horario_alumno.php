<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Horario de Alumno', 0, 1, 'C');
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

    $consultaAlumno = "SELECT grado, grupo, turno FROM alumnos WHERE id_alumno = '$id'";
    $resultadoAlumno = mysqli_query($conexion, $consultaAlumno);

    if (mysqli_num_rows($resultadoAlumno) > 0) {
        $filaAlumno = mysqli_fetch_assoc($resultadoAlumno);
        $grado = $filaAlumno['grado'];
        $grupo = $filaAlumno['grupo'];
        $grado_grupo = $grado . '' . $grupo;
        $turno = $filaAlumno['turno'];

        // Determina las horas a mostrar según el turno
        $horas = ($turno === 'Vespertino') ? array('2:00 - 2:45', '2:45 - 3:30', '3:30 - 4:15', '4:15 - 5:00', '5:30 - 6:15', '6:15 - 7:00', '7:00 - 7:45', '7:45 - 8:30') : array('7:00 - 7:45', '7:45 - 8:30', '8:30 - 9:15', '9:15 - 10:00', '10:30 - 11:15', '11:15 - 12:00', '12:00 - 12:45', '12:45 - 1:30');

        $consultaHorario = "SELECT Hora, Dias, Materias, Docentes, Aula FROM horarios WHERE grado_grupo = '$grado_grupo' AND turno = '$turno' ORDER BY FIELD(Dias, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'), Hora";
        $resultadoHorario = mysqli_query($conexion, $consultaHorario);

        $dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes');

        $horario_semana = array();

        // Inicializar la matriz del horario de la semana
        foreach ($dias as $dia) {
            foreach ($horas as $hora) {
                $horario_semana[$dia][$hora] = array('materia' => '', 'docente' => '', 'aula' => '');
            }
        }

        while ($filaHorario = mysqli_fetch_assoc($resultadoHorario)) {
            $dia = $filaHorario['Dias'];
            $hora = $filaHorario['Hora'];
            $materia = $filaHorario['Materias'];
            $docente = $filaHorario['Docentes'];
            $aula = $filaHorario['Aula'];

            $horario_semana[$dia][$hora] = array('materia' => utf8_decode($materia), 'docente' => utf8_decode($docente), 'aula' => utf8_decode($aula));
        }

        // Utilizamos la fuente Arial con ISO-8859-1 para caracteres especiales
        $pdf->SetFont('Arial', '', 10);

        // Imprimir el horario de la semana en el PDF
        $pdf->Cell(40, 10, 'Dia / Hora', 1);
        foreach ($dias as $dia) {
            $pdf->Cell(32, 10, $dia, 1);
        }
        $pdf->Ln();

        foreach ($horas as $hora) {
            $pdf->Cell(40, 20, $hora, 1);
            $x = 50;
            $y = $pdf->GetY();
            foreach ($dias as $dia) {
                $materia = $horario_semana[$dia][$hora]['materia'];
                $pdf->SetXY($x, $y);
                if (!empty($materia)) {
                    $docente = $horario_semana[$dia][$hora]['docente'];
                    $aula = $horario_semana[$dia][$hora]['aula'];
                    $pdf->setFontSize(8);
                    $pdf->MultiCell(32, 4, 'Materia: ' . $materia . "\nDocente: " . $docente . "\nAula: " . $aula, 1);
                } else {
                    $pdf->Cell(32, 20, '', 1);
                }
                $x += 32;
                $pdf->setFontSize(12);
            }
            $pdf->Ln();
        }
    }
}

mysqli_close($conexion);

// Generar el PDF
$pdf->Output();
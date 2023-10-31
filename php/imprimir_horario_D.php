<?php
// Comprueba si se ha proporcionado el nombre del profesor
if (isset($_GET['nombre_profesor'])) {
    $nombre_profesor = $_GET['nombre_profesor'];

    require('../fpdf/fpdf.php');

    // Crear un objeto PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Establecer fuente y tamaño de texto
    $pdf->SetFont('Arial', 'B', 16);

    // Título del PDF
    $pdf->Cell(0, 10, 'Horario del Profesor: ' . $nombre_profesor, 0, 1, 'C');

    // Conexion a la BD
    include 'conexion.php';
    mysqli_select_db($conexion, "sagadb");

    // Realizar consulta para obtener los horarios del profesor
    $consulta = "SELECT Dias, grado_grupo, Hora, Aula, Materias FROM `horarios` WHERE `Docentes` = '$nombre_profesor';";
    $resultado = mysqli_query($conexion, $consulta);

    // Encabezados de la tabla
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'Dia', 1);
    $pdf->Cell(20, 10, 'Grupo', 1);
    $pdf->Cell(30, 10, 'Horario', 1);
    $pdf->Cell(80, 10, 'Materia', 1);
    $pdf->Cell(30, 10, 'Aula', 1);
    $pdf->Ln();

    // Iterar a través de los resultados de la consulta
    while ($campo = mysqli_fetch_array($resultado)) {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(30, 10, utf8_decode($campo['Dias']), 1);
        $pdf->Cell(20, 10, utf8_decode($campo['grado_grupo']), 1);
        $pdf->Cell(30, 10, utf8_decode($campo['Hora']), 1);
        $pdf->Cell(80, 10, utf8_decode($campo['Materias']), 1);
        $pdf->Cell(30, 10, utf8_decode($campo['Aula']), 1);
        $pdf->Ln();
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Salida del PDF
    $pdf->Output();
} else {
    // En caso de que no se proporcione el nombre del profesor
    echo "Nombre del profesor no especificado.";
}
?>
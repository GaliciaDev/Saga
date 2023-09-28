<?php
    /*
    *   Imprimir en archivo PDF la informacion de las estadisticas grupales
    */

    if (isset($_GET['grado'])) {
        if (isset($_GET['grupo'])) {
            require('../fpdf/fpdf.php');
            $pdf = new FPDF();

            //Establecer parametros de texto, letras y margenes
            $pdf -> AddPage();
            $pdf -> SetFont('Arial', 'B', 25);
            $pdf -> SetTextColor(0, 0, 0);
            $pdf -> SetFillColor(171, 171, 171);
            $pdf -> SetTitle('ESTADISTICAS GRUPALES');

            //Recuperar datos de la BD
            $grado = $_GET['grado'];
            $grupo = $_GET['grupo'];
            
            //Imprimir cabeceras de tablas
            $pdf -> SetXY(10, 10);
            $pdf -> Cell(190, 30, utf8_decode("ESTADISTICAS DEL GRUPO ".$grado.strtoupper($grupo)), 1, 0, 'C', true);
            $pdf -> SetXY(10, 45);
            $pdf -> SetFont('Arial', 'B', 11);
            $pdf -> Cell(45, 10, utf8_decode("Materia"), 1, 0, 'C', true);
            $pdf -> Cell(55, 10, utf8_decode("Alumno"), 1, 0, 'C', true);
            $pdf -> Cell(25, 10, utf8_decode("Promedio"), 1, 0, 'C', true);
            $pdf -> Cell(30, 10, utf8_decode("Faltas Totales"), 1, 0, 'C', true);
            $pdf -> Cell(35, 10, utf8_decode("Desempeño"), 1, 1, 'C', true);
            $pdf -> SetFont('Arial', '', 11);

            $conexion = mysqli_connect("localhost", "root", "");
            mysqli_select_db($conexion, "sagadb");

            $query = "SELECT * FROM `alumnos` WHERE `grado` = '$grado' AND `grupo` = '$grupo';";
            $resultado = mysqli_query($conexion, $query);

            while ($nombreC = mysqli_fetch_array($resultado)) {
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
                    
                    //Imprimir datos en PDF
                    $pdf -> Cell(45, 10, utf8_decode($campo['Nom_Materia']), 1, 0, 'C', false);
                    $pdf -> Cell(55, 10, utf8_decode(implode(' ', [$nombreC['nombre'], $nombreC['apellidoP'], $nombreC['apellidoM']])), 1, 0, 'C', false);
                    $pdf -> Cell(25, 10, utf8_decode(number_format($campo['Promedio_Mat'], 2)), 1, 0, 'C', false);
                    $pdf -> Cell(30, 10, utf8_decode($faltaT), 1, 0, 'C', false);
                    $pdf -> Cell(35, 10, utf8_decode($desempeño), 1, 1, 'C', false);

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
        
                //Imprimir datos en PDF
                $pdf -> SetFont('Arial', 'B', 11);
                $pdf -> Cell(100, 10, utf8_decode("Promedio General:"), 1, 0, 'C', true);
                $pdf -> Cell(25, 10, utf8_decode($promedio !== "N/A" ? number_format($promedio, 2) : $promedio), 1, 0, 'C', true);
                $pdf -> Cell(30, 10, utf8_decode($total_faltas), 1, 0, 'C', true);
                $pdf -> Cell(35, 10, utf8_decode($desempeño_general), 1, 1, 'C', true);
                $pdf -> SetFont('Arial', '', 11);
            }

            $pdf -> Output('I', 'EstadisticasGrupal.pdf');
        }
        else {
            header("location:../estadistica_grupal.php");
        }
    }
    else {
        header("location:../estadistica_grupal.php");
    }
?>
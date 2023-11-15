<?php    
include '../php/variabledS.php';
validarSd();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilo_horario.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../css/diseño_movil.css">
    <title>Horarios</title>
</head>
<body>
    <?php include '../php/nav_D.php'; ?>
    <h1>Horario</h1>
    <br><br>

    <?php
        // Definir las horas matutinas y vespertinas
        $horas_matutinas = array(
            '7:00 - 7:45',
            '7:45 - 8:30',
            '8:30 - 9:15',
            '9:15 - 10:00',
            '10:30 - 11:15',
            '11:15 - 12:00',
            '12:00 - 12:45',
            '12:45 - 1:30'
        );
        
        $horas_vespertinas = array(
            '2:00 - 2:45',
            '2:45 - 3:30',
            '3:30 - 4:15',
            '4:15 - 5:00',
            '5:30 - 6:15',
            '6:15 - 7:00',
            '7:00 - 7:45',
            '7:45 - 8:30'
        );
    ?>

    <table class="tabla_horarios">
        <?php        
        if (isset($_SESSION['docente'])) {
            $id_usuario = $_SESSION['docente'];

            include '../php/conexion.php';

            // Consulta para obtener el nombre del profesor y su turno
            $consulta_nombre_turno = "SELECT nombreD, apellidoPd, apellidoMd, turno FROM `docentes` WHERE `id_docente` = '$id_usuario';";
            $resultado_nombre_turno = mysqli_query($conexion, $consulta_nombre_turno);

            if ($row = mysqli_fetch_assoc($resultado_nombre_turno)) {
                $nombre_profesor = $row['nombreD'] . ' ' . $row['apellidoPd'] . ' ' . $row['apellidoMd'];
                $turno_docente = $row['turno'];

                // Consulta para obtener los horarios del profesor
                $consulta_horarios = "SELECT * FROM `horarios` WHERE `Docentes` = '$nombre_profesor';";
                $resultado_horarios = mysqli_query($conexion, $consulta_horarios);

                // Construir un array asociativo para almacenar los horarios
                $horario_profesor = array();
                while ($campo = mysqli_fetch_array($resultado_horarios)) {
                    $dia = $campo['Dias'];
                    $hora = $campo['Hora'];
                    $materia = $campo['Materias'];
                    $aula = $campo['Aula'];
                    $grado_grupo = $campo['grado_grupo'];

                    // Usar el array correcto según el valor de Turno
                    $horas = ($turno_docente == 'Matutino') ? $horas_matutinas : $horas_vespertinas;

                    $horario_profesor[$dia][$hora] = array('materia' => $materia, 'aula' => $aula, 'grado_grupo' => $grado_grupo);
                }

                // Imprimir tabla de horarios
                echo '<tr><th></th><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th></tr>';

                foreach ($horas as $hora) {
                    echo '<tr><td>' . $hora . '</td>';
                    foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $dia) {
                        $info_celda = isset($horario_profesor[$dia][$hora]) ? $horario_profesor[$dia][$hora] : null;
                        echo '<td>';
                        if ($info_celda) {
                            echo 'Materia: ' . $info_celda['materia'] . '<br>';
                            echo 'Salón: ' . $info_celda['aula'] . '<br>';
                            echo 'Grado y Grupo: ' . $info_celda['grado_grupo'];
                        }
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            } else {
                echo 'No se encontró un profesor con el ID de usuario proporcionado.';
            }
            
            mysqli_close($conexion);
        } else {
            echo 'No se ha iniciado sesión. Por favor, inicie sesión para ver los horarios.';
        }
        ?>
    </table>

    <br><a target="_blank" href="../php/imprimir_horario_D.php?nombre_profesor=<?php echo urlencode($nombre_profesor); ?>">
    <button class="btnguardar">Imprimir PDF</button>
    </a><br><br>

    <style>
        /* Estilo para el botón */
        .btnguardar {
            background-color: #000; /* Color de fondo negro para el botón */
            color: #fff; /* Color del texto del botón (blanco) */
            padding: 10px 20px; /* Espaciado interno del botón (ajusta según tus necesidades) */
            border: none; /* Quita el borde del botón */
            border-radius: 5px; /* Añade esquinas redondeadas al botón */
            cursor: pointer; /* Cambia el cursor al pasar el ratón por encima */
            transition: background-color 0.3s ease; /* Agrega una transición suave al color de fondo */
        }

        /* Estilo para el botón cuando se pasa el ratón por encima */
        .btnguardar:hover {
            background-color: #333; /* Cambia el color de fondo a gris oscuro al pasar el ratón por encima */
        }
    </style>
</body>
<footer>
    <?php include '../php/footerG.php';?>
</footer>
</html>
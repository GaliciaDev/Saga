<?php
    require '../php/conexion_be.php';

    //$sql = "SELECT Dias, Marterias, Docentes, Hora, Aula FROM horarios WHERE  id_alumno = '$alumno'";

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
            <li><a href="../php/cerrar_sesion.php">Cerrar Sesion</a></li>
        </ul>
    </nav>
    </header>
    <h1>Horario de Alumno</h1>
    <!-- Formulario para ingresar el grupo -->
    <form method="POST">
        <label for="grupo">Ingrese el grupo:</label>
        <input type="text" name="grupo" id="grupo">
        <input type="submit" value="Consultar">
    </form>

    <?php
    // Verificar si se encontraron horarios para el grupo
    if (!empty($horarios)) {
        // Crear una matriz para almacenar los horarios organizados por día y hora
        $horarios_organizados = array(
            'Lunes' => array(),
            'Martes' => array(),
            'Miercoles' => array(),
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

        // Imprimir la tabla de horarios organizados de manera vertical
        echo '<table class="tabla">';
        echo '<tr><th></th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th></tr>';
        foreach (array(
            '7:00 - 7:45',
            '7:45 - 8:30',
            '8:30 - 9:15',
            '9:15 - 10:00',
            '10:30 - 11:15',
            '11:15 - 12:00',
            '12:00 - 12:45',
            '12:45 - 1:30'
        ) as $hora) {
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
    } else {
        echo 'No se encontraron horarios para el grupo ingresado.';
    }
    ?>     

</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>
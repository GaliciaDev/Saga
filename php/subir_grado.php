<?php
include 'conexion_be.php';

if (isset($_POST['egresar_alumnos'])) {
    // Acción: Egresar alumnos de 3er grado

    // Obtén el año actual
    $periodo = date("Y-m");

    // Consulta SQL para obtener los datos de los alumnos de 3er grado con promedio mayor a 60
    $sqlAlumnos3erGrado = "SELECT * FROM alumnos WHERE grado = 3";
    $resultAlumnos3erGrado = $conexion->query($sqlAlumnos3erGrado);

    if ($resultAlumnos3erGrado) {
        while ($rowAlumno = $resultAlumnos3erGrado->fetch_assoc()) {
            $id_alumno = $rowAlumno['id_alumno'];
            $periodoActual = $rowAlumno['periodo'];
            $nombre_completo = implode(" ", array($rowAlumno['nombre'], $rowAlumno['apellidoP'], $rowAlumno['apellidoM']));

            // Consulta para calcular el promedio solo de las calificaciones aprobatorias (mayores a 60)
            $sqlPromedio = "SELECT * FROM calificaciones WHERE id_alumno = $id_alumno AND calificacion > 60";
            $resultadoPromedio = $conexion->query($sqlPromedio);

            if ($resultadoPromedio) {
                $rowPromedio = $resultadoPromedio->fetch_assoc();
                $promedio = $rowPromedio['promedio'];

                if ($periodo != $periodoActual && $promedio > 60) {
                    // Consulta para insertar en la tabla de egresados
                    $sqlInsertEgresados = "INSERT INTO `alumnos_egresados`(`id_alumno`, `nombre_completo`, `periodo`, `promedio`) VALUES ('$id_alumno', '$nombre_completo', '$periodo', '$promedio')";

                    if ($conexion->query($sqlInsertEgresados) === TRUE) {
                        // Consulta para eliminar al alumno de la tabla de alumnos
                        $sqlDeleteAlumno = "DELETE FROM alumnos WHERE id_alumno = '$id_alumno'";
                        if ($conexion->query($sqlDeleteAlumno) === TRUE) {
                            echo "Alumno de 3er grado egresado correctamente: " . $nombre_completo . "<br>";
                            echo "<meta http-equiv='refresh' content='1; url=../views/subir_grado.php'>";
                        } else {
                            echo "Error al eliminar al alumno de 3er grado: " . $conexion->error . "<br>";
                        }
                    } else {
                        echo "Error al egresar al alumno de 3er grado: " . $conexion->error . "<br>";
                    }
                }
            } else {
                echo "Error al calcular el promedio del alumno: " . $conexion->error . "<br>";
            }
        }
    }
} elseif (isset($_POST['aumentar_grado'])) {
    // Acción: Aumentar el grado de los alumnos de 1er y 2do grado

    // Obtén el mes y el año actual
    $periodo = date("Y-m");
    $anioPeriodoActual = intval(substr($periodo, 0, 4));

    // Consulta SQL para obtener los datos de los alumnos de 1er y 2do grado
    $sqlAlumnos1er2doGrado = "SELECT id_alumno, periodo, grado FROM alumnos WHERE grado IN (1, 2)";
    $resultAlumnos1er2doGrado = $conexion->query($sqlAlumnos1er2doGrado);

    if ($resultAlumnos1er2doGrado) {
        while ($rowAlumno = $resultAlumnos1er2doGrado->fetch_assoc()) {
            $id_alumno = $rowAlumno['id_alumno'];
            $periodoAlumno = $rowAlumno['periodo'];
            $gradoAlumno = $rowAlumno['grado'];
            $anioAlumno = intval(substr($periodoAlumno, 0, 4));

            if (($anioPeriodoActual - $anioAlumno) >= 1) {
                // Si ha transcurrido al menos un año desde el último período, verifica el promedio
                $sqlPromedio = "SELECT AVG(calificacion) AS promedio FROM calificaciones WHERE id_alumno = $id_alumno";
                $resultPromedio = $conexion->query($sqlPromedio);
                $rowPromedio = $resultPromedio->fetch_assoc();
                $promedio = $rowPromedio['promedio'];

                // Verifica si el promedio es mayor o igual a 60 para aumentar el grado
                if ($promedio > 60) {
                    $nuevoGrado = $gradoAlumno + 1;

                    // Actualiza el grado del alumno
                    $sqlActualizarGrado = "UPDATE alumnos SET grado = $nuevoGrado, periodo = '$periodo' WHERE id_alumno = $id_alumno";

                    if ($conexion->query($sqlActualizarGrado) === TRUE) {
                        echo "Grado del alumno con ID $id_alumno aumentado correctamente a $nuevoGrado.";
                    } else {
                        echo "Error al aumentar el grado del alumno con ID $id_alumno: " . $conexion->error;
                    }
                } else {
                    echo "El alumno con ID $id_alumno no cumple con el promedio mínimo de 60 y no puede subir de grado.";
                }
            } else {
                // Si no ha transcurrido un año, el alumno no puede subir de grado
                echo "El alumno con ID $id_alumno no puede subir de grado porque no ha transcurrido un año desde su último período.";
            }
        }

        echo "<meta http-equiv='refresh' content='1; url=../views/subir_grado.php'>";
    } else {
        echo "Error al verificar el registro en la tabla alumnos: " . $conexion->error;
        echo "<meta http-equiv='refresh' content='3; url=../views/subir_grado.php'>";
    }
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
<?php
include 'conexion.php';

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
            $sqlPromedio = "SELECT * FROM calificaciones WHERE id_alumno = ? AND calificacion > 60";
            $stmtPromedio = $conexion->prepare($sqlPromedio);
            $stmtPromedio->bind_param("i", $id_alumno);
            $stmtPromedio->execute();
            $resultadoPromedio = $stmtPromedio->get_result();

            if ($resultadoPromedio) {
                $rowPromedio = $resultadoPromedio->fetch_assoc();
                if ($rowPromedio !== null && isset($rowPromedio['calificacion'])) {
                    $promedio = $rowPromedio['calificacion'];

                    if ($periodo != $periodoActual && $promedio > 60) {
                        // Consulta para insertar en la tabla de egresados o actualizar si ya existe
                        $sqlInsertEgresados = "INSERT INTO `alumnos_egresados`(`id_alumno`, `id`, `nombre_completo`, `periodo`, `promedio`) VALUES ('$id_alumno', null, '$nombre_completo','$periodo','$promedio')";                        

                        if (mysqli_query($conexion, $sqlInsertEgresados)) {
                            echo "Alumno de 3er grado egresado correctamente: " . $nombre_completo . "<br>";
                            echo "<meta http-equiv='refresh' content='1; url=../views/subir_grado.php'>";
                        } else {
                            echo "Error al egresar al alumno de 3er grado: " . $stmtInsertEgresados->error . "<br>";
                        }
                    } else {
                        echo "El alumno con ID $id_alumno no cumple con el promedio mínimo de 60 o no cumple con un periodo escolar y no puede ser egresado.<br><br>";
                    }
                } else {
                    echo "No se encontraron calificaciones válidas para el alumno con ID $id_alumno.<br><br>";
                }
            } else {
                echo "Error al calcular el promedio del alumno: " . $stmtPromedio->error . "<br>";
            }
        }
        echo "<meta http-equiv='refresh' content='5; url=../views/subir_grado.php'>";
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
                $sqlPromedio = "SELECT AVG(calificacion) AS promedio FROM calificaciones WHERE id_alumno = ?";
                $stmtPromedio = $conexion->prepare($sqlPromedio);
                $stmtPromedio->bind_param("i", $id_alumno);
                $stmtPromedio->execute();
                $resultPromedio = $stmtPromedio->get_result();
                $rowPromedio = $resultPromedio->fetch_assoc();
                $promedio = $rowPromedio['promedio'];

                // Verifica si el promedio es mayor o igual a 60 para aumentar el grado
                if ($promedio > 60) {
                    $nuevoGrado = $gradoAlumno + 1;

                    // Actualiza el grado del alumno
                    $sqlActualizarGrado = "UPDATE alumnos SET grado = ?, periodo = ? WHERE id_alumno = ?";
                    $stmtActualizarGrado = $conexion->prepare($sqlActualizarGrado);
                    $stmtActualizarGrado->bind_param("isi", $nuevoGrado, $periodo, $id_alumno);

                    if ($stmtActualizarGrado->execute()) {
                        echo "Grado del alumno con ID $id_alumno aumentado correctamente a $nuevoGrado.<br><br>";
                    } else {
                        echo "Error al aumentar el grado del alumno con ID $id_alumno: " . $stmtActualizarGrado->error . "<br><br>";
                    }
                } else {
                    echo "El alumno con ID $id_alumno no puede subir de grado porque no ha transcurrido un año desde su último período.<br><br>";
                }
            } else {
                // Si no ha transcurrido un año, el alumno no puede subir de grado
                echo "El alumno con ID $id_alumno no puede subir de grado porque no ha transcurrido un año desde su último período.<br><br>";
            }
        }
        echo "<meta http-equiv='refresh' content='5; url=../views/subir_grado.php'>";
    } else {
        echo "Error al verificar el registro en la tabla alumnos: " . $conexion->error;
    }
} elseif (isset($_POST['eliminar_registros'])) {
    // Acción: Eliminar registros de alumnos, materias y calificaciones

    // Obtén el ID del alumno que deseas eliminar
    $id_alumno_a_eliminar = 123; // Reemplaza con el ID del alumno que deseas eliminar

    // Consulta SQL para eliminar el alumno de la tabla 'alumnos'
    $sql_eliminar_alumno = "DELETE FROM alumnos WHERE id_alumno = ?";
    $stmt_eliminar_alumno = $conexion->prepare($sql_eliminar_alumno);
    $stmt_eliminar_alumno->bind_param("i", $id_alumno_a_eliminar);

    // Consulta SQL para eliminar registros de calificaciones del alumno
    $sql_eliminar_calificaciones = "DELETE FROM calificaciones WHERE id_alumno = ?";
    $stmt_eliminar_calificaciones = $conexion->prepare($sql_eliminar_calificaciones);
    $stmt_eliminar_calificaciones->bind_param("i", $id_alumno_a_eliminar);

    // Consulta SQL para eliminar registros de materias relacionados con el alumno
    $sql_eliminar_materias = "DELETE FROM materias WHERE id_alumno = ?";
    $stmt_eliminar_materias = $conexion->prepare($sql_eliminar_materias);
    $stmt_eliminar_materias->bind_param("i", $id_alumno_a_eliminar);

    // Ejecutar las consultas de eliminación
    if (
        $stmt_eliminar_alumno->execute() &&
        $stmt_eliminar_calificaciones->execute() &&
        $stmt_eliminar_materias->execute()
    ) {
        echo "Registros eliminados correctamente.";
        echo "<meta http-equiv='refresh' content='2; url=../views/subir_grado.php'>";
    } else {
        echo "Error al eliminar registros: " . $conexion->error;
    }
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
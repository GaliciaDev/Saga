<?php
// Verificar si se recibió el ID por GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conexión a la base de datos
    include 'conexion.php';
    mysqli_select_db($conexion, "sagadb");

    // Consulta para obtener los datos del registro a editar
    $consulta = "SELECT * FROM tira_materias WHERE id = $id";
    $resultado = mysqli_query($conexion, $consulta);

    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        if ($fila) {
            $materia = $fila['Materias'];
            $horas_clases = $fila['Horas_Clases'];
            $docente = $fila['docente'];
            $anio = $fila['año'];

        } else {
            // El registro no existe
            echo 'El registro no existe.';
            exit; // Terminar la ejecución
        }
    } else {
        // Error en la consulta
        echo 'Error en la consulta: ' . mysqli_error($conexion);
        exit; // Terminar la ejecución
    }
} else {
    // No se proporcionó un ID válido
    echo 'ID no válido.';
    exit; // Terminar la ejecución
}

// Manejar el formulario de edición
if ($_POST) {
    // Obtener los datos editados desde el formulario
    $nuevaMateria = isset($_POST['nueva_materia']) ? $_POST['nueva_materia'] : '';
    $nuevasHorasClases = isset($_POST['nuevas_horas_clases']) ? $_POST['nuevas_horas_clases'] : '';
    $nuevoDocente = isset($_POST['nuevo_docente']) ? $_POST['nuevo_docente'] : '';

    // Actualizar los datos en la base de datos
    $query_actualizar = "UPDATE tira_materias SET Materias = '$nuevaMateria', Horas_Clases = '$nuevasHorasClases', docente = '$nuevoDocente' WHERE id = $id";
    $resultado_actualizar = mysqli_query($conexion, $query_actualizar);

    if ($resultado_actualizar) {
        echo '<h1>Los cambios se han guardado correctamente.</h1>';
        echo '<meta http-equiv="refresh" content="1; url=../views/modificar_materias.php">';
    } else {
        echo 'Error al actualizar los datos: ' . mysqli_error($conexion);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/estilo_modificar_materia.css">
    <link rel="shortcut icon" href="../assets/img/icon.png">  
    <title>Editar Materia</title>
</head>
<body>
    <h1>Editar Materia</h1>
    <form method="POST">
        <label for="nueva_materia">Materia:</label>
        <input type="text" id="nueva_materia" name="nueva_materia" value="<?php echo $materia; ?>"><br>

        <label for="nuevas_horas_clases">Horas de Clases:</label>
        <select id="nuevas_horas_clases" name="nuevas_horas_clases">
            <option value="5" <?php if ($horas_clases == '5 Hrs.') echo 'selected'; ?>>5 Hrs.</option>
            <option value="4" <?php if ($horas_clases == '4 Hrs.') echo 'selected'; ?>>4 Hrs</option>
            <option value="3" <?php if ($horas_clases == '3 Hrs.') echo 'selected'; ?>>3 Hrs</option>
        </select><br>

        <select class="nombre" name="nuevo_docente" id="docente">
            <?php
            // Conexión a la base de datos
            include 'conexion.php';
            mysqli_select_db($conexion, "sagadb");

            // Consulta para obtener los nombres completos de los docentes
            $consulta_docentes = "SELECT CONCAT(nombreD, ' ', apellidoPd, ' ', apellidoMd) AS nombre_completo FROM docentes";
            $resultado_docentes = mysqli_query($conexion, $consulta_docentes);

            // Generar las opciones
            while ($fila_docente = mysqli_fetch_assoc($resultado_docentes)) {
                $nombre_completo = $fila_docente['nombre_completo'];
                echo '<option class="nombre" value="' . $nombre_completo . '">' . $nombre_completo . '</option>';
            }

            // Cerrar la conexión a la BD
            mysqli_close($conexion);
            ?>
        </select><br>

        <label>Grado de la Materia</label>
            <select class="anio">
                <?php echo '<option value="' . $anio . '">'.$anio.'</option>';?>
                <option value="1">1°</option>
                <option value="2">2°</option>
                <option value="3">3°</option>
            </select><br><br>

        <input type="submit" value="Guardar Cambios">
        <a href="../views/modificar_materias.php">Regresar</a>
    </form>
</body>
    <style>
        /* Estilo para el cuerpo de la página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        #nuevas_horas_clases {
            width: 30%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        /* Estilo para el encabezado */
        h1 {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        /* Estilo para el formulario */
        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Estilo para las etiquetas de formulario */
        label {
            display: block;
            margin-bottom: 10px;
            font-size: 15px;
        }

        /* Estilo para los campos de entrada de texto y selección */
        input[type="text"],
        select {
            width: 85%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        /* Estilo para el botón de envío */
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .anio {
            width: 20%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
    </style>
</html>
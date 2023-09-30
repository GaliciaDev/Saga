<?php
// Verificar si se recibió el ID por GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
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
    $nuevaMateria = $_POST['nueva_materia'];
    $nuevasHorasClases = $_POST['nuevas_horas_clases'];
    $nuevoDocente = $_POST['nuevo_docente'];

    // Actualizar los datos en la base de datos
    $query_actualizar = "UPDATE tira_materias SET Materias = '$nuevaMateria', Horas_Clases = '$nuevasHorasClases', docente = '$nuevoDocente' WHERE id = $id";
    $resultado_actualizar = mysqli_query($conexion, $query_actualizar);

    if ($resultado_actualizar) {
        echo '<h1>Los cambios se han guardado correctamente.</h1>';
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
    <link rel="stylesheet" type="text/css" href="../css/modificar_materia.css">
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
            <option value="5" <?php if ($horas_clases == '5') echo 'selected'; ?>>5 Hrs.</option>
            <option value="4" <?php if ($horas_clases == '4') echo 'selected'; ?>>4 Hrs</option>
            <option value="3" <?php if ($horas_clases == '3') echo 'selected'; ?>>3 Hrs</option>
        </select><br>

        <label for="nuevo_docente">Docente:</label>
        <input type="text" id="nuevo_docente" name="nuevo_docente" value="<?php echo $docente; ?>"><br>

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
        }

        /* Estilo para los campos de entrada de texto y selección */
        input[type="text"],
        select {
            width: 100%;
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
    </style>
</html>
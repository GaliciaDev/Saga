    <?php
    include '../php/variabledS.php';
    validarSad();
    
    // Conexión a la base de datos
    include '../php/conexion.php';
    
    // Variable para almacenar el mensaje
    $mensaje = "";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Procesar el formulario de incidencias
        $alumno = $_POST['alumno'];
        $tipo = $_POST['tipo'];
        $descripcion = $_POST['descripcion'];
        $fecha = date("Y-m-d");
        $resuelta = "No";
        $mensaje = "";
    
        // Consulta para insertar la incidencia en la base de datos
        $consultaIncidencia = "INSERT INTO incidenciasalumnos (id_alumno, fecha, tipo_incidencia, descripcion, resuelta, responsable) VALUES (null, '$fecha', '$tipo', '$descripcion', '$resuelta', '$alumno')";
    
        if (mysqli_query($conexion, $consultaIncidencia)) {
            $mensaje = "Incidencia registrada exitosamente.";
        } else {
            $mensaje = "Error al registrar la incidencia: " . mysqli_error($conexion);
        }
    }
    echo $mensaje;
    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <link rel="stylesheet" type="text/css" href="../css/incidencias.css">
            <link rel="shortcut icon" href="../assets/img/icon.png">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <link rel="stylesheet" href="../css/diseño_movil.css">
            <title>Registro Incidencias</title>

            <script>
                function mostrarMensaje() {
                    console.log("Mensaje emergente: <?php echo $mensaje; ?>"); // Agrega esta línea
                    var mensaje = "<?php echo $mensaje; ?>";
                    if (mensaje) {
                        alert(mensaje);
                        location.reload();
                    }
                }
            </script>
        </head> 
    <body>
    <?php include '../php/nav_Admin.php'; ?>
        <br><h2>Registrar Incidencia</h2><br><br>
            <form method="post" action="incidencias.php">
                <label for="alumno">Alumno:</label>
                <input type="text" id="alumno" name="alumno" required>

                &emsp;<label for="tipo">Tipo de Incidencia:</label>
                <select id="tipo" name="tipo" required>
                    <option value="Comportamiento">Comportamiento</option>
                    <option value="Faltas">Faltas</option>
                    <option value="Otro">Otro</option>
                </select>

                &emsp;<label for="descripcion">Descripción de la Incidencia:</label>
                &emsp;<textarea id="descripcion" name="descripcion" rows="4" required></textarea>

                &emsp;<input type="submit" value="Registrar Incidencia">
            </form>
    </body>
    <style>
        select {
            width: 12%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
        <footer>
        <?php include '../php/footerG.php';?>
        </footer>
    </html>  
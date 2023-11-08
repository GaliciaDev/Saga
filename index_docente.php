<?php
include 'php/variabledS.php';
include 'php/conexion.php';
validarSd();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="shortcut icon" href="assets/img/icon.png">
    <link rel="stylesheet" href="../css/diseño_movil.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Index del Docente</title>
</head>
<body>    
    <?php include 'php/navegacion_D.php'; ?>
    <br><br>    
    <table class="tabla_informacion">
        <tr>
            <h2>Información General</h2>
            <?php
            // Obtén la matrícula del docente desde la variable de sesión
            $matricula = $_SESSION['docente'];

            // Conexión a la BD
            include 'php/conexion.php';
            mysqli_select_db($conexion, "sagadb");

            // Realiza consulta
            $resultado = mysqli_query($conexion, "SELECT * FROM `docentes` WHERE `id_docente` = '$matricula' LIMIT 1;");

            $campo = mysqli_fetch_array($resultado);
            echo '
            <tr>
                <th rowspan="2"><img src="assets/img/img3.png" alt="MDN"></th>
                <th>Nombre</th>
                <td>' . $campo['nombreD'] . ' ' . $campo['apellidoPd'] . ' ' . $campo['apellidoMd'] . '</td>
                <th>Matricula</th>
                <td>' . $campo['id_docente'] . '</td>
                <th>Cargo</th>
                <td>' . $campo['cargoD'] . '</td>
            </tr>
            <tr>
                <th>Area</th>
                <td>' . $campo['areaD'] . '</td>
                <th>Telefono</th>
                <td>' . $campo['telefonoD'] . '</td>
                <th>Telefono de Emergencias</th>
                <td>' . $campo['telefonoEd'] . '</td>
            </tr>
            ';
            ?>
        </tr>
    </table><br><br><br>
</body>
<footer>
<?php include 'php/footerG.php';?>
</footer>
</html>
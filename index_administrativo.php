<?php
    include 'php/variabledS.php';
    include 'php/conexion.php';
    validarSad();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/estilo_index_G.css">
        <link rel="shortcut icon" href="assets/img/icon.png">
        <link rel="stylesheet" href="css/diseño_movil.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Index Administrativo</title>
    </head> 
<body>
    <?php include 'php/navegacion_Admin.php'; ?>    
        <br><br><table class="tabla_informacion">                    
        <tr>
            <h2>Información General</h2>
            <?php
            // Obtén la matrícula del administrador desde la variable de sesión
            $matricula = $_SESSION['admin'];
            
            // Realiza consulta
            $resultado = mysqli_query($conexion, "SELECT * FROM `administrativo` WHERE `id_admin` = '$matricula' LIMIT 1;");

            $campo = mysqli_fetch_array($resultado);
            echo '
            <tr>
                <th rowspan="2"><img src="assets/img/img3.png" alt="MDN"></th>
                <th>Nombre</th>
                <td>'.($campo['nombreAa']). ' ' .($campo['apellidoPa']). ' ' .($campo['apellidoM']).'</td>
                <th>Matricula</th>
                <td>'.($campo['id_admin']).'</td>
                <th>Cargo</th>
                <td>'.($campo['cargoA']).'</td>
            </tr>

            <tr>
                <th>Area</th>
                <td>' . ($campo['areaA']) . '</td>
                <th>Telefono</th>
                <td>' . ($campo['telefonoA']) . '</td>
                <th>Telefono de Emergencias</th>
                <td>' . ($campo['telefonoEa']) . '</td>
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
<?php
    include '../php/variabledS.php';
    include '../php/conexion.php';
    validarSad();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/index.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="../css/diseño_movil.css">
        <title>Lista de Egresados</title>
    </head> 
<body>
<?php include '../php/nav_Admin.php'; ?>    
    <div class="main-content">
        <h1>Lista de Alumnos Egresados</h1>
        <form action="lista_egresados.php" method="POST">
            <input type="text" name="buscar" placeholder="Buscar por ID o Periodo">
            <input type="submit" value="Buscar">
        </form>

        <?php
            $query = "SELECT * FROM alumnos_egresados ORDER BY periodo";
            $result = $conexion->query($query);

            if ($result->num_rows > 0) {
                echo '<table border="1">';
                echo '<tr>';
                echo '<th>ID Alumno</th>';
                echo '<th>Nombre Completo</th>';
                echo '<th>Periodo</th>';
                echo '<th>Promedio</th>';
                echo '</tr>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id_alumno'] . '</td>';
                    echo '<td>' . $row['nombre_completo'] . '</td>';
                    echo '<td>' . $row['periodo'] . '</td>';
                    echo '<td>' . $row['promedio'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo 'No se encontraron alumnos egresados.';
            }

            $conexion->close();
        ?>
    </div>
</body>
    <footer>
    <?php include '../php/footerG.php';?>
    </footer>
</html>  
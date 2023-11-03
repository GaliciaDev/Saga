<?php
    include '../php/variabledS.php';
    validarSad();

    include '../php/conexion.php';
    $consultaUsuarios = "SELECT * FROM `docentes`";
    $resultadoUsuarios = mysqli_query($conexion, $consultaUsuarios);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/perfiles.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <link rel="stylesheet" href="../css/diseño_movil.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Perfiles</title>
    </head> 
<body>
<?php include '../php/nav_Admin.php'; ?>    
        <h2>Usuarios Administrativos</h2>
        <div id="Botones">
            <a href="lista_perfiles.php"><button>Perfiles Administrativos</button></a>
            <a href="lista_perfiles_A.php"><button>Perfiles Alumnos</button></a>
        </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Cargo</th>        
                    <th>Tel Emergencia</th>            
                    <th>Acciones</th>
                </tr>
                <?php
                while ($fila = mysqli_fetch_assoc($resultadoUsuarios)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_docente'] . "</td>";
                    $nombreCompleto = implode(' ', [$fila['nombreD'], $fila['apellidoPd'], $fila['apellidoMd']]);
                    echo "<td>" . $nombreCompleto . "</td>";
                    echo "<td>" . $fila['correoD'] . "</td>";
                    echo "<td>" . $fila['telefonoD'] . "</td>";
                    echo "<td>" . $fila['direccionD'] . "</td>";
                    echo "<td>" . $fila['cargoD'] . "</td>";
                    echo "<td>" . $fila['telefonoEd'] . "</td>";
                    echo "<td><a href='consulta_docentes.php?id=" . $fila['id_docente'] . "'>Ver Mas...</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
</body>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>  
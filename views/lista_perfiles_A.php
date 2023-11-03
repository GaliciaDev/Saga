<?php
    include '../php/variabledS.php';
    validarSad();

    include '../php/conexion.php';
    $consultaUsuarios = "SELECT * FROM `alumnos`";
    $resultadoUsuarios = mysqli_query($conexion, $consultaUsuarios);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/perfiles.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="../css/diseño_movil.css">
        <title>Perfiles</title>
    </head> 
<body>
<?php include '../php/nav_Admin.php'; ?>   
        <h2>Usuarios Alumnos</h2>
        <div id="Botones">
            <a href="lista_perfiles_D.php"><button>Perfiles Docentes</button></a>
            <a href="lista_perfiles.php"><button>Perfiles Administrativos</button></a>
        </div>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Grado</th>                    
                    <th>Grupo</th>
                    <th>Turno</th>
                    <th>Periodo</th>
                    <th>Acciones</th>
                </tr>
                <?php
                while ($fila = mysqli_fetch_assoc($resultadoUsuarios)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_alumno'] . "</td>";
                    $nombreCompleto = implode(' ', [$fila['nombre'], $fila['apellidoP'], $fila['apellidoM']]);
                    echo "<td>" . $nombreCompleto . "</td>";
                    echo "<td>" . $fila['correo'] . "</td>";
                    echo "<td>" . $fila['telefono'] . "</td>";
                    echo "<td>" . $fila['domicilio'] . "</td>";
                    echo "<td>" . $fila['grado'] . "</td>";
                    echo "<td>" . $fila['grupo'] . "</td>";
                    echo "<td>" . $fila['turno'] . "</td>";
                    echo "<td>" . $fila['periodo'] . "</td>";
                    echo "<td><a href='consultar_alumnos.php?id=" . $fila['id_alumno'] . "'>Ver Mas...</a></td>";
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
<?php
    include '../php/variabledS.php';
    validarSad();

    include '../php/conexion.php';
    $consultaUsuarios = "SELECT * FROM `administrativo`";
    $resultadoUsuarios = mysqli_query($conexion, $consultaUsuarios);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo_perfiles_usuarios.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <link rel="stylesheet" href="../css/diseño_movil.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Perfiles</title>
    </head> 
<body>
<?php include '../php/nav_Admin.php'; ?>  
        <br><h2>Usuarios Administrativos</h2>
        <div id="Botones"><br><br><br>
            <a class="boton" href="lista_perfiles_D.php">Perfiles Docentes</a>
            <a class="boton" href="lista_perfiles_A.php">Perfiles Alumnos</a>
        </div><br><br><br>
            <center><table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>Cargo</th>                    
                    <th>Acciones</th>
                </tr>
                <?php
                while ($fila = mysqli_fetch_assoc($resultadoUsuarios)) {
                    echo "<tr>";
                    echo "<td>" . $fila['id_admin'] . "</td>";
                    $nombreCompleto = implode(' ', [$fila['nombreAa'], $fila['apellidoPa'], $fila['apellidoM']]);
                    echo "<td>" . $nombreCompleto . "</td>";
                    echo "<td>" . $fila['correoA'] . "</td>";
                    echo "<td>" . $fila['telefonoA'] . "</td>";
                    echo "<td>" . $fila['direccionA'] . "</td>";
                    echo "<td>" . $fila['cargoA'] . "</td>";
                    echo "<td><a href='consulta_administrativo.php?id=" . $fila['id_admin'] . "'>Ver Mas...</a></td>";
                    echo "</tr>";
                }
                ?>
            </table></center><br><br>
</body>
    <footer>
    <?php include '../php/footerG.php';?>
    </footer>
</html>  
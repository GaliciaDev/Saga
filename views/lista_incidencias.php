<?php
    include '../php/variabledS.php';
    validarSad();

    include '../php/conexion.php';

    // Consulta para obtener las incidencias desde la base de datos
    $consultaIncidencias = "SELECT * FROM `incidenciasalumnos`";
    $resultadoIncidencias = mysqli_query($conexion, $consultaIncidencias);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idIncidencia = $_POST['id'];
        
        if (isset($_POST['marcarSolucionada'])) {
            // Actualiza el valor de "resuelta" a 1 en la base de datos para marcar como resuelta
            $consulta = "UPDATE incidenciasalumnos SET resuelta = 1 WHERE id = $idIncidencia";
            
            if (mysqli_query($conexion, $consulta)) {
                http_response_code(200); // Respuesta exitosa
            } else {
                http_response_code(500); // Error del servidor
            }
        } elseif (isset($_POST['eliminarIncidencia'])) {
            // Eliminar la incidencia de la base de datos
            $consulta = "DELETE FROM incidenciasalumnos WHERE id = $idIncidencia";
            
            if (mysqli_query($conexion, $consulta)) {
                http_response_code(200); // Respuesta exitosa
            } else {
                http_response_code(500); // Error del servidor
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo_incidencias.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="../css/diseño_movil.css">
        <title>Lista Incidencias</title>
    </head> 
<body>
<?php include '../php/nav_Admin.php'; ?>    
    <h2>Lista de Incidencias</h2>
    <table class="tabla_informacion">
        <tr>
            <th>ID</th>
            <th>Alumno</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Resuelta</th>
            <th>Acciones</th>
        </tr>
        <?php
            while ($fila = mysqli_fetch_assoc($resultadoIncidencias)) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['responsable'] . "</td>";
                echo "<td>" . $fila['tipo_incidencia'] . "</td>";
                echo "<td>" . $fila['descripcion'] . "</td>";
                echo "<td>" . ($fila['resuelta'] == 1 ? 'Resuelta' : 'Sin resolver') . "</td>";
                echo "<td>";
                echo "<form method='post' action='lista_incidencias.php'>";
                echo "<input type='hidden' name='id' value='" . $fila['id'] . "'>";
                echo "<input type='submit' name='marcarSolucionada' value='Marcar como Solucionada'>";
                echo " &ensp; &ensp;<input type='submit' name='eliminarIncidencia' value='Eliminar'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        ?>
        <script>
            function marcarSolucionada(idIncidencia) {
            // Realiza una solicitud AJAX para marcar la incidencia como resuelta
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'marcar_resuelta.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Recarga la página después de marcar como resuelta
                    location.reload();
                }
            };
            xhr.send('id=' + idIncidencia);
            echo '<meta http-equiv="refresh" content="0.5; url=../views/lista_incidencias.php">';
        }

        function eliminarIncidencia(idIncidencia) {
            // Realiza una solicitud AJAX para eliminar la incidencia
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'eliminar_incidencia.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Recarga la página después de eliminar la incidencia
                    location.reload();
                }
            };
            xhr.send('id=' + idIncidencia);
            echo '<meta http-equiv="refresh" content="0.5; url=../views/lista_incidencias.php">';
        }
        </script>        
    </table>
</body>
    <footer>
    <?php include '../php/footerG.php';?>
    </footer>
</html>  
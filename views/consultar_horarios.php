<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/consulta_horarios.css">
    <link rel="shortcut icon" href="../assets/img/icon.png"> 
    <link rel="stylesheet" href="../css/diseño_movil.css"> 
    <title>Consulta de Horarios</title>
</head>
<body>
    <style>.tabla{width: 90%; } </style>
<?php include '../php/nav_Admin.php'; ?>    
    <br><h1>Consulta de Horarios</h1><br><br>     
    <center>              
    <table class="tabla">        
        <tr>
            <th>Grado y Grupo</th>
            <th>Día</th>            
            <th>Horario</th>
            <th>Materia</th>
            <th>Salón</th>
            <th>Profesor</th>
            <th>Turno</th>
            <th>Acciones</th>
        </tr>

        <?php
        include '../php/conexion.php';

        // Verificar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Consulta SQL para obtener los datos de la tabla 'horarios'
        $sql = "SELECT grado_grupo, Dias, Materias, Docentes, Hora, Aula, id_horario, Turno FROM horarios";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los datos en la tabla
            while ($row = $result->fetch_assoc()) {
                $hora = $row["Hora"];
                $turno = $row["Turno"];

                echo "<tr>";
                echo "<td>" . $row["grado_grupo"] . "</td>";
                echo "<td>" . $row["Dias"] . "</td>";
                echo "<td>" . $hora . "</td>";
                echo "<td>" . $row["Materias"] . "</td>";
                echo "<td>" . $row["Aula"] . "</td>";
                echo "<td>" . $row["Docentes"] . "</td>";
                echo "<td>" . $turno . "</td>";
                echo "<td>";
                echo "<button class='eliminar' onclick=\"eliminarFila('" . $row['id_horario'] . "')\">Eliminar</button>";
                echo "<button class='modificar' onclick=\"modificarFila('" . $row['id_horario'] . "')\">Modificar</button>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "No se encontraron resultados.";
        }

        $conexion->close();
        ?>

    </table><br></center>                   

    <script>
function eliminarFila(id) {
    if (confirm("¿Estás Seguro De Eliminar Estos Datos?")) {
        // Crear un objeto XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Configurar una solicitud POST al script PHP que manejará la eliminación
        xhr.open("POST", "../php/eliminar_fila.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Definir la función de callback para manejar la respuesta del servidor
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // La solicitud se completó y el servidor respondió correctamente
                // Aquí puedes manejar la respuesta del servidor, si es necesario
                alert(xhr.responseText); // Esto mostrará el mensaje del servidor en una alerta
            }
        };

        // Preparar los datos que se enviarán al servidor
        var datos = "id=" + encodeURIComponent(id);

        // Enviar la solicitud al servidor
        xhr.send(datos);
    }
}

function modificarFila(id) {
    if (confirm("¿Deseas Modificar Estos Datos?")) {
        // Redirigir al usuario a la página de formulario de actualización
        window.location.href = "../php/actualizar_fila.php?id=" + encodeURIComponent(id);

        window.location.href = url;
    }
}

</script>

</body>
<footer>
<?php include '../php/footerG.php';?>
</footer>
</html>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo_lista_reprobados.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Lista de Reprobados</title>
    </head> 
<body>
<?php include '../php/nav_Admin.php'; ?>
    <!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/estilo_lista_reprobados.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <link rel="stylesheet" href="../css/diseño_movil.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Lista de Reprobados</title>
    </head> 
<body>
    
    <h2><center>Alumnos Reprobados</center></h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Alumnos</th>
            <th>Edad</th>
            <th>Tutor</th>
            <th>Correo</th>
            <th>Grado</th>
            <th>Grupo</th>
            <th>Turno</th>
            <th>Periodo</th>
            <th>Promedio</th>
        </tr>
    <?php
        // Establece la conexión a la base de datos (ajusta la configuración según tus necesidades)
        include '../php/conexion.php';

        // Verifica la conexión
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Consulta SQL para obtener los datos de los alumnos con promedio menor o igual a 60
        $sql = "SELECT A.id_alumno, CONCAT(A.nombre, ' ', A.apellidoP, ' ', A.apellidoM) AS nombre_completo, A.edad, A.tutor, A.correo, A.grado, A.grupo, A.turno, A.periodo, AVG(C.calificacion) AS promedio
                FROM alumnos A
                LEFT JOIN calificaciones C ON A.id_alumno = C.id_alumno
                GROUP BY A.id_alumno
                HAVING promedio <= 60
                ORDER BY A.grado, A.id_alumno";

        $result = $conexion->query($sql);

        // Imprimir los datos de los alumnos reprobados
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id_alumno'] . "</td>";
            echo "<td>" . $row['nombre_completo'] . "</td>";
            echo "<td>" . $row['edad'] . "</td>";
            echo "<td>" . $row['tutor'] . "</td>";
            echo "<td>" . $row['correo'] . "</td>";
            echo "<td>" . $row['grado'] . "</td>";
            echo "<td>" . $row['grupo'] . "</td>";
            echo "<td>" . $row['turno'] . "</td>";
            echo "<td>" . $row['periodo'] . "</td>";
            echo "<td>" . $row['promedio'] . "</td>";
            echo "</tr>";
        }

        // Cierra la conexión a la base de datos
        $conexion->close();
    ?>
    </table>
</body>
<footer>
    <p>&copy; 2023 SAGA.</p>
    <p>Contáctanos: info@example.com</p>
</footer>
</html>

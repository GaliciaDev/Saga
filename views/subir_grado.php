<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/nivel.css">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="../css/diseño_movil.css">
        <title>Subir Grado</title>
    </head> 
<body>
<?php include '../php/nav_Admin.php'; ?>

        <h1>Subir Grado</h1>
        <form action="../php/subir_grado.php" method="post">
            <input type="submit" name="egresar_alumnos" value="Egresar Alumnos de 3er Grado">
            <input type="submit" name="aumentar_grado" value="Aumentar Grado de Alumnos de 1er y 2do Grado">                        
            <input type="submit" name="eliminar_registros" value="Alumnos Egresados Borrar Registros">
        </form>
        <br><table>
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
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
            // Establecer la conexión a la base de datos (debes completar esto con tus propios datos de conexión)
            include '../php/conexion.php';
            
            // Verificar la conexión
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }

            // Consulta SQL para obtener los datos de la tabla "alumnos" que no estén en "alumnos_egresados" y ordenados por grado
            $sql = "SELECT a.id_alumno, CONCAT(a.nombre, ' ', a.apellidoP, ' ', a.apellidoM) AS nombre_completo, a.edad, a.tutor, a.correo, a.grado, a.grupo, a.turno, a.periodo, AVG(c.calificacion) AS promedio
            FROM alumnos a
            LEFT JOIN calificaciones c ON a.id_alumno = c.id_alumno
            WHERE a.id_alumno NOT IN (SELECT id_alumno FROM alumnos_egresados)
            GROUP BY a.id_alumno
            ORDER BY a.grado, a.id_alumno";

            $result = $conexion->query($sql);

            // Imprimir los datos de los alumnos
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_alumno'] . "</td>";
                echo '<input type="hidden" name="id_alumno" value="' . $row['id_alumno'] . '">';
                echo "<td>" . $row['nombre_completo'] . "</td>";
                echo '<input type="hidden" name="nombre_completo" value="' . $row['nombre_completo'] . '">';
                echo "<td>" . $row['edad'] . "</td>";            
                echo "<td>" . $row['tutor'] . "</td>";                
                echo "<td>" . $row['correo'] . "</td>";
                echo "<td>" . $row['grado'] . "</td>";
                echo '<input type="hidden" name="grado" value="' . $row['grado'] . '">';
                echo "<td>" . $row['grupo'] . "</td>";
                echo '<input type="hidden" name="grupo" value="' . $row['grupo'] . '">';
                echo "<td>" . $row['turno'] . "</td>";
                echo "<td>" . $row['periodo'] . "</td>";
                echo '<input type="hidden" name="periodo" value="' . $row['periodo'] . '">';
                
                // Aquí calculamos el promedio
                $id_alumno = $row['id_alumno'];
                $sqlPromedio = "SELECT AVG(calificacion) AS promedio FROM calificaciones WHERE id_alumno = $id_alumno";
                $resultPromedio = $conexion->query($sqlPromedio);
                $rowPromedio = $resultPromedio->fetch_assoc();
                echo "<td>" . $rowPromedio['promedio'] . "</td>";
            
                echo "</tr>";
            }

            // Cerrar la conexión a la base de datos
            $conexion->close();
            ?>
        </table><br>
</body><br>
    <footer>
        <p>&copy; 2023 SAGA.</p>
        <p>Contáctanos: info@example.com</p>
    </footer>
</html>  
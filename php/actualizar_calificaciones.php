<?php
// Conexión a la base de datos
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados por la solicitud AJAX
    $idMateria = $_POST["id_materia"];
    $calif1 = $_POST["calif1"];
    $calif2 = $_POST["calif2"];
    $calif3 = $_POST["calif3"];
    $faltas1 = $_POST["faltas1"];
    $faltas2 = $_POST["faltas2"];
    $faltas3 = $_POST["faltas3"];

    // Consulta para actualizar los datos en la base de datos
    $actualizarQuery = "UPDATE materias SET Calificacion_1 = '$calif1', Calificacion_2 = '$calif2', Calificacion_3 = '$calif3', Faltas_1 = '$faltas1', Faltas_2 = '$faltas2', Faltas_3 = '$faltas3' WHERE id_materia = '$idMateria'";

    if (mysqli_query($conexion, $actualizarQuery)) {
        // Éxito: redireccionar de vuelta a modificar_calificacion_D.php
        header("Location: ../views/modificar_calificacion_D.php");
        exit(); // Asegura que el script se detenga aquí
    } else {
        // Error: redireccionar de vuelta a modificar_calificacion_D.php con un mensaje de error
        header("Location: ../views/modificar_calificacion_D.php?error=" . urlencode(mysqli_error($conexion)));
        exit(); // Asegura que el script se detenga aquí
    }
} else {
    // Si no es una solicitud POST, redirigir o mostrar un mensaje de error
    http_response_code(400);
    echo "Solicitud no válida.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
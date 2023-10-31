<?php
// Conectar a la base de datos (configura las credenciales adecuadamente)
include 'conexion.php';

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los valores enviados por la solicitud AJAX
$id = $_POST["id"];

// Consulta SQL para eliminar la fila
$sql = "DELETE FROM `horarios` WHERE `id_horario` = '$id'";

if ($conexion->query($sql) === TRUE) {
    // La fila se eliminó correctamente
    echo "Fila eliminada correctamente";        
} else {
    // Error al eliminar la fila
    echo "Error al eliminar la fila: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
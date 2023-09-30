<?php
// Conectar a la base de datos (configura las credenciales adecuadamente)
$servername = "localhost";
$username = "DBA-Saga";
$password = "srvtySDL&";
$dbname = "sagadb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los valores enviados por la solicitud AJAX
$id = $_POST["id"];

// Consulta SQL para eliminar la fila
$sql = "DELETE FROM `horarios` WHERE `id_horario` = '$id'";

if ($conn->query($sql) === TRUE) {
    // La fila se eliminó correctamente
    echo "Fila eliminada correctamente";        
} else {
    // Error al eliminar la fila
    echo "Error al eliminar la fila: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
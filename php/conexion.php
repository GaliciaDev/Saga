<?php
// Variables
$conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&", "sagadb"); //localhost, DBA-Saga, srvtySDL&, sagadb

mysqli_select_db($conexion, "sagadb");

// Verificar si la conexión tuvo éxito
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
} else {
    // Conexión exitosa
    // Comentario opcional
    // echo 'Conexión exitosa al Host-DB';
}
?>
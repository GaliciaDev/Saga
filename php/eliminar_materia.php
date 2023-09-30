<?php
if (isset($_GET['id'])) {
    // Conexión a la BD
    $conexion = mysqli_connect("localhost", "DBA-Saga", "srvtySDL&");
    mysqli_select_db($conexion, "sagadb");

    // Obtener el ID de la materia a eliminar
    $id = $_GET['id'];

    // Consulta para eliminar la materia
    $query_eliminar = "DELETE FROM tira_materias WHERE id = '$id'";
    $resultado_eliminar = mysqli_query($conexion, $query_eliminar);

    if ($resultado_eliminar) {
        // Redireccionar de nuevo a la página original después de eliminar
        header("Location: ../views/modificar_materias.php");
        exit;
    } else {
        echo 'Error al eliminar la materia: ' . mysqli_error($conexion);
    }
} else {
    echo 'ID no válido para eliminar.';
}
?>
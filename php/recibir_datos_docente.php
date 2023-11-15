<?php
if ($_POST) {
    $Matricula_D = $_POST['id_docente'];
    $Nombre = $_POST['nombreD'];
    $ApellidoP = $_POST['apellidoPd'];
    $ApellidoM = $_POST['apellidoMd'];
    $FechaNac = $_POST['natalicioD'];
    $Edad = $_POST['edad'];
    $Domicilio = $_POST['direccionD'];
    $Telefono = $_POST['telefonoD'];
    $Telefono_Emg = $_POST['telefonoEd'];
    $Genero = $_POST['sexoD'];
    $Correo = $_POST['correoD'];
    $Cargo = $_POST['cargoD'];
    $Area = $_POST['areaD'];
    $Turno = $_POST['turno'];
    $Clave = password_hash($_POST['Clave'], PASSWORD_BCRYPT);

    include 'conexion.php';    

    // Validar si la matrícula ya existe
    $consulta_matricula = "SELECT id_docente FROM docentes WHERE id_docente = '$Matricula_D'";
    $resultado_matricula = mysqli_query($conexion, $consulta_matricula);

    if (mysqli_num_rows($resultado_matricula) > 0) {
        echo 'La matrícula ya existe. Por favor, elija otra.';
		echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../views/registro_docentes.php">';
    } else {
        // Si la matrícula no existe, procede con la inserción
        $consulta_insertar = "INSERT INTO `docentes`(`id_docente`, `nombreD`, `apellidoPd`, `apellidoMd`, `edad`, `sexoD`, `direccionD`, `telefonoD`, `cargoD`, `correoD`, `areaD`, `natalicioD`, `telefonoEd`, `Clave`, `turno`) VALUES ('$Matricula_D','$Nombre','$ApellidoP','$ApellidoM','$Edad','$Genero','$Domicilio','$Telefono','$Cargo','$Correo','$Area','$FechaNac','$Telefono_Emg', '$Clave' ,'$Turno');";

        $Resultado = mysqli_query($conexion, $consulta_insertar);

        if ($Resultado == true) {
            echo '<html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">                
                <title>Centrado de mensaje de carga</title>
            </head>
            <body>
                <div class="loader-container">
                    <div class="loader-message">Datos Registrados...</div>
                </div>
            </body>
            </html>
            <style>
                .loader-container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: rgba(0, 0, 0, 0.5);
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    z-index: 9999;
                }
                
                .loader-message {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 5px;
                    font-size: 18px;
                }
            </style>';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../views/registro_docentes.php">';
        } else {
            echo "ERROR En La Consulta";
            mysqli_close($conexion);
        }
    }
} else {
    echo "ERROR";
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="5;URL=index_administrativo.php>';
}
?>
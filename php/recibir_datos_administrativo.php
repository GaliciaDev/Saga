<?php
if ($_POST) {
    $Matricula = $_POST['id_admin'];
    $Nombre_adm = $_POST['nombreAa'];
    $ApellidoP_adm = $_POST['apellidoPa'];
    $ApellidoM_adm = $_POST['apellidoM'];
    $FechaNac_adm = $_POST['natalicioA'];
    $Edad_adm = $_POST['edadA'];
    $Domicilio_adm = $_POST['direccionA'];
    $Telefono_adm = $_POST['telefonoA'];
    $Telefono_Emg_adm = $_POST['telefonoEa'];
    $Genero_adm = $_POST['sexoA'];
    $Correo_adm = $_POST['correoA'];
    $Cargo_adm = $_POST['cargoA'];
    $Area_adm = $_POST['areaA'];
    $Turno_adm = $_POST['turno'];
    $Password_adm = password_hash($_POST['Clave_adm'], PASSWORD_BCRYPT);

    include 'conexion.php';

    // Validar si la matrícula ya existe
    $consulta_matricula = "SELECT id_admin FROM administrativo WHERE id_admin = $Matricula";
    $resultado_matricula = mysqli_query($conexion, $consulta_matricula);

    if (mysqli_num_rows($resultado_matricula) > 0) {
        echo 'La matrícula ya existe. Por favor, elija otra.';
    } else {
        // Si la matrícula no existe, procede con la inserción
        $consulta_insertar = "INSERT INTO `administrativo`(`id_admin`, `nombreAa`, `apellidoPa`, `apellidoM`, `Horario_Adm`, `telefonoEa`, `edadA`, `sexoA`, `natalicioA`, `direccionA`, `telefonoA`, `cargoA`, `correoA`, `areaA`, `Clave_adm`, `turno`) VALUES ($Matricula,'$Nombre_adm','$ApellidoP_adm','$ApellidoM_adm', NULL, '$Telefono_Emg_adm','$Edad_adm','$Genero_adm','$FechaNac_adm','$Domicilio_adm','$Telefono_adm','$Cargo_adm','$Correo_adm','$Area_adm','$Password_adm', '$Turno_adm');";

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
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../views/registro_administrativo.php">';
        } else {
            echo "ERROR En La Consulta";
            mysqli_close($conexion);
        }
    }
} else {
    echo "ERROR";
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=index_administrativo.php>';
}
?>
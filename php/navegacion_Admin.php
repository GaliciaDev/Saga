<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/diseño_movil.css">
</head>
<body>
    <header>
        <?php
        include 'conexion.php';

        if (!isset($_SESSION['admin'])) {
            $matricula = $_SESSION['admin'];
            $nombreCompleto = "";

            $sql = "SELECT nombreA, apellidoPa, apellidoM FROM administrativo WHERE matricula = '$matricula'";

            $resultado = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($resultado) > 0) {
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $nombreCompleto = $row['nombreA'] . ' ' . $row['apellidoPa'] . ' ' . $row['apellidoM'];
                }
            }
            echo '<div class="sesion-info">';
            echo '<span>' . $matricula . ' | ' . $nombreCompleto . '</span>';
            echo '</div>';
        }
        ?>
        <div class="menu">
            <label for="menu" class="menu-icono">&#9776;</label>
            <div class="logo"></div>
                <input type="checkbox" id="menu">
            <nav class="navbar menu">                
            <ul class="menu">
                <li class="dropdown">
                    <button class="dropbtn">Horarios</button>
                    <div class="dropdown-content">
                        <a href="views/asignar_horarios_alumnos.php">Asignar Horarios</a>
                        <a href="views/consultar_horarios.php">Consulta Horarios</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropbtn">Captura Calificaciones</button>
                    <div class="dropdown-content">
                        <a href="views/modificar_calificacion.php">Modificar Calificacion</a>
                        <a href="views/capturar_calif_definitiva.php">Captura Trimestral</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropbtn">Materias</button>
                    <div class="dropdown-content">
                        <a href="views/asignar_materia.php">Asignar Materias</a>
                        <a href="views/modificar_materias.php">Modificar Materias</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropbtn">Subir Grado</button>
                    <div class="dropdown-content">
                        <a href="views/subir_grado.php">Aumentar Grado</a>
                        <a href="views/lista_reprobados.php">Lista Reprobados</a>
                        <a href="views/lista_egresados.php">Lista Egresados</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropbtn">Estadisticas Alumnos</button>
                    <div class="dropdown-content">
                        <a href="views/estadisticas_alumno.php">Alumno</a>
                        <a href="views/estadistica_grupal.php">Grupal</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropbtn">Perfiles</button>
                    <div class="dropdown-content">
                        <a href="views/registro_alumnos.php">Registro Alumnos</a>
                        <a href="views/registro_docentes.php">Registro Docentes</a>
                        <a href="views/registro_administrativo.php">Registro Administrativo</a>
                        <a href="views/lista_perfiles.php">Lista Perfiles</a>
                    </div>
                </li>
                <li class="dropdown">
                    <button class="dropbtn">Incidencias</button>
                    <div class="dropdown-content">
                        <a href="views/incidencias.php">Registro Incidencias</a>
                        <a href="views/lista_incidencias.php">Lista de Incidencias</a>
                    </div>
                </li>
                <li><a href="views/contactos_tutores.php">Contacto Tutores</a></li>
                <li><a href="php/cerrar_sesion.php">Cerrar Sesion</a></li>
            </ul>           
            </nav>
        </div>        
    </header>
</body>
</html>
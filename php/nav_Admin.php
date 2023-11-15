<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CSS Menu responsivo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>    
        ul {
            list-style-type:none;
            margin:0;
            padding:0;
            position: absolute;
            justify-content: center;
            display: flex;
            width: 100%;
        }

        li {
            display:inline-block;
            float: left;
            margin-right: 1px;
        }

        /* Estilo para los links */
        li a {
            background: rgb(117, 117, 117);
            color: #FFF;
            min-width: 180px;
            transition: background 0.5s, color 0.5s, transform 0.5s;
            margin: 0px 6px 6px 0px;
            padding: 20px 40px;
            box-sizing: border-box;
            border-radius: 3px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
            position: relative;
            justify-content: center;
            display: flex;
        }

        li:hover a {
            background: #72d9fb;
        }

        li:hover ul a {
            background: #e1e1e1;
            color: #222;
            height: 35px;
            line-height: 35px;
        }

        /* Hover para enlaces desplegados */
        li:hover ul a:hover {
            background: #2598c3;
            color: #fff;
        }

        /* Ocultar enlaces desplegables hasta que se necesiten */
        li ul {
            display: none;
        }

        /* Hacer vínculos desplegables verticales */
        li ul li {
            display: block;
            float: none;
        }

        li ul li a {
            width: 12%;
            justify-content: center;
            display: flex;
            text-align: center;
            min-width: 100px;
            padding: 0 19px;
            top: -6px;
            left: 10px;	
            transition: opacity 0.5, transform 0.2s;
        }

        /* Visualizar el menú desplegable en hover */
          li:hover > ul,
          li ul:hover {
              display: block;
          }        

        /* Estilos boton desplegar menu */
        .show-menu {
            display: none;
        }

        .menu-icon {
            cursor: pointer;
        }

        input[type=checkbox] {
            display: none;
        }

        /* Mostrar menú cuando se marca la casilla de verificación invisible */
        input[type=checkbox]:checked ~ #menu {
            display: block;
        }

        .submenu {
          background:   gray;
        }

        .icono {
          display: none;
        }

        /* Estilo responsivo ancho menor de 750px */
        @media screen and (max-width: 750px) {
            /* Hacer que los vínculos desplegables aparezcan en línea */
            ul {
                position: static;
                display: none;
            }
            /* Crear espacio vertical */
            li {
                margin-bottom: 1px;
            }
            /* Todos los enlaces del menú de ancho completo */
            ul li li a {
                width: 100%;
            }

            .show-menu {
                display: block;
                cursor: pointer;
            }

            .icono {
              display: block;
              width: 50px;
              height: 50px;
              margin-left: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <label for="show-menu" class="menu-icon">            
            <img class="icono" src="../assets/img/icono_menu.png" alt="Menú"><br><br>
        </label>
        <input type="checkbox" id="show-menu" role="button">
        <ul id="menu">
            <li><a href="../index_administrativo.php">Inicio</a></li>
            <li>
                <a href="#">Horarios</a>
                <ul class="hidden">
                    <li><a href="asignar_horarios_alumnos.php">Asignar Horarios</a></li>
                    <li><a href="consultar_horarios.php">Consulta Horarios</a></li>
                    <li>
                        <a href="#">Materias &emsp; ↓</a>
                        <ul class="hidden">
                            <li><a href="asignar_materia.php">Asignar Materias</a></li>
                            <li><a href="modificar_materias.php">Modificar Materias</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Captura Calificaciones</a>
                <ul class="hidden">
                    <li><a href="modificar_calificacion.php">Modificar Calificacion</a></li>
                    <li><a href="capturar_calif_definitiva.php">Captura Trimestral</a></li>
                    <li>
                      <a href="#">Estadisticas Alumnos &emsp;↓</a>
                      <ul class="hidden">
                        <li><a href="estadisticas_alumno.php">Alumno</a></li>
                        <li><a href="estadistica_grupal.php">Grupal</a></li>
                      </ul>
                    </li>
                </ul>
            </li>                                   
            <li>
                <a href="#">Perfiles</a>
                <ul class="hidden">
                    <li><a href="registro_alumnos.php">Registro Alumnos</a></li>
                    <li><a href="registro_docentes.php">Registro Docentes</a></li>
                    <li><a href="registro_administrativo.php">Registro Administrativo</a></li>
                    <li><a href="lista_perfiles.php">Lista Perfiles</a></li>
                    <li>
                      <a href="#" class="submenu">Incidencias &emsp;↓</a>
                        <ul class="hidden">
                          <li><a href="incidencias.php">Registro Incidencias</a></li>
                          <li><a href="lista_incidencias.php">Lista de Incidencias</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="contactos_tutores.php">Contacto Tutores</a></li>
            <li><a href="../php/cerrarsesion.php">Cerrar Sesion</a></li>
        </ul>
    </header>
    <br><br><br>
</body>
</html>                
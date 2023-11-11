<!doctype html>
<!--[if lte IE 9]>
<html lang="en" class="oldie">
<![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" media="all" href="css/Estilo_Nav_Admin.css" />
</head>
<header>
<nav>
		<menu>
			<menuitem id="demo1">
				<a>Horarios</a>
				<menu>
					<menuitem><a href="views/asignar_horarios_alumnos.php">Asignar Horarios</a></menuitem>
                    <menuitem><a href="views/consultar_horarios.php">Consulta Horarios</a></menuitem>               					
				</menu>
			</menuitem>
            <menuitem id="demo1">
				<a>Captura Calificaciones</a>
				<menu>
					<menuitem><a href="views/modificar_calificacion.php">Modificar Calificacion</a></menuitem>
                    <menuitem><a href="views/capturar_calif_definitiva.php">Captura Trimestral</a></menuitem>               				
                <menuitem>
                  <a>Materias</a>
                  <menu>
                    <menuitem><a href="views/asignar_materia.php">Asignar Materias</a></menuitem>
                    <menuitem><a href="views/modificar_materias.php">Modificar Materias</a></menuitem>          
                  </menu>  
               </menuitem>    					
				</menu>
			</menuitem>            
            <menuitem id="demo1">
				<a>Estadisticas Alumnos</a>
				<menu>                                                  
					<menuitem><a href="views/estadisticas_alumno.php">Alumno</a></menuitem>
                    <menuitem><a href="views/estadistica_grupal.php">Grupal</a></menuitem>   
                <menuitem>
                  <a>Incidencias</a>
                  <menu>
                    <menuitem><a href="views/incidencias.php">Registro Incidencias</a></menuitem>
                    <menuitem><a href="views/lista_incidencias.php">Lista de Incidencias</a></menuitem>               				                              
                  </menu>  
               </menuitem>            				                    
				</menu>
			</menuitem>
            <menuitem id="demo1">
				<a>Perfiles</a>
				<menu>                                                                                          
					<menuitem><a href="views/registro_alumnos.php">Registro Alumnos</a></menuitem>
                    <menuitem><a href="views/registro_docentes.php">Registro Docentes</a></menuitem>               				
                    <menuitem><a href="views/registro_administrativo.php">Registro Administrativo</a></menuitem>
                <menuitem>
                  <a>Lista de Perfiles</a>
                  <menu>
                     <menuitem><a href="views/lista_perfiles.php">Perfiles Administrativos</a>  </menuitem>
                     <menuitem><a href="views/lista_perfiles_D.php">Perfiles Docentes</a></menuitem>
                     <menuitem><a href="views/lista_perfiles_A.php">Perfiles Alumnos</a></menuitem>                     
                  </menu>  
               </menuitem>
				</menu>
			</menuitem>            
         <menuitem><a href="views/contactos_tutores.php">Contacto Tutores</a></menuitem>
         <menuitem><a href="php/cerrarsesion.php">Cerrar Sesion</a></menuitem>
		</menu>
	</nav>
</header>
<body>
</body>
</html>
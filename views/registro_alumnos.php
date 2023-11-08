<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/registro_alumno.css">
        <link rel="stylesheet" href="../css/diseño_movil.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="../assets/img/icon.png">
        <title>Formulario Alumnos</title>
    </head>
<body>
    <form class="registro" action="../php/recibir_datos_alumno.php" method="post" id="registro_docente" name="Contacto">
        <div id="Campos">
            <h4 class="titulo">Registro de Alumnos</h4>
            <label class="matri">Matricula</label>
                <input class="mat" autofocusu type="text" name="id_alumno" placeholder="Introduzca su Matricula" required><br><br>
            <label class="nom">Nombre</label>
                <input class="nombre" autofocusu type="text" name="nombre" placeholder="Introduzca su Nombre" required><br><br>
            <label class="nom">Apellido Paterno</label>
                <input class="apell" autofocusu type="text" name="apellidoP" placeholder="Apellido Paterno" required><br><br>
            <label class="nom">Apellido Materno</label>
                <input class="apell" autofocusu type="text" name="apellidoM" placeholder="Apellido Materno" required><br><br>
            <label class="ed">Edad</label>
                <input class="edad" type="number" name="edad" min="11" max="99" placeholder="- -" required><br><br>           
            <label class="domi">Dirrecion</label>
            <input class="domicilio" type="text" name="domicilio" placeholder="Donde Vive" required><br><br>
            <label class="ge">Genero</label><br>
                <label class="Etiquetas">Hombre</label><input class="genero" type="radio" name="sexo" value="Hombre">
                <label class="Etiquetas">Mujer</label><input class="genero" type="radio" name="sexo" value="Mujer"><br><br>            
            <label class="corr">Correo Electronico</label>
                <input class="correito" type="email" name="correo" placeholder="Ejemplo@example.com" required class="formulario"><br><br>            
            <label class="fe">Fecha de Nacimiento</label>
                <input class="na" type="date" name="natalicio" class="CajasL" required><br><br>
            <label class="nomt">Nombre Tutor</label>
                <input class="nombret" autofocusu type="text" name="tutor" placeholder="Nombre Completo" required><br><br>
            <label class="tel"> Telefono Tutor</label>
                <input class="reg" type="number" name="telefono"placeholder="10 Digitos" min="10" required><br><br>
            <label class="g">Grado</label>
                <input class="gr" type="number" name="grado" placeholder="Grado" required>
            <label class="g">Grupo</label>

            <script>
                function convertirAMayusculas(input) {
                    input.value = input.value.toUpperCase();
                }
            </script>


                <input class="gr" type="text" name="grupo" placeholder="Grupo" oninput="convertirAMayusculas(this)" required>
            <label class="turno">Turno</label>
                <select class="turn" name="turno" required>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
                <label class="con">Contraseña</label>
                    <input class="pass" type="password" placeholder="Preferible Caracteres Especiales" name="Clave_A" class="formulario" id="password" required><br>
                <label class="con">Confirmar Contraseña</label>
                    <input class="pass" type="password" placeholder="Repita su Contraseña" name="clave_confi" class="formulario" id="confirmPassword" required><br><br>

                    <script>
                        document.getElementById('registro_docente').addEventListener('submit', function(event) {
                            var password = document.getElementById('password').value;
                            var confirmPassword = document.getElementById('confirmPassword').value;

                            if (password !== confirmPassword) {
                                alert('Las contraseñas no coinciden. Por favor, vuelva a ingresarlas.');
                                event.preventDefault(); // Evita que se envíe el formulario
                            }
                        });
                    </script>

            <input class="btnguardar" name="Enviar" type="submit" id="btnEnviar" value="Agregar"><br><br><br>
        </div>
        
        <div id="Botones">
            <img src="../assets/img/img2.png" style="width: 100%;" />
            <input class="btnlimpiar" name="Limpiar" type="reset" id="btnResetear" value="Limpiar"><br><br>                    
            <a href="consultar_alumnos.php"><input class="btnconsulta" name="Consultar" type="button" id="btnSalir" value="Consultar y Actualizar"></a><br><br><br>
            <a href="eliminar_alumno.php"><input class="btneliminar" name="Consultar" type="button" id="btnSalir" value="Eliminar"></a><br><br><br>            
            <a href="../index_administrativo.php"><input class="btnsalir" name="Salir" type="button" id="btnSalir" value="Salir"></a><br><br>
            <img src="../assets/img/img3.png" style="width: 100%;" />
        </div>
    </form>
</body>
    <footer>
    <?php include '../php/footerG.php';?>
    </footer>
</html>
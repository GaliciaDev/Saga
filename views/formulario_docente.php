<?php
    include '../php/variabledS.php';
    verificarSd();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="shortcut icon" href="../assets/img/icon.png">
    <link  rel="stylesheet" href="../css/iniciodsesionD.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-inicio">
                    <h3>¿La recordaste?</h3>
                    <p>Accede para revisar tus calificaciones</p>
                    <button id="btnIniciarSesion">Iniciar sesion</button>

                </div>
            
                <div class="caja__trasera-registro">
                    <h3>¿Olvidaste tu contraseña?</h3>
                    <p>Sigue los siguientes pasos para recuperarla</p>
                    <button id="btnRegistro">Recuperar</button>
                </div>    
            </div>

            <!-- Formularios de inicio de R-I -->
            <div class="registros">
                 <form action="../php/validacionD.php" method="POST" class="inicioDs">
                    <h2>Iniciar sesión</h2>
                    <input type="text" autofocus placeholder="Matricula" name="matricula">
                    <input type="password" placeholder="Contraseña" name="clave">
                    <button>Entrar</button>
                    
                 </form>

                 <form action="../php/recuperCD.php" method="POST" class="recuperarC ocultar">
                    <h2>Recuperar Cuenta</h2>
                    <input type="text" placeholder="Matricula" name="matricula">
                    <input type="text" placeholder="Nombre Completo" name="nombre">                    
                    <input type="email" placeholder="Correo Electronico" name="correo">                                        
                    <input type="password" placeholder="Nueva Contraseña" name="clave">
                    <input type="password" placeholder="Confirmar Contraseña" name="clave2">
                    <button type="submit" name="recuperar">Recuperar Contraseña</button>
                </form>
                
            </div>
        </div>
    </main>  
    
    <script src="../js/modules/animacionformulariosD.js"></script>
</body>
</html>
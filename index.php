<?php
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/icon.png">    
    <title>EST 153</title>
    <link rel="stylesheet" href="css/indexP.css">
</head>
<body>
    <!-- Informacion de navegacion -->
    <header class="header">

        <!-- Menu de navegacion [Logo-Lista] -->
        <div class="menu container">
            
            <a href="#" class="logo" ></a>
            <input type="checkbox" id="menu"/>
            <label for="menu">
                <img src="/assets/img/menu1.jpg" class="menu-icono" alt=""/>
            </label>

            <nav class="navbar">
                <ul>
                    <li><a href="https://www.facebook.com/tecnicabasiliovadillo.turnovespertino.9/?locale=es_LA%22%20class%3D%22nav__links%22">Nosotros</a></li>
                    <li><a href="../saga/views/formulario_alumnos.php">Alumnos</a></li>
                    <li><a href="../saga/views/formulario_docente.php">Docentes</a></li>
                    <li><a href="../saga/views/formulario_tutores.php">Tutores</a></li>
                    <li><a href="../saga/views/formulario_administradores.php">Administrativo</a></li>
                </ul>
            </nav>  
       </div>

       <!-- Informacion -->
       <div class="header-content container">
            <div class="header-txt">
                <h1>Escuela secundaria tecnica 153</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur a
                    dipisicing elit. Quisquam, voluptatum.
                </p>
                <a href="#" class="btn-1">Informacion</a>
            </div>
       </div>
    </header>

    <!--Informacion de contacto cliente-->
    <section class="direction container">
        <p>CMDX Lorem</p>
        <p>info@info.com</p>
        <p>555-555-5555</p>
    </section>

    <!-- Informacion y contenedor de la imagen -->
    <section class="about container">

        <div class="about-img">
            <img src="/assets/img/menu1.jpg" alt="">
        </div>

        <div class="about-txt">
            <h2>Nosotros</h2>
            <p>
                Lorem, ipsum dolor sit amet consectetur a
                dipisicing elit. Neque, nostrum voluptatem? Esse sequi magnam temporibus illum alias, atque sint maiores, expedita inventore quo nihil ea non quidem eius laboriosam sunt.
            </p>
            <a href="#" class="btn-1">Informacion</a>
        </div>
    </section>

    <!-- Contenido principal, oferta de servicios -->
    <main class="information container">
        
        <div class="information-1">
            <h3>15</h3>
            <p>Mansiones</p>            
        </div>

        <div class="information-1">
            <h3>185</h3>
            <p>Casas</p>
        </div>

        <div class="information-1">
            <h3>110</h3>
            <p>Alumnos</p>
        </div>

        <div class="information-1">
            <h3>20</h3>
            <p>Docentes</p>
        </div>
    </main>

    <!-- Productos -->
    <section class="house">
        <!-- Agregando 2 clases -->
        <div class="house-1 txt">
            <span>01</span>
            <h3>Tramites</h3>
            <p>Disponible</p>
        </div>

        <div class="house-2 txt">
            <span>02</span>
            <h3>Informacion de ingreso</h3>
            <p>Disponible</p>
        </div>

        <div class="house-3 txt">
            <span>03</span>
            <h3>Casa lorem</h3>
            <p>Disponible</p>
        </div>

        <div class="house-4 txt">
            <span>04</span>
            <h3>Casa lorem</h3>
            <p>Disponible</p>
        </div>

        <div class="house-5 txt">
            <span>05</span>
            <h3>Casa lorem</h3>
            <p>Disponible</p>
        </div>
    </section>

    <?php include_once 'php/footer.php';?>


</body>
</html>
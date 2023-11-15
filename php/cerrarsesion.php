<?php
	session_start();
	session_unset();
	session_destroy();
	echo '<link rel="stylesheet" type="text/css" href="css/estilos_login.css">';	
	echo '<link rel="icon" type="image/png" href="../assets/img/icon.png"/>';
	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../index.php">';
?>

<html>
	<head>
		<title>Cerrando sesion...</title>
	</head>

<body>
<div class="container">
  <div class="cargando">
    <div class="pelotas"></div>
    <div class="pelotas"></div>
    <div class="pelotas"></div>
    <span class="texto-cargando">Cerrando Sesión...</span>
  </div>
</div>
</body>
	<style>
		@import url('//fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,800&display=swap');

		body{
			font-family: 'Montserrat', sans-serif;
			font-weight: 800;
			background-color: #FFF;
			color: #944d1e;
		}
		/* ======================== */
		.container{   
		display: grid;
			place-content: center;
			height: 100vh;
		}
		.cargando{
			width: 160px;
			height: 30px;
			display: flex;
			flex-wrap: wrap;
			align-items: flex-end;
			justify-content: space-between;
		margin: 0 auto; 
		}
		.texto-cargando{ 
		padding-top:20px
		}
		.cargando span{
			font-size: 20px;
			text-transform: uppercase;
		}
		.pelotas {
			width: 30px;
			height: 30px;
			background-color: #944d1e;
			animation: salto .5s alternate
			infinite;
		border-radius: 50%  
		}
		.pelotas:nth-child(2) {
			animation-delay: .18s;
		}
		.pelotas:nth-child(3) {
			animation-delay: .37s;
		}
		@keyframes salto {
			from {
				transform: scaleX(1.25);
			}
			to{
				transform: 
				translateY(-50px) scaleX(1);
			}
		}
	</style>
</html>
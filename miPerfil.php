<!DOCTYPE html>
<?php	 
	require_once __DIR__.'/config.php'; 
	require_once __DIR__.'/muestraPerfil.php';
?>
<html>
  
	<head>
		<title>Perfil</title>

		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		
		<link id="estiloLogin" href="estiloUsuario.css" rel="stylesheet" type="text/css" /> 
		<link rel="stylesheet" type="text/css" href="estiloUsuario.css" />
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="lateral_izquierdo.css" />
		<link rel="stylesheet" type="text/css" href="lateral_derecho.css" />
		<link rel="stylesheet" type="text/css" href="centro.css" />
		<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>  
		<link rel="icon" href="img/logogrande.png" type="image/png">

	</head>
	
	<body>
		<?php
			if(isset($_SESSION['login'])){
				if($_SESSION['admin'] == true)
					header("Location: registroAdmin.php");
			}
			else header("Location: default.php");
		?>
		<div id= "contenedor">
			
			<!-- Esto es la cabecera -->
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			<!-- -------------------------------->
			
			<!-- Contenedor siguiendo-->
			<div id="contenedorIzquierdo">	
				
				<h2>MI PERFIL</h2>	
				
				<div id ="fondoAvatar" class="colorPerfil">
					<?php
						//$nombre = $_SESSION["user"];
					?>
					<?php
						echo cargaMiPerfil($_SESSION["user"]);
					?>
				</div>
				
				<button type="submit" id="botonPerfil" onclick="window.location.href='escribirNoticia.php';"><img id="logosPerfil" src="img/escribir.png" width="35" height="35" />Escribir noticia</button>
				<button type="submit" id="botonPerfil" onclick="window.location.href='logout.php';"><img id="logosPerfil" src="img/cerrarsesion.png" width="35" height="35" />cerrar <br>sesión</button>
				
				<div id="menuScroll">
					<div id = "Avatares">
						<?php 
							echo cargaAmigos($_SESSION["user"]);
						?>		
					</div>
				</div>
			</div>
			<!-- -------------------------------->
			
			<!-- Contenedor Peliculas y compradas-->
			<div id="contenidoCentral">
				
				<div id="tituloCentro">
					<h1> VALORADAS POR EL USUARIO </h1>
					<?php
					echo cargaValoradas($_SESSION["user"]);
					?>
				</div>

				
				<div id="tituloCentro">
					<h1> COMPRADAS POR EL USUARIO </h1>
					<?php
					echo cargaCompradas($_SESSION["user"]);
					?>
					
				</div>
			</div>
			<!--Contenedor Peliculas y compradas -------------------------------->
			
			<!-- Contenedor recomendaciones-->
			<div id="contenedorDerecho">
				<h2>RECOMENDACIONES</h2>
						
				
				<div id="estiloRecomendado">
					<div id="menuScroll">
						<ul>
							<?php
							echo cargaRecomendadas($_SESSION["user"]);
							?>
						</ul>
					</div>
				</div>
			
			</div>
			<!--Contenedor sugerencias -------------------------------->
			
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
			
		</div>  <!-- contenedor cierre-->
	  
	</body>
	 
</html>
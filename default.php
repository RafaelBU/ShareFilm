<!DOCTYPE html>
<?php 	
		require_once __DIR__."/config.php"; 
		require_once __DIR__."/gestionaPeliculas.php";
		require_once __DIR__."/gestionaTienda.php";
		require_once __DIR__."/muestraNoticias.php";
?>
<html>
	<head>
		<title>Pagina de inicio</title>
		<link rel="icon" href="img/logogrande.png" type="image/png"/>
		<link rel="stylesheet" type="text/css" href="portada.css" />
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="lateral_izquierdo.css" />
		<link rel="stylesheet" type="text/css" href="lateral_derecho.css" />
		<link rel="stylesheet" type="text/css" href="centro.css" />
		<link rel="stylesheet" type="text/css" href="estiloSlide.css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="responsiveslides.min.js"></script>
		<link href="http://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet" type="text/css"/>
		<link href="http://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css"/>
		<link href="http://fonts.googleapis.com/css?family=Sansita+One" rel="stylesheet" type="text/css"/>
		<link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet' type="text/css"/>
		<script>
			$(function () {

			  // Slideshow 1
			  $("#slider1").responsiveSlides({
				auto: true,
				pager: true,
				nav: false,
				pause: true,
				speed: 500,
				namespace: "centered-btns",
				before: function () {
				  $('.events').append("<li>before event fired.</li>");
				},
				after: function () {
				  $('.events').append("<li>after event fired.</li>");
				}
			  });
			});
		</script>
	</head>
	
	<body>
		<?php
			if(isset($_SESSION['login']))
				if($_SESSION['admin'] == true)
					header("Location: registroAdmin.php");
		?>
	
		<div id="contenedor">
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			
			<div id="contenedorIzquierdo">
				<h2>TOP PELICULAS</h2>
				<div id="menuScroll">
					<?php 
						echo cargaTopPeliculas();
					?>
				</div>
			</div>
			
			<?php 
				if(!isset($_SESSION["login"]))
				{
					echo '<div id="contenidoCentral">';
				}
				else
				{
					echo '<div id="contenidoCentralAmpliado">';
				}
			?>
			<br>
				<div class="rslides_container">
					 <ul class="rslides" id="slider1">
						<?php
							echo cargaSlide();
						?>
					 </ul>
				</div>
				<div id="tituloCentro">
				<h1 id="tituloOfertas">OFERTAS</h1>
					<?php 
						echo cargaOfertas();
					?>
				</div>
				<br>
			</div>
			<?php 
				if(!isset($_SESSION["login"]))	
				{
					echo '	<div id="contenedorDerecho">
								<h2>USUARIO</h2>
									<img src="img/Avatares/usuarioTrans.png" width="80" height="80" />
									<form action="procesarLogin.php" method="post">
										<fieldset>
											<input required="required" name="nick" maxlength="50" type="text" placeholder="nick"><br><br>
											<input required="required" name="pass" maxlength="50" type="password" placeholder="contraseña"><br><br>
									
											<button type="submit">LOGIN</button>
										</fieldset>
									</form>
							</div>';
				  
				}	
			?>
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
		</div>
		
	</body>
</html>

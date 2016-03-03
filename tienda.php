<!DOCTYPE html>
<?php 
	  include_once "carrito.php";
	  require_once __DIR__.'/config.php'; 
	  require_once __DIR__.'/gestionaTienda.php';
	  
?>
<html>
	<head>
		<title>Tienda ShareFilm</title>
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="lateral_izquierdo.css" />
		<link rel="stylesheet" type="text/css" href="lateral_derecho.css" />
		<link rel="stylesheet" type="text/css" href="centro.css" />
		<link rel="stylesheet" type="text/css" href="tienda.css" />
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		<link rel="icon" href="img/logogrande.png" type="image/png">
		<script type="text/javascript" src="js/jquery.js"></script>
		
		<script>
			function cargaPaginacion(pagina){
				$('#content').html('<div id="gifCargar"><img src="img/loading.gif" width="90px" height="90px"/></div>');

				var page = pagina.id;        
				var dataString = 'page=' + page;
				
				$.ajax({
					type: "GET",
					url: "gestionaTienda.php?paginador=true",
					data: dataString,
					success: function(data){
						$('#content').fadeIn(1000).html(data);
					}
				});

			}
		</script>
	</head>
	
	<body>
		<?php
			if(isset($_SESSION['login']))
				if($_SESSION['admin'] == true)
					header("Location: tiendaAdmin.php");
		?>
		
		<div id="contenedor">
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			
			<div id="contenedorIzquierdo">
				<h2>TOP PELICULAS</h2>
				<div id="menuScroll">
					<?php
						echo cargaMasVendidas();
					?>	
				</div>
			</div>
			
			<div id="contenidoCentral">
				<div id="tituloCentro">	
				<h1> CONTENIDO DE LA TIENDA </h1>
					<div id="content">
						<?php 
							cargaTienda();
						?>
					</div>
				</div>
				
			</div>
			
			<div id="contenedorDerecho">
				<h2> MI CESTA </h2>
				<button type="submit" id="botonCesta" onclick="window.location.href='vistaCesta.php';"/><img src="img/carrito.png" width="60" height="60">
				<p id = "elementos">
				<?php
					if (!isset($_SESSION["carrito"]))
					{ 
						$_SESSION["carrito"] = new carrito(); 
						if(isset($_SESSION["user"]))
						{
							cargaCarrito($_SESSION["user"]);
						}
					}
					
					$elem = $_SESSION["carrito"]->dameCantidad();
					echo "$elem ELEMENTOS </p></button>";
				?>
				<button type="submit" id="botonCesta" onclick="window.location.href='eliminarTodo.php';"/><p>Vaciar carrito</p>
				
			</div>
				
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
			
		</div>
	</body>
</html>
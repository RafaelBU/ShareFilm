<!DOCTYPE html>
<?php 
	  include_once "carrito.php";
	  require_once __DIR__.'/config.php'; 
	  require_once __DIR__.'/gestionaTienda.php';
	  
?>
<html>
	<head> 
		<title>Cesta </title>
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="lateral_derecho.css" />
		<link rel="stylesheet" type="text/css" href="centro.css" />
		<link rel="stylesheet" type="text/css" href="estiloCesta.css" />
		<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		<link rel="icon" href="img/logogrande.png" type="image/png">
	</head>
	
	<body>
		<div id="contenedor">
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			
			<div id="contenidoCentralAmpliado">
				<?php	
					echo cargaContenidoCarrito();
				?>
			</div>
			
			<div id="contenedorDerecho">
				<?php
					echo "<p class='precio' > Subtotal <br> (".$_SESSION["carrito"]->dameCantidad()." elementos) </p>
					<p class='precio'> ".calculaTotal()." € </p>";
				?>
				<form method='post' action='procesarPedido.php'>
					<?php	
						if($_SESSION["carrito"]->dameCantidad() != 0)
						{
							if(isset($_SESSION["user"]))
							{
								echo "<input required='required' name='numeroTarjeta' maxlength='50' type='text' placeholder='Número de tarjeta'><br><br>";
							}					
					
							echo "<button type='submit' id='botonCompra' ><div id='carrito'><img src='img/carrito.png' width='30' height='30'/></div><div id='textoBoton'>TRAMITAR PEDIDO</div></button>
							<br><br>";
						}
					?>
				</form>
				<img id="metodos" src="img/metodosPago.png" />
			</div>
				
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
			
		</div>
	</body>
</html>
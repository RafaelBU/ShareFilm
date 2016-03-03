<!DOCTYPE html>

<?php
require_once __DIR__.'/gestionaPeliculas.php';
?>
<html>
	<head>
		<title>Ficha de la pelicula</title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="estiloPeliculas.css" />
		
		<link rel="icon" href="img/logogrande.png" type="image/png">
		
		<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
	</head>
	
	<body>
		<div id="contenedor">
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			
			<div id="ficha_pelicula">
				
					<?php
						echo cargaFicha($_GET['idPeli']);
					?>	
				<div id="votos_boton">
					<?php
						echo mostrarVotosFicha($_GET['idPeli']);
					?>	
				</div>	
			</div>
			
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
			
		</div>
		
		
		
	</body>	
	
		<script src="js/jquery-1.9.1.min.js"></script>
	<script>
	function votar(voto,id)
	{	
		var num=voto.id;
		var url="gestionaPeliculas.php";
		$.post(url,{voto: num, idPeli: id},haVotado);
	}
	
	function haVotado(data,status)
	{
		alert(data);
		location.reload();
	}
	</script>
</html>	
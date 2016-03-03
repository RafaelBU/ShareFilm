<!DOCTYPE html>
<?php require_once __DIR__.'/config.php'; 
	  require_once __DIR__.'/gestionaPeliculas.php'; ?>
<html>
	<head>
		<title>Peliculas</title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="estiloPeliculas.css" />
		
		<link rel="icon" href="img/logogrande.png" type="image/png">
		<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		
		<script src="js/jquery-1.9.1.min.js"></script>
	<script>
		
	function eligeLetra(letra)
	{	
		var l=letra.id;
		var url="gestionaPeliculas.php?paginador=true&letra=" + l;
		$.get(url,mostrarSeleccion);
	}
	
		function eligeGenero(genero)
	{	
		var l=genero.id;
		var url="gestionaPeliculas.php?paginador=true&genero=" + l;
		$.get(url,mostrarSeleccion);
	}
	
	function cargaPelis()
	{
		var l="";
		var url="gestionaPeliculas.php?paginador=true&letra=" + l;
		$.get(url,mostrarSeleccion);
	}
	
	function cambiagenero()
	{	cargaPelis();
		var url="gestionaPeliculas.php?modo=generos";
		$.get(url,mostrarBotones);
		
	}	
	
	function cambiaLetras()
	{
		cargaPelis();
		var url="gestionaPeliculas.php?modo=alfabetico";
		$.get(url,mostrarBotones);
		
	}
	
	function mostrarSeleccion(data,status)
	{
		$("#estiloListaPeli").html(data);
	}
	
	function mostrarBotones(data,status)
	{
		$("#estiloreferencias").html(data);
	}

	function cargaPaginacion(pagina){
	$('#estiloListaPeli').html('<div id="gifCargar"><img src="img/loading.gif" width="90px" height="90px"/></div>');

	var page = pagina.id;        
	var dataString = 'page=' + page;
	
	$.ajax({
		type: "GET",
		url: "gestionaPeliculas.php?paginador=true",
		data: dataString,
		success: function(data){
			$('#estiloListaPeli').fadeIn(1000).html(data);
		}
	});

}
	
	</script>
	</head>
	
	<body>
		<?php
			if(isset($_SESSION['login']))
				if($_SESSION['admin'] == true)
					header("Location: peliculasAdmin.php");
		?>
		<div id="contenedor">
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			<h1 id="titulo">PELICULAS</h1>
			<div id="contenedorPeliculas">	
				
				<ul id="estiloreferencias" >
				<?php	
					echo cargaAlfabeto();
				?>
				</ul>
				
				
				
				<ul id="estiloListaPeli" >
					<?php
					if(!isset($_GET['buscador']))
						echo cargaPaginador();
					else
						echo cargaPestanaBuscador($_GET['buscador']);
					?>
				</ul>
			</div>	
	
		
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
			
		</div>
		
		
		
	</body>	
</html>	
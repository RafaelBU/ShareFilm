<!DOCTYPE html>
<html>
	<head>
		<title>Noticias</title>

		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		
		<link rel="icon" href="img/logogrande.png" type="image/png"/>
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="centro.css" />
		<link rel="stylesheet" type="text/css" href="estiloNoticias.css" />
		<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="js/jquery.js"></script>
		
		<script>
			function cargaPaginacion(pagina){
				$('#content').html('<div id="gifCargar"><img src="img/loading.gif" width="90px" height="90px"/></div>');

				var page = pagina.id;        
				var dataString = 'page=' + page;
				
				$.ajax({
					type: "GET",
					url: "muestraNoticias.php?paginador=true",
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
					header("Location: registroAdmin.php");
		?>
		<div id="contenedor">
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			
			<div id="contenedorNoticias">
			<div id="content">
			<?php	
				require_once __DIR__.'/muestraNoticias.php';
				cargaNoticias();
			?>	
			</div>  
			</div>  
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
		</div>  <!-------------cierre Contenedor-------------->
	</body>
</html>	

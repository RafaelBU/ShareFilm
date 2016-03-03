<!DOCTYPE html>
<html>
	<head>
		<title>Escribe una noticia</title>

		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="centro.css" />
		<link rel="stylesheet" type="text/css" href="estiloNoticias.css" />
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
			<?php
				if(isset($_SESSION["login"])){
					echo'<form method="post" action="insertarNoticia.php" enctype="multipart/form-data">
							<fieldset>
								<textarea required="required"id="limite_titular" rows="2" cols="70"  name="titular" value="" placeholder="Titular"></textarea><br>
								<textarea required="required" id="limite_entradilla" rows="4" cols="70"  name="entradilla" value="" placeholder="Entradilla"></textarea><br>
								<textarea required="required" id="limite_noticia" rows="8" cols="100"  name="noticia" value="" placeholder="Escribe la noticia"></textarea><br>
								<p>Imagen noticia</p>
								
								<input required="required" type="file" name="uploadedNoticia" /><br><br>
								<button id="enviar_noticia" type="submit">Listo</button> 
							
							</fieldset>
						</form>';
				}
			?>
			
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
		</div>  <!-------------cierre Contenedor-------------->
			
	</body>
</html>	
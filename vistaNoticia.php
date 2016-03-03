<!DOCTYPE html>
<html>
	<head>
		<title>Noticia</title>

		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="centro.css" />
		
		<link rel="stylesheet" type="text/css" href="estiloNoticias.css" />
		
		<link rel="stylesheet" type="text/css" href="estiloVistaNoticia.css" />
		
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
			
			<div id="contenedorNoticias">
				<div id="noticia" class="vistaNoticia">
					
					<?php require_once __DIR__.'/muestraNoticias.php';
					
					cargaNoticiaConcreta($_GET["idN"]);?>
					
					<hr/>
					<a name=comentarios>
					<div id="contenedorComentarios">
						<h1><em>Comentarios</em></h1>
					
					<?php muestraComentarios($_GET["idN"]);?>
						
					</div>
					
					<div id="comentar">
						<?php
						if(isset($_SESSION["login"])){
						echo("
						<form action='insertarComentario.php' method='POST'>
							<input type='hidden' name='idN' value='");?><?= $_GET['idN'] ?><?php echo("' />
							<textarea rows='6' cols='65' id='texto' name='comentario' value='' placeholder='Deja aqui tu comentario'></textarea>
							</br>
							<button id='enviar' type='submit'>Enviar</button> 
							<button id='Limpiar' type='reset'>Limpiar</button>
						</form>");
						}
						else{
							echo("<form action='usuarioLogin.php' method='POST'>
								Registrate para poder comentar <button type='submit'/>Login</button>
							</form>");
						}
						?>
					</div>
				</div>
			</div>
			
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
			
		</div>
	</body>

</html>
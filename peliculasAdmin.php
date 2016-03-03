<!DOCTYPE html>
<?php 	
		require_once __DIR__.'/config.php'; ?>
<html>
	<head>
		<title>Administración peliculas</title>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		<link id="estiloAdmin" href="estiloAdmin.css" rel="stylesheet" type="text/css" /> 
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		<link rel="icon" href="img/logogrande.png" type="image/png">

	</head>
  
	<body>
		<?php
			if($_SESSION['admin'] == false)
				header("Location: default.php");
		?>
		<div id= "contenedor">
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			
				
				<div id="Bienvenido">
					<h1 align=center> Administracion </h1>
				</div>
			
				<div id ="hueco">
					<p> </p>
				</div>
				
				<div id = "form">
					<form method="post" action="insertPeli.php" enctype="multipart/form-data">
						<fieldset>
							<h3> Nueva pelicula</h3>
								<input class = "textField" required="required" name="titulo" maxlength="50" type="text" placeholder="titulo"/><br><br>
								<input class = "textField" required="required" name="director" maxlength="50" type="text" placeholder="director"/><br><br>
								<input class = "textField" required="required" name="actores" maxlength="100" type="text" placeholder="actores"/><br><br>
								<TextArea class = "textField" rows="8" cols="40" required="required"  name="sinopsis" maxlength="600" type="text" placeholder="sinopsis"></TextArea>
								<p> Genero <select name="genero" required="required">
									<option value=""selected="selected"></option>
									<option value="Accion">Accion</option>
									<option value="Ciencia ficcion">Ciencia ficcion</option>
									<option value="Comedia">Comedia</option>
									<option value="Documental">Documental</option>
									<option value="Drama">Drama</option>
									<option value="Historica">Historica</option>
									<option value="Infantil">Infantil</option>
									<option value="Misterio">Misterio</option>
									<option value="Musical">Musical</option>
									<option value="Romantica">Romantica</option>
									<option value="Suspense">Suspense</option>
									<option value="Terror">Terror</option>
								</select></p>
								<p> Portada</p>
								<input type="file" name="adjunto" required="required"/><br><br>
								<input id = "btnLog" value="GUARDAR" type="submit"/>
						</fieldset> 
					</form>
				</div>
				
				<div id ="hueco">
				
				</div>
			
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
		</div>
	</body>
	
		<script src="js/jquery-1.9.1.min.js"></script>
	<script>
	function correoValido(correo)
{
	var compr =correo.split("@");
	if(compr[1])
	{compr = compr[1].split(".");
		if(compr[1])
		return true;
	else
		return false;
	}
	else 	
		return false;
}

function comprobarCorreo(correo)
{
	 if (!correoValido($(correo).val()))
	 {
		$("#btnReg").hide();
		alert("El email introducido no es valido, por favor reviselo");
	 }
	else
		$("#btnReg").show();
}

function comprobarNick(nick)
{
	 var url="comprobarUsuario.php?nickdis=" + $(nick).val();
	 $.get(url,usuarioExiste);
}

function usuarioExiste(data,status)
{
		
		if(data==0)
		$("#btnReg").show();
		
	else
		{
		$("#btnReg").hide();
		alert("El nick introducido no esta disponible, por favor introduce otro");
		}
}
	</script>
</html>

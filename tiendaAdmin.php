<!DOCTYPE html>
<?php 	
		require_once __DIR__.'/config.php'; 
		require_once __DIR__.'/muestraTiendaAdmin.php'; 
		if($_SESSION['admin'] == false)
				header("Location: default.php");
		?>
<html>
	<head>
		<title>Administración</title>
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
		
		<div id= "contenedor">
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			
				
				<div id="Bienvenido">
					<h1 align=center> Administracion </h1>
				</div>
			
				<div id ="huecoPequenio">
					<p> </p>
				</div>
				<div id = "form">
					<form method="post" action="insertPeliTienda.php" enctype="multipart/form-data">
						<fieldset>
							<h3> Nueva pelicula de la tienda</h3>
								<input class = "textField" required="required" name="titulo" maxlength="50" type="text" placeholder="titulo"/><br><br>
								<input class = "textField" required="required" name="trailer" maxlength="50" type="text" placeholder="url trailer de youtube"/><br><br>
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
								</select>
								</p>
								<p> Portada</p>
								<input type="file" name="adjunto" required="required"/><br><br>
								<input class = "textField" required="required" name="descuento" maxlength="50" type="number" min="0" step= "0.01" placeholder="descuento"/> €<br><br>
								<input class = "textField" required="required" name="stock" maxlength="50" type="number" min="1" placeholder="unidades"/><br><br>
								<input class = "textField" required="required" name="precio" maxlength="50" type="number" min="0" step= "0.01" placeholder="precio"/> €<br><br>
								<input id = "btnLog" value="GUARDAR" type="submit"/>
						</fieldset> 
					</form>
				</div>
				
				<div id = "form">
					<form method="post" action="aniadeStock.php">
						<fieldset>
							<h3> Añade stock</h3>
								<p> pelicula <select name="titulo" required="required">
									<option value=""selected="selected"></option>
									<?php
										echo generaPelisTienda();
									?>
								</select></p>
								<input class = "textField" required="required" name="stock" maxlength="50" type="number" min="1" placeholder="unidades"/> <br><br>
								<input id = "btnLog" value="AÑADIR" type="submit"/>
						</fieldset> 
					</form>
				</div>
				
				<div id = "form">
					<form method="post" action="cambiaPrecio.php">
						<fieldset>
							<h3> Cambia precio</h3>
								<p> pelicula <select name="titulo" required="required">
									<option value=""selected="selected"></option>
									<?php
										echo generaPelisTienda();
									?>
								</select></p>
								<input class = "textField" required="required" name="precio" maxlength="50" type="number" min="0" step= "0.01" placeholder="precio"/> €<br><br>
								<input id = "btnLog" value="CAMBIAR" type="submit"/>
						</fieldset> 
					</form>
				</div>
				
				<div id = "form">
					<form method="post" action="cambiaDescuento.php">
						<fieldset>
							<h3> Cambia descuento</h3>
								<p> pelicula <select name="titulo" required="required">
									<option value=""selected="selected"></option>
									<?php
										echo generaPelisTienda();
									?>
								</select></p>
								<input class = "textField" required="required" name="descuento" maxlength="50" type="number" min="0" step= "0.01" placeholder="descuento"/> €<br><br>
								<input id = "btnLog" value="CAMBIAR" type="submit"/>
						</fieldset> 
					</form>
				</div>
				
				<div id ="huecoPequenio">
				
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

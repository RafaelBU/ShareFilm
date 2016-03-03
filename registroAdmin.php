<!DOCTYPE html>
<?php 	
		require_once __DIR__.'/config.php'; ?>
<html>
	<head>
		<title>Administración registro</title>
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
					<form method="post" action="insertAdmin.php">
						<fieldset>
							<h3> Nuevo administrador</h3>
								<input class = "textField" required="required" onchange="comprobarNick(this)" name="nick" maxlength="50" type="text" placeholder="nick"><br><br>
								<input class = "textField" required="required" name="pass" maxlength="50" type="password" placeholder="contraseña"><br><br>
								<input class = "textField" required="required" name="nombre" maxlength="50" type="text" placeholder="nombre"><br><br>
								<input class = "textField" required="required" name="apellidos" maxlength="50" type="text" placeholder="apellidos"><br><br>
								<input class = "textField" required="required" name="pais" maxlength="50" type="text" placeholder="pais"><br><br>
								<input class = "textField" required="required" name="ciudad" maxlength="50" type="text" placeholder="ciudad"><br><br>
								<input class = "textField" required="required" onchange ="comprobarCorreo(this)" name="email" maxlength="50" type="text" placeholder="email"><br><br>
								<input id= "btnReg" value="REGISTRAR" type="submit">
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
	 var url="comprobarUsuarioLogin.php?nickdis=" + $(nick).val();
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

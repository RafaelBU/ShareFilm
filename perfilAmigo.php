<!DOCTYPE html>
<?php	 
	require_once __DIR__.'/config.php'; 
	require_once __DIR__.'/muestraPerfil.php';
?>
<html>
	<head>
		<title> Perfil de <?= $_GET['nombre'] ?> </title>
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="centro.css" />
		<link rel="stylesheet" type="text/css" href="estiloPerfilAmigo.css" />
		<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		<link rel="icon" href="img/logogrande.png" type="image/png">
	</head>
	
	<body>
		<?php
			if(isset($_SESSION['login'])){
				if($_SESSION['admin'] == true)
					header("Location: registroAdmin.php");
			}
			else header("Location: default.php");
		?>
		<div id="contenedor">
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			
			<div id="contenidoCentralMaxi">
				<?php
					echo cargaPerfilCompleto($_GET["nombre"])
				?>
			</div>
			
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
		</div>
	</body>
</html>
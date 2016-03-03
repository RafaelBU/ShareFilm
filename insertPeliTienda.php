<?php
	require_once __DIR__.'/config.php';
	require_once __DIR__.'/tiendaBD.php';
	
	$params["titulo"] = $_POST['titulo'];
	$params["trailer"] = $_POST['trailer'];
	$params["genero"] = $_POST['genero'];
	$params["portada"] =  $_FILES['adjunto'];
	$params["descuento"] =  $_POST['descuento'];
	$params["stock"] =  $_POST['stock'];
	$params["precio"] =  $_POST['precio'];
			
	insertPeliTienda($params);
	header("Location: tiendaAdmin.php");
?>
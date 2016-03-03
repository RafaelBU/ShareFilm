<?php
	require_once __DIR__.'/config.php';
	require_once __DIR__.'/peliculasBD.php';
	
	$params["titulo"] = $_POST['titulo'];
	$params["director"] = $_POST['director'];
	$params["actores"] = $_POST['actores'];
	$params["sinopsis"] = $_POST['sinopsis'];
	$params["genero"] = $_POST['genero'];
	$params["portada"] = $_FILES['adjunto'];
			
	insertPeli($params);
	header("Location: peliculasAdmin.php");
?>
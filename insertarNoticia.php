<?php

	require_once __DIR__.'/noticiasBD.php'; // hay que probarlo insertando algo a ver si se necesita
	require_once __DIR__.'/escribirNoticia.php'; // lo mismo para este
	
	$array_noticia["titular"] = $_POST["titular"];
	$array_noticia["entradilla"] = $_POST["entradilla"];
	$array_noticia["cuerpo"] = $_POST["noticia"];
	$target_path = "img/Noticias/";
	$target_path = $target_path .basename( $_FILES['uploadedNoticia']['name']); 
	
	if(move_uploaded_file($_FILES['uploadedNoticia']['tmp_name'], $target_path))
	{ 
		// echo "El archivo " .basename( $_FILES['uploadedNoticia']['name']). " ha sido subido";  para pruebas
		$array_noticia["url"] = $target_path;
		
		insertar_noticia($array_noticia);
		
	}
	else
	{
		echo "Ha ocurrido un error, trate de nuevo!";  // por si surge algun error
	}
	
	header("Location: Noticias.php");

?>

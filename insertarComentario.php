<?php
	require_once __DIR__.'/config.php';
	require_once __DIR__.'/noticiasBD.php';
	
	$comentario["Nick"] = $_SESSION["user"];
	$comentario["Comentario"] = $_POST["comentario"];
	$comentario["IdNoticia"] = $_POST["idN"];
	
	insertarComentario($comentario);
	
	header("Location: vistaNoticia.php?idN=".$_POST["idN"]);

?>

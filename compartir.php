<?php
	  require_once __DIR__.'/usuariosBD.php';

	compartir($_POST["nombre"], $_POST["pelicula"]);
	
	header("Location: miPerfil.php");
?>
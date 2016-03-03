<?php
  require_once __DIR__.'/config.php'; 
  require_once __DIR__.'/usuariosBD.php';
  require_once __DIR__.'/comunidadBD.php';
  
	$user = $_POST['user'];
	añadeAmigo($user);
	actualizaHistorialAmigos($user);
	header('Location: comunidad.php');
	
?>
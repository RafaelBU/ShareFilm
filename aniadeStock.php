<?php
	require_once __DIR__.'/config.php';
	require_once __DIR__.'/tiendaBD.php';
	
	$params["titulo"] = $_POST['titulo'];
	$params["stock"] = $_POST['stock'];
			
	aniadeStock($params);
	header("Location: tiendaAdmin.php");
?>
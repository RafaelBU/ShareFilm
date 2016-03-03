<?php
	require_once __DIR__.'/config.php';
	require_once __DIR__.'/tiendaBD.php';
	
	$params["titulo"] = $_POST['titulo'];
	$params["descuento"] = $_POST['descuento'];
			
	cambiaDescuento($params);
	header("Location: tiendaAdmin.php");
?>
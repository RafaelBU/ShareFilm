﻿<?php
	require_once __DIR__.'/config.php';
	require_once __DIR__.'/tiendaBD.php';
	
	$params["titulo"] = $_POST['titulo'];
	$params["precio"] = $_POST['precio'];
			
	cambiaPrecio($params);
	header("Location: tiendaAdmin.php");
?>
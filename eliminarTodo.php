<?php 	 
	include_once "carrito.php";
	session_start();

	$_SESSION["carrito"] = new carrito(); 
	header('Location: tienda.php');
?>
<?php 	 
	include_once "carrito.php";
	require_once __DIR__.'/config.php';
	require_once __DIR__.'/tiendaBD.php'; 
	require_once __DIR__.'/comunidadBD.php'; 

	if(!isset($_SESSION["user"]))
	{
		header('Location: usuarioLogin.php');
	}
	else{
		actualizaDatosTienda();
		actualizaHistorialCompras();
		$_SESSION["carrito"] = new carrito(); 
		header('Location: tienda.php');
	}
?>
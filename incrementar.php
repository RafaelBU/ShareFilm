<?php  include_once "carrito.php";
	session_start();
	
	$_SESSION["carrito"]->incrementaUnidades($_POST["idPeli"]);
	header('Location: vistaCesta.php')
?>
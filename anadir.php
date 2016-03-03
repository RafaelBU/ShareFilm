<?php  include_once "carrito.php";
	session_start();
	
	if (!isset($_SESSION["carrito"]))
	{ 
		$_SESSION["carrito"] = new carrito(); 
		if(isset($_SESSION["user"]))
		{
			cargaCarrito($_SESSION["user"]);
		}
	}
	
	$carrito = $_SESSION["carrito"];
	
	$cantidad = $carrito->dameCantidad();
	$existe = false;
	
	if($carrito->dameCantidad() == 0)
	{
		$carrito->introduce_producto($_POST["idPeli"], $_POST["tituloPeli"], $_POST["portada"], $_POST["precio"], 1);
	}
	else{
		$i = 0;
		while($i < $cantidad && !$existe)
		{
			if($carrito->array_id_prod[$i] == $_POST["idPeli"])
			{
				$existe = true;
			}
			$i++;
		}
		
		if($existe)
		{
			$carrito->incrementaUnidades($_POST["idPeli"]);
		}
		else{
			$carrito->introduce_producto($_POST["idPeli"], $_POST["tituloPeli"], $_POST["portada"], $_POST["precio"], 1);
		}
	}
	
	header('Location: tienda.php');

?>
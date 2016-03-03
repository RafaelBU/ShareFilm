<?php  include_once "carrito.php";
	session_start();
	
	$carrito = $_SESSION["carrito"];
	$cantidad = $carrito->num_productos;
	$a = $_POST["idPeli"];
	
	if($carrito->array_unidades[$_POST["idPeli"]] == 1)
	{
		$encontrado = false;
		$i = 0;
		$pos = -1;
		echo "$a";
		while($i < $cantidad && !$encontrado)
		{
			if($carrito->array_id_prod[$i] == $_POST["idPeli"])
			{
				$encontrado = true;
				$pos = $i;
			}
			$i++;
		}
		$_SESSION["carrito"]->elimina_producto($pos);
	}
	else{
		$carrito->decrementaUnidades($_POST["idPeli"]);
		
	}
	
	header('Location: vistaCesta.php')
?>
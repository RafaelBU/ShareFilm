<?php 	include_once "carrito.php";
		require_once __DIR__.'/config.php';
		require_once __DIR__.'/usuariosBD.php';

	function actualizaHistorialCompras()
	{
		global $BD;
		
		$carrito = $_SESSION["carrito"];
		$cantidad = $carrito->num_productos;
		
		$nick = $_SESSION["user"];
		
		for($i = 0; $i < $cantidad; $i++)
		{
			$idPeli = $carrito->array_id_prod[$i];
			if($idPeli != -1)
			{
				$titulo = $carrito->array_nombre_prod[$i];
				$query = "INSERT INTO historial VALUES('$nick', now(), 'comprado', '$titulo')";
		
				$BD->query($query);
					//or die ($BD->error. " en la línea ".(__LINE__-1));
			}
			
		}
	}
	
	function actualizaHistorialAmigos($user)
	{
		global $BD;
		
		$user = "a " . "$user";
		$nick = $_SESSION["user"];
		$query = "INSERT INTO historial VALUES('$nick', now(), 'seguido', '$user')";
		
		$BD->query($query)
					or die ($BD->error. " en la línea ".(__LINE__-1));
	}
	
	function dameHistorial($amigo)
	{
		global $BD;
		
		$query = "SELECT * FROM historial 
				  WHERE Nick = '$amigo' ORDER BY Fecha DESC";
		
		$consulta = $BD->query($query)
					or die ($BD->error. " en la línea ".(__LINE__-1));
					
		return $consulta;
	}
	
	function dameValoradasAmigos($amigo)
	{
		global $BD;
		
		$query = "SELECT * FROM vota 
				  WHERE Nick = '$amigo' 
				  ORDER BY Nota DESC
				  LIMIT 2";
		
		$consulta = $BD->query($query)
					or die ($BD->error. " en la línea ".(__LINE__-1));
		
		return $consulta;
	}
	
	function dameUsuariosPopulares()
	{
		global $BD;
		
		$query = "SELECT Nick FROM usuarios WHERE Admin = 0";
		
		$consulta = $BD->query($query)
					or die ($BD->error. " en la línea ".(__LINE__-1));
					
		while($usuario = $consulta->fetch_assoc())
		{
			$nombre = $usuario['Nick'];
			$consultaN = cuentaAmigos($nombre);
			$numeroAmigos = $consultaN->fetch_assoc()['numAmigos'];
			$arrayPopulares["$nombre"] = $numeroAmigos;
		}
		
		arsort($arrayPopulares);
		
		return $arrayPopulares;
	}
?>

<?php  include_once "carrito.php"; 

	function dameOfertas()
	{
		global $BD;
		
		$query = "SELECT ID, Titulo, Portada, Precio, Precio-Descuento as PrecioFinal FROM peliculatienda, tipodisco, tieneoferta 
						WHERE peliculatienda.ID = tipodisco.IDTiendaPeli AND peliculatienda.ID = tieneoferta.IDTiendaPeli AND tieneoferta.Descuento <> 0
						LIMIT 4";
		$consulta = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		return $consulta;
	}
	
	function dameTienda($offset, $rowsPerPage)
	{
		global $BD;
		
		$query = "SELECT * FROM peliculatienda, tipodisco 
				WHERE ID = idTiendaPeli
				LIMIT $offset, $rowsPerPage";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		return $consulta;
		
	}
	
	function dameTiendaCompleta()
	{
		global $BD;
		
		$query = "SELECT * FROM peliculatienda, tipodisco 
				WHERE ID = idTiendaPeli";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		return $consulta;
		
	}
	
	function cuentaCatalogoTienda(){
		global $BD;
		$query = "SELECT count(*) FROM peliculatienda";
		
		$result = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		$result = $result->fetch_assoc();
		
		return $result["count(*)"];
	}
	
	function dameFichaTienda($id)
	{
		global $BD;
		
		$query1 = "SELECT Titulo, Portada, Trailer, Stock, Precio-Descuento as PrecioFinal, Tipo 
				 FROM peliculatienda, tipodisco, tienegenerotienda, genero, tieneoferta
				 WHERE peliculatienda.ID = '$id' and peliculatienda.ID = tipodisco.IDTiendaPeli 
				 and peliculatienda.ID = tienegenerotienda.IDTiendaPeli and Tipo =
                 	(SELECT Tipo FROM genero WHERE id = tienegenerotienda.genero)
				 and peliculatienda.ID = tieneoferta.IDTiendaPeli";
		
		$consulta = $BD->query($query1)
			or die ($BD->error. " en la línea ".(__LINE__-1));
			
		if($consulta->num_rows == 0)
		{
			$query2 = "SELECT Titulo, Portada, Trailer, Stock, Precio as PrecioFinal, Tipo FROM peliculatienda, tipodisco, tienegenerotienda, genero 
					   WHERE peliculatienda.ID = '$id' and peliculatienda.ID = tipodisco.IDTiendaPeli 
					   and peliculatienda.ID = tienegenerotienda.IDTiendaPeli and Tipo = 
						(SELECT Tipo FROM genero WHERE id = tienegenerotienda.genero)";
				
			$consulta = $BD->query($query2)
				or die ($BD->error. " en la línea ".(__LINE__-1));
		}
		
		return $consulta;
	}
	
	function dameMasVendidas()
	{
		global $BD;
		
		$query = "SELECT ID, Titulo, Portada FROM peliculatienda
				  ORDER BY numeroVentas DESC
				  LIMIT 3";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		return $consulta;
		
	}
	
	function dameCarrito($nick)
	{
		global $BD;
		
		$query = "SELECT * FROM usuarioCompra, peliculaTienda WHERE Nick = '$nick' and usuariocompra.idPeli = peliculatienda.ID";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		return $consulta;
	}
	
	function actualizaCarrito($nick, $carrito)
	{
		global $BD;
		
		$cantidad = $carrito->num_productos;
		
		$query = "DELETE FROM usuariocompra WHERE Nick = '$nick'";
		$BD->query($query)
				or die ($BD->error. " en la línea ".(__LINE__-1));
		
		for($i = 0; $i < $cantidad; $i++)
		{
			$idPeli = $carrito->array_id_prod[$i];
			$unidades = $carrito->array_unidades[$idPeli];
			if($idPeli != -1)
			{
				$query = "INSERT INTO usuariocompra VALUES ('$nick', '$idPeli', '$unidades')";
		
				$consulta = $BD->query($query)
					or die ($BD->error. " en la línea ".(__LINE__-1));
			}
			
		}
	}
	
	function actualizaDatosTienda()
	{
		$carrito = $_SESSION["carrito"];
		$cantidad = $carrito->num_productos;
		
		global $BD;
		
		for($i = 0; $i < $cantidad; $i++)
		{
			$idPeli = $carrito->array_id_prod[$i];
			$unidades = $carrito->array_unidades[$idPeli];
			$consulta = dameFichaTienda($idPeli)->fetch_assoc();
			$stockPeli = $consulta['Stock'];
	
			if($unidades > $stockPeli)
			{
				$unidades = $stockPeli;
				?>
				<!-- No funciona el alert <script> alert("No se ha podido procesar el pedido completo por falta de stock"); </script>-->
				<?php
			}
			$nick = $_SESSION["user"];
			if($idPeli != -1)
			{
				$query = "UPDATE peliculatienda SET numeroVentas = numeroVentas + '$unidades' WHERE ID = '$idPeli'";
		
				$BD->query($query)
					or die ($BD->error. " en la línea ".(__LINE__-1));
					
				$query = "UPDATE tipodisco SET Stock = Stock - '$unidades' WHERE IDTiendaPeli = '$idPeli'";
				
				$BD->query($query)
					or die ($BD->error. " en la línea ".(__LINE__-1));
					
				$query = "DELETE FROM usuariocompra WHERE Nick = '$nick'";
				
				$BD->query($query)
					or die ($BD->error. " en la línea ".(__LINE__-1));
				
				$consulta2 = dameFichaTienda($idPeli)->fetch_assoc();
				$stockPeli2 = $consulta2['Stock'];
				
				//Si hubiese algun pedido pendiente y se ha quedado sin stock desaparece del carrito de los clientes que lo tuviesen
				if($stockPeli2 == 0)
				{
					$query = "DELETE FROM usuariocompra WHERE idPeli = '$idPeli'";
					
					$BD->query($query)
						or die ($BD->error. " en la línea ".(__LINE__-1));
				}
					
			}
			
		}
	}
	
	function insertPeliTienda($params){
		global $BD;	
		$params = escapeInputTienda($params);
		
		$imagen = "img/Tienda/"; 
		$imagen = $imagen.basename($params['portada']['name']);
		move_uploaded_file($params['portada']['tmp_name'], $imagen);
		
		$query = "INSERT INTO peliculatienda (titulo, portada, trailer)
		VALUES ('".$params['titulo']."','".$imagen."','".$params['trailer']."')";
		$BD-> query($query)
			or die ($BD->error. ' en la linea '.(__LINE__-1));
		
		$query2 = "SELECT id FROM peliculatienda
					WHERE '".$params['titulo']."' LIKE peliculatienda.titulo";
		$consulta=$BD->query($query2)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		$peliTienda = $consulta->fetch_assoc();
		
		$query3 = "SELECT id FROM genero
					WHERE '".$params['genero']."' LIKE tipo";
		$consulta=$BD->query($query3)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		$genero = $consulta->fetch_assoc();
		
		$query4 = "INSERT INTO tienegenerotienda (IDTiendaPeli, Genero) VALUES ('".$peliTienda['id']."', '".$genero['id']."')";
		$BD-> query($query4)
			or die ($BD->error. ' en la linea '.(__LINE__-1));
			
		$query5 = "INSERT INTO tipodisco (IDTiendaPeli, stock, precio) VALUES ('".$peliTienda['id']."', '".$params['stock']."', '".$params['precio']."')";
		$BD-> query($query5)
			or die ($BD->error. ' en la linea '.(__LINE__-1));
			
		$query6 = "INSERT INTO tieneoferta (IDTiendaPeli, descuento) VALUES ('".$peliTienda['id']."', '".$params['descuento']."')";
		$BD-> query($query6)
			or die ($BD->error. ' en la linea '.(__LINE__-1));
		
	}
	
	function aniadeStock($params){
		global $BD;	
		
		$params["titulo"] = $BD->real_escape_string($params['titulo']);
		$params["stock"] =$BD->real_escape_string($params['stock']);
		
		$query = "SELECT id FROM peliculatienda
					WHERE '".$params['titulo']."' LIKE peliculatienda.titulo";
		$consulta=$BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		$peliTienda = $consulta->fetch_assoc();
		
		$query2 = "UPDATE tipodisco SET Stock=Stock + '".$params['stock']."' WHERE IDTiendaPeli = ".$peliTienda['id']."";
		$consulta=$BD->query($query2)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
	}
	
	function cambiaDescuento($params){
		global $BD;	
		
		$params["titulo"] = $BD->real_escape_string($params['titulo']);
		$params["descuento"] =$BD->real_escape_string($params['descuento']);
		
		$query = "SELECT id FROM peliculatienda
					WHERE '".$params['titulo']."' LIKE peliculatienda.titulo";
		$consulta=$BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		$peliTienda = $consulta->fetch_assoc();
		
		$query2 = "UPDATE tieneoferta SET Descuento = ".$params['descuento']." WHERE IDTiendaPeli = ".$peliTienda['id']."";
		echo($query2);
		
		$consulta=$BD->query($query2)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
	}
	
	function cambiaPrecio($params){
		global $BD;	
		
		$params["titulo"] = $BD->real_escape_string($params['titulo']);
		$params["precio"] =$BD->real_escape_string($params['precio']);
		
		$query = "SELECT id FROM peliculatienda
					WHERE '".$params['titulo']."' LIKE peliculatienda.titulo";
		$consulta=$BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		$peliTienda = $consulta->fetch_assoc();
		
		$query2 = "UPDATE tipodisco SET Precio= '".$params['precio']."' WHERE IDTiendaPeli = ".$peliTienda['id']."";
		$consulta=$BD->query($query2)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
	}
	
	function escapeInputTienda($params)
	{
		global $BD;	
		
		$params["titulo"] = $BD->real_escape_string($params['titulo']);
		$params["trailer"] =$BD->real_escape_string($params['trailer']);
		$params["genero"] =$BD->real_escape_string($params['genero']);
		//$params["portada"] =$BD->real_escape_string($params['portada']);
		$params["descuento"] =$BD->real_escape_string($params['descuento']);
		$params["stock"] =$BD->real_escape_string($params['stock']);
		$params["precio"] =$BD->real_escape_string($params['precio']);
		
		
		return $params;
	}
?>

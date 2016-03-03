<?php 
	include_once "carrito.php";
	require_once __DIR__.'/config.php'; 
	require_once __DIR__.'/tiendaBD.php';
	  
	if(isset($_GET['paginador']))
		cargaTienda();

	function cargaOfertas()
	{
		$html = "";
		$consulta = dameOfertas();
		
		while($ofertas = $consulta->fetch_assoc())
		{
			$html .= "<div class='columna'>
						<div class='imagenes'><img src=".$ofertas['Portada']." width='100' height='133' /></div>
						<div class='precios'><a href='vistaCompra.php?id=".$ofertas['ID']."'><span class='titulo'>".$ofertas['Titulo']."</a><br><br>
													   <span class='tachado'>Antes : ".$ofertas['Precio']." €</span> <br><br>
													   <span class='precioNuevo'>Ahora : ".$ofertas['PrecioFinal']." €!!</span>
						</div>
					</div>";
		}
		
		return $html;
		
	} 
	
	function cargaTienda()
	{
		$html = "";
		//numero de registros por página
		$rowsPerPage = 4;

		//por defecto mostramos la página 1
		$pageNum = 1;

		// si $_GET['page'] esta definido, usamos este número de página
		if(isset($_GET['page'])) 
		{
			sleep(1);
			$pageNum = $_GET['page'];
		}
			
		$offset = ($pageNum - 1) * $rowsPerPage; // a partir de donde se va en la base de datos
		$total_paginas = ceil(cuentaCatalogoTienda() / $rowsPerPage); // ceil redondea hacia arriba, numero de paginas
		
		$consulta = dameTienda($offset, $rowsPerPage);
		
		while($tienda = $consulta->fetch_assoc())
		{	
			$_SESSION["tituloPeli"] = $tienda['Titulo'];
			
			$html .= "<div class='columna'>
						<div class='imagenes'><img src=".$tienda['Portada']." width='100' height='133' /></div>
						<div class='precios'><a href='vistaCompra.php?id=".$tienda['ID']."'><span class='titulo'>".$tienda['Titulo']."</span></a><br>";
								
						if($tienda['Stock'] == 0)
						{
							$html .= "<button type='submit' id='botonCompra' onclick=alert('Agotado!')><div id='carrito'><img src='img/carrito.png' width='30' height='30'/></div>
									<div id='textoBoton'><a title='AGOTADO'>SIN STOCK </a></div></button>";
						}
						else{
							$html .= "<form method='post' action='anadir.php'>
										<input type = 'hidden' name = 'idPeli' value = '".$tienda['ID']."'>
										<input type = 'hidden' name = 'tituloPeli' value = '".$tienda['Titulo']."'>
										<input type = 'hidden' name = 'portada' value = '".$tienda['Portada']."'>
										<input type = 'hidden' name = 'precio' value = '".dameFichaTienda($tienda['ID'])->fetch_assoc()['PrecioFinal']."'>
										<a onclick=alert('Añadido!')><button type='submit' id='botonCompra'><div id='carrito'><img src='img/carrito.png' width='30' height='30'/></div>
											<div id='textoBoton'>AÑADIR AL CARRITO</div></button></a>
									</form>";
						}
													   
						$html .= "</div>
					</div>";
		}
		
		if($total_paginas > 1) 
		{
			$html .=  '<div class="indice">';
				if($pageNum != 1)
					$html .= "<a  id='".($pageNum-1)."' onclick='cargaPaginacion(this)'>Anterior</a>";
					
				for ($i=1;$i<=$total_paginas;$i++)
				{
					if ($pageNum == $i)
						$html .= "<button style='background-color:#9A9A9A;' id='".$i."'>".$i."</button>";
					else
						$html .= "<button id='".$i."' onclick='cargaPaginacion(this)'>".$i."</button>";
				}
					
				if($pageNum != $total_paginas){
						
					$html .= "<a id='".($pageNum+1)."' onclick='cargaPaginacion(this)'>Siguiente</a>";
						
				}
			$html .= '</div>';
				
		}
		
		echo $html;
	}
	
	function cargaFichaTienda($id)
	{
		$html = "";
		$consulta = dameFichaTienda($id);
		
		$ficha = $consulta -> fetch_assoc();
		
		$estado = "En Stock";
		$estiloEstado = "estadoStock";
		
		if($ficha['Stock'] == 0)
		{
			$estado = "Agotado";
			$estiloEstado = "estadoAgotado";
		}
		
		$html .= "<div id='contenidoCentralAmpliado'>
				<div id = 'tituloCentro'>
					<div id='caratula'><img src=".$ficha['Portada']." width='350' height='400' /></div>
					<div id='infoPeli'> 
						<h3>".$ficha['Titulo']."</h3>
						<iframe width='400' height='200' src=".$ficha['Trailer']." frameborder='0' allowfullscreen></iframe>
						
						<div id='Adicional'>
							<p> Género : <span id='genero'>".$ficha['Tipo']."</span> </p>
							
							<p> Estado : <span id='$estiloEstado'>".$estado."</span></span> </p>
						</div>
					</div>
				</div>
			</div>
			
			<div id='contenedorDerecho'>
				<p id='precio'>".$ficha['PrecioFinal']." € </p>";
				if($estado == "Agotado")
				{
					$html .= "<a onclick=alert('Agotado!')><button type='submit' id='botonCompra'><div id='carrito'><img src='img/carrito.png' width='30' height='30'/></div><div id='textoBoton'>PRODUCTO AGOTADO</div></button></a>
				<br><br>";
				}else{
					$html .= "<form method='post' action='anadir.php'>
								<input type = 'hidden' name = 'idPeli' value = '$id'>
									<input type = 'hidden' name = 'tituloPeli' value = '".$ficha['Titulo']."'>
									<input type = 'hidden' name = 'portada' value = '".$ficha['Portada']."'>
									<input type = 'hidden' name = 'precio' value = '".$ficha['PrecioFinal']."'>
									<a onclick=alert('Añadido!')><button type='submit' id='botonCompra'><div id='carrito'><img src='img/carrito.png' width='30' height='30'/></div><div id='textoBoton'>AÑADIR AL CARRITO</div></button></a>
							 </form>
				<br><br>";
				}
				
				$html .= "<img id='metodos' src='img/metodosPago.png' />
			</div>";
			
		return $html;
	}
	
	function cargaMasVendidas()
	{
		$html = "";
		$consulta = dameMasVendidas();
		
		while($vendidas = $consulta -> fetch_assoc())
		{
			$html .= "<a href = 'vistaCompra.php?id=".$vendidas['ID']."'><span class='titulo'> ".$vendidas['Titulo']."</span></a><br>
					<img src=".$vendidas['Portada']." width='150' height='200' /><br>";
		}
		
		return $html;
	}
	
	function cargaCarrito($nick)
	{
		$consulta = dameCarrito($nick);
		
		while($carrito = $consulta -> fetch_assoc())
		{
			$precio = dameFichaTienda($carrito["idPeli"])->fetch_assoc()['PrecioFinal'];
			$_SESSION["carrito"]->introduce_producto($carrito["idPeli"], $carrito["Titulo"], $carrito["Portada"], $precio, $carrito["Cantidad"]);
		}
	}
	
	function cargaContenidoCarrito()
	{
		$html = "";
		$carrito = $_SESSION["carrito"];
		$cantidad = $carrito->num_productos;
		
		for($i = 0; $i < $cantidad ; $i++)
		{
			$idActual = $carrito->array_id_prod[$i];
			if($idActual != -1)
			{
				$html .= "<div class='resumenPedido'>
						<div class='caratulaPeli'>
							<img src= ".$carrito->array_imagenes[$idActual]." width='120' height='120' /><br><br>
						</div>
					
						<div class='infoPeli'>
							<h3 class='cabeceraInfo'> ".$carrito->array_nombre_prod[$i]." </h3>
							<form method='post' action='incrementar.php'>
								<input type = 'hidden' name = 'idPeli' value = ".$idActual.">
								<button type='submit'>Añadir
							</form>
							<form method='post' action='decrementar.php'>
								<input type = 'hidden' name = 'idPeli' value = ".$idActual.">
								<button type='submit'>Quitar
							</form>
						</div>
					
						<div class='infoPrecio'>
							<h3 class='cabeceraInfo'> Precio </h3>
							<p class='adicional'><span class='precioYUnidades'>".$carrito->array_precio_prod[$i]." €</span></p><br>
						</div>
					
						<div class='infoCantidad'>
							<h3 class='cabeceraInfo'> Cantidad </h3>
							<p class='adicional'><span class='precioYUnidades'>".$carrito->array_unidades[$idActual]."</span></p><br>
						</div>
						
					</div>
					
				<div class='clear'>
				</div>";
			}
			
		}
		
		return $html;
	}
	
	function calculaTotal()
	{
		$carrito = $_SESSION["carrito"];
		$suma = 0;
		
		for ($i=0; $i < $carrito->num_productos; $i++)
		{ 	
			$idActual = $carrito->array_id_prod[$i];
			if($idActual !=-1)
			{ 
				$suma += ($carrito->array_precio_prod[$i] * $carrito->array_unidades[$idActual]); 
			} 
		} 
		
		return $suma;
	}

?>

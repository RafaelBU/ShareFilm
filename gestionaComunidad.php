<?php
	 require_once __DIR__.'/config.php'; 
	 require_once __DIR__.'/comunidadBD.php';
	 require_once __DIR__.'/usuariosBD.php';
	 require_once __DIR__.'/peliculasBD.php';
	 
	 if(isset($_GET['paginador']))
		cargaNovedades($_SESSION["user"]);
	
	 function cargaNovedades($usuario)
	 {
		//numero de registros por página
		$rowsPerPage = 7;

		//por defecto mostramos la página 1
		$pageNum = 1;

		// si $_GET['page'] esta definido, usamos este número de página
		if(isset($_GET['page'])) 
		{
			sleep(1);
			$pageNum = $_GET['page'];
		}
			
		$offset = ($pageNum - 1) * $rowsPerPage; // a partir de donde se va en la base de datos
		
		$consulta = buscaAmigos($usuario);
		$html = "";
		$nEventos = 0;
		$indice = 0;
		
		while($amigos = $consulta->fetch_assoc())
		{
			if($amigos['nick1'] == $usuario)
			{
				$amigo = $amigos['nick2'];
				$avatar = selectUser($amigo)['avatar'];
			}
			else {
				$amigo = $amigos['nick1'];
				$avatar = selectUser($amigo)['avatar'];
			}
			
			$consulta2 = dameHistorial($amigo, $offset, $rowsPerPage);
			
			while($historial = $consulta2->fetch_assoc())
			{
				$nEventos ++;
				$avatares[$indice] = $avatar;
				$eventos[$indice] = $historial;
				$indice++;
			}
				
		}
		
		$limite = 7 * $pageNum;
		if($nEventos < $limite)
		{
			$limite = $nEventos;
		}
		
		for($i = $offset; $i < $limite; $i++)
		{
			if($i < $nEventos)
			{
				$html .= "<div class='novedad'>
						<img class='avatarNovedad' src='".$avatares[$i]."' width='70' height='70' />
						<p class='textoNovedad'>".$eventos["$i"]['nick']." ha ".$eventos["$i"]['accion']." ".$eventos["$i"]['texto']."</p>
					</div>";
			}
			
		}
		
		$total_paginas = ceil($nEventos / $rowsPerPage); // ceil redondea hacia arriba, numero de paginas
		
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
	 
	 function cargaMasVotadasAmigos($usuario)
	 {
		$consulta = buscaAmigos($usuario);
		$html = "";
		$i = 0;
		$primerUser = true;
		$repetida = false;
		
		while($amigos = $consulta->fetch_assoc())
		{
			if($amigos['nick1'] == $usuario)
			{
				$amigo = $amigos['nick2'];
			}
			else {
				$amigo = $amigos['nick1'];
			}
			
			$consulta2 = dameValoradasAmigos($amigo);
			
			while($valoradas = $consulta2->fetch_assoc())
			{
				if($primerUser == true)
				{
					$arrayValoradas[$i] = $valoradas['IdPeli'];
					$e = $arrayValoradas[$i];
					$i++;
				}
				
				if($primerUser == false)
				{
					for($j = 0; $j < count($arrayValoradas); $j++)
					{
						if($arrayValoradas[$j] == $valoradas['IdPeli'])
							$repetida = true;
					}
					
					$arrayValoradas[$i] = $valoradas['IdPeli'];
					$e = $arrayValoradas[$i];
					$i++;
				}
				
				if($repetida == false)
				{
					$auxiliar = dameInfoFicha($valoradas['IdPeli'])->fetch_assoc();
					$html .= "<a href = 'fichaPelicula.php?idPeli=".$valoradas['IdPeli']."'> <span class='titulo'>".$auxiliar['Titulo']."</span></a>
						<img src='".$auxiliar['Portada']."' width='150' height='200' /><br>";
				}
				else{
					$repetida = false;
				}
				
			}
			
			$primerUser = false;
		}
		
		return $html;
	 }
	 
	 function cargaUsuariosPopulares()
	 {
		$arrayPopulares = dameUsuariosPopulares();
		$html = "";
		$j = -1;
		 
		foreach ($arrayPopulares as $item => $usuario)
		{
			$j++;
			if($j > 3)
			{
				return $html;
			}
			else{
				$html .= "<div class='usuariosPopulares'>
						<img class='avatarPopular' src='".buscaPorNombre($item)->fetch_assoc()['Avatar']."' width='50' height='50'/>
						<a href='perfilAmigo.php?nombre=".$item."' class='nickUsuario'>".$item."</a>";
						
						if(!esAmigo($item) && $item != $_SESSION["user"] )
						{
							$html .= "<form method = 'post' action = seguirUsuario.php>
										<input type = 'hidden' name = 'user' value = '".$item."'>
										<button type='submit' class='botonañadirAmigo' >Seguir</button>
									  </form>";
						}
						
					$html .= "</div>";
			}

		}
		
		return $html;
		 
	 }
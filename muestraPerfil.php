<?php 
	  require_once __DIR__.'/config.php'; 
	  require_once __DIR__.'/usuariosBD.php';
	
		function cargaAmigos($usuario){
		$html = "";
		$consulta = buscaAmigos($usuario);
		
		while($amigos = $consulta->fetch_assoc()){
			if($amigos['nick1'] == $usuario)
				$amigo = $amigos['nick2'];
			else $amigo = $amigos['nick1'];
			
			$datos = selectUser($amigo);
			
			$html .= "<div id ='fondoAvatar' class='colorAmigos'>
							<div id='imagenAvatar'>
								<img src=".$datos['avatar']." width='45' height='45' />		
							</div>
							
							<div id='tipoLetraAvatar'>
								<a href='perfilAmigo.php?nombre=".$amigo."'>
								".$amigo."
								</a>
							</div>
						
							<input id='botonAvatar' type='button' value = 'Siguiendo'>
						
						</div>";
						
		}
		return $html;
	}
	
	function cargaValoradas($usuario){
		$html = "";
		$consulta = buscaValoradas($usuario);
		while($valoradas = $consulta->fetch_assoc()){
			$html .= "<div class='columna'>
						<div class='imagenes'><img src='".$valoradas['portada']."' width='100' height='133' /></div>
						<div class='precios'><a href=''><span class='titulo'>".$valoradas['texto']."</span></a><br>
							<form  method='POST' action='compartir.php'> <input type='hidden' name='pelicula' value='".$valoradas['texto']."'> <input type='hidden' name='nombre' value='$usuario'> <input id='botonCompratir' type='submit' value = 'compartir'> </form>
						</div>
					</div>";
		}
		return $html;
	}
	
	function cargaRecomendadas($usuario){
		$html = "";
		$consultaAmigos = buscaAmigos($usuario);
		while($amigos = $consultaAmigos->fetch_assoc()){
			if($amigos['nick1'] == $usuario)
				$amigo = $amigos['nick2'];
			else $amigo = $amigos['nick1'];
			
			$consultaRecomendadas = buscaRecomendadasPelis($amigo);
			while($recomendadas = $consultaRecomendadas->fetch_assoc()){
				$html .= "<li>	
							<dl>	
								<dt><p> <span class='titulo'>".$recomendadas['texto']." </span></p></dt>
								<dd><img src='".$recomendadas['portada']."' width='100' height='133' />
								<p id='recomendadoPor'> Recomendado por ".$amigo."</p></dd>
							</dl>
						</li>";
			}
			$consultaRecomendadas = buscaRecomendadascompradas($amigo);
			while($recomendadas = $consultaRecomendadas->fetch_assoc()){
				$html .= "<li>	
							<dl>	
								<dt><p> <span class='titulo'>".$recomendadas['texto']." </span></p></dt>
								<dd><img src='".$recomendadas['portada']."' width='100' height='133' />
								<p id='recomendadoPor'> Recomendado por ".$amigo."</p></dd>
							</dl>
						</li>";
			}
		}
		return $html;
	}
	
	function cargaCompradas($usuario){
		$html = "";
		$consulta = buscaCompradas($usuario);
		while($compradas = $consulta->fetch_assoc()){
			$html .= "<div class='columna'>
						<div class='imagenes'><img src='".$compradas['portada']."' width='100' height='133' /></div>
						<div class='precios'><a href=''><span class='titulo'>".$compradas['texto']."</span></a><br>
							<form  method='POST' action='compartir.php'> <input type='hidden' name='pelicula' value='".$compradas['texto']."'> <input type='hidden' name='nombre' value='$usuario'> <input id='botonCompratir' type='submit' value = 'compartir'> </form>
						</div>
					</div>";
		}
		return $html;
	}
	
	function cargaMiPerfil($usuario){
		$html = "";
		$consulta = buscaMiPerfil($usuario);
		while($miPerfil = $consulta->fetch_assoc()){
			$html .= "<div id='imagenAvatar'>
						<img src='".$miPerfil['avatar']."' width='45' height='45' />		
					</div>
					
					<div id='tipoLetraAvatar'>
						<a href='perfilAmigo.php?nombre=".$usuario."'>
							".$miPerfil['nick']."
						</a>	
											
					</div>
					<a href='editarPerfil.php'><img  src='img/editar.png' width='32' height='27' /></a>";
		}
		return $html;
	}
	
	function cargaPerfilCompleto($usuario){
		$html = "";
		$consulta = buscaMiPerfil($usuario);
		while($perfilAmigo = $consulta->fetch_assoc()){
			$consultaAmigos = cuentaAmigos($usuario);
			$numAmigos = $consultaAmigos->fetch_assoc();
			$html .= "<img id ='avatarAmigo' src='".$perfilAmigo['avatar']."' width='210'/>
				
				<div id='datosAmigo'>
					<h2 id='nick'> ".$perfilAmigo['nick']."</h2>
					
					<h3 class='titulosInfo'> Acerca de ".$perfilAmigo['nick']." </h3>
					<p> <span class='campos'>Nombre </span>: ".$perfilAmigo['nombre']." </p>
					<p> <span class='campos'>Apellidos</span>: ".$perfilAmigo['apellidos']." </p>
					<p> <span class='campos'>Número de amigos</span>: ".$numAmigos['numAmigos']." </p>
					<p> <span class='campos'>Pais</span>: ".$perfilAmigo['pais']."</p>
					<p> <span class='campos'>Ciudad</span>: ".$perfilAmigo['ciudad']."</p>
					
				</div>
				
				<div id='infoContacto'>
					<h3 class='titulosInfo'> Contactar con ".$perfilAmigo['nick']." </h3>
					<p><span class='campos'>Email</span>: ".$perfilAmigo['mail']." </p>
				</div>";
		}
		return $html;
	}
?>
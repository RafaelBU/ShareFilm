<?php 	require_once __DIR__.'/config.php';
		require_once __DIR__.'/peliculasBD.php';

		if(isset($_GET['paginador']))
		cargaPaginador();
		if(isset($_GET['modo']))
		generaBotones();
		if(isset($_POST['voto']))
		generaVoto();
	
	
	function cargaTopPeliculas()
	{
		$html = "";
		$infoPeli = dameInfoPeli();
		while($resultado = $infoPeli->fetch_assoc())
		{
			$html .= "<a href = 'fichaPelicula.php?idPeli=".$resultado['IdPeli']."'><span class=titulo>".$resultado['Titulo']."</span></a>
			<img src=".$resultado['Portada']." width='150' height='200' /><br>";
		}
		
		return $html;
		
	}
	
	function cargaPaginador()
	{
		if (isset($_GET['letra']))
				{
					$inicial=$_GET['letra'];
					$num = cuentaPelisInicial($inicial);
				}
				else if (isset($_GET['genero']))
							{
								$genero=$_GET['genero'];
								$num = cuentaPelisGenero($genero);
							}
					else
		$num = cuentaPelis();
		
		if($num > 0) 
		{
			//numero de registros por página
			$rowsPerPage = 8;

			//por defecto mostramos la página 1
			$pageNum = 1;

			// si $_GET['page'] esta definido, usamos este número de página
			if(isset($_GET['page'])) {
				sleep(1);
				$pageNum = $_GET['page'];
				
			}
			
			$offset = ($pageNum - 1) * $rowsPerPage; // a partir de donde se va en la base de datos
			$total_paginas = ceil($num / $rowsPerPage); // ceil redondea hacia arriba, numero de paginas
			
			if (isset($_GET['letra']))
				{
					$registro = damePelisInicial($inicial,$offset, $rowsPerPage);					
				}
				else if (isset($_GET['genero']))
							{
								$registro = damePelisGenero($genero,$offset, $rowsPerPage);
							}
					else
						$registro = peliculas($offset, $rowsPerPage);
			
			$i = count($registro);
			
			for($ind = 0;$ind < $i ;$ind++)
			{	
				$html = " <li>
						<p id='parrafoPeli'><a href='fichaPelicula.php?idPeli=".$registro["$ind"]['ID']."'>".$registro["$ind"]['Titulo']."</a></p> 
						<img height='160px' width='110px' src='".$registro["$ind"]['Portada']."'/>
						<div id='imagenVotar'>".mostrarVotosPelicula($registro["$ind"]['ID'])."</div>
					</li>";
				echo $html;
				
			}
			
			
			if($total_paginas > 1) 
			{
				echo '<div class="indice">';
					if($pageNum != 1)
						echo "<a  id='".($pageNum-1)."' onclick='cargaPaginacion(this)'>Anterior</a>";
					
					for ($i=1;$i<=$total_paginas;$i++)
					{
						if ($pageNum == $i)
							echo" 	<button style='background-color:#9A9A9A;' id='".$i."'>".$i."</button>";
						else
							echo"	<button id='".$i."' onclick='cargaPaginacion(this)'>".$i."</button>";
					}
					
					if($pageNum != $total_paginas){
						
						echo "<a id='".($pageNum+1)."' onclick='cargaPaginacion(this)'>Siguiente</a>";
						
					}
				echo '</div>';
				
			}
		}
	
	}
	function cargaPeliculas ()
	{
		$html = "";
		$infoPeli = damePelis();
		while($resultado = $infoPeli->fetch_assoc())
		{
			$html .= " <li>
						<p id='parrafoPeli'><a href='fichaPelicula.php?idPeli=".$resultado['ID']."'>".$resultado['Titulo']."</a></p> 
						<img height='160px' width='110px' src='".$resultado['Portada']."'/>
						<div id='imagenVotar'>".mostrarVotosPelicula($resultado['ID'])."</div>
					</li>";
		}
		
		
					
		return $html;
	}
	
	function cargaPestana($discriminante,$modo)
	{
		$html = "";
		if($modo==0)
		$infoPeli = damePelisInicial($discriminante);
		else
		$infoPeli=damePelisGenero($discriminante);
		while($resultado = $infoPeli->fetch_assoc())
		{
			$html .= " <li>
						<p id='parrafoPeli'><a href='fichaPelicula.php?idPeli=".$resultado['ID']."'>".$resultado['Titulo']."</a></p> 
						<img height='160px' width='110px' src='".$resultado['Portada']."'/>
						<div id='imagenVotar'>".mostrarVotosPelicula($resultado['ID'])."</div>
					</li>";
		}
		
		
		if(empty($html))
			$html="<p>No se encontro ningun resultado</p>";
		return $html;
	}
	
	function cargaFicha($id)
	{
		$infoPeli = dameInfoFicha($id);
		$resultado = $infoPeli->fetch_assoc();
		$html="<div id='imagenFicha'>
					<img height='290px' width='210px' src='".$resultado['Portada']."'/>
				</div>
				<div id='datos_Pelicula'>
				<h1>".$resultado['Titulo']."</h1>
					<p><strong>Dirigido por: </strong>".$resultado['Director']."</p>
					<p><strong>Reparto principal:</strong>".$resultado['Actores']."</p>
					<strong>Sinopsis:</strong>
					<p>".$resultado['Sinopsis']."</p>
				</div>";
			
		return $html;
	}
	
	function mostrarVotosFicha($id){
		
		$voto=mediaVoto($id);
		$voto=round($voto);// voto redondeado
		
		$html="";
		if(isset($_SESSION['user'])){
			for($i=0; $i<5; $i++){
				$num=$i+1;
				if($i<$voto)
						$html.="<input type='image' id='$num' onclick='votar(this,$id)' width='25px' src='img/logo.png'/>";
					else
						$html.="<input type='image' id='$num' onclick='votar(this,$id)' width='25px' src='img/logonoseleccionado.png'/>";
			
			}
		}
		else{
			for($i=0; $i<5; $i++){
				$num=$i+1;
				if($i<$voto)
						$html.="<a href='usuarioLogin.php'><input type='image' id='$num' width='25px' src='img/logo.png'/></a>";
					else
						$html.="<a href='usuarioLogin.php'><input type='image' id='$num' width='25px' src='img/logonoseleccionado.png'/></a>";
			
			}
		}
		return $html;
	}
	
	function mostrarVotosPelicula($id){
		
		$voto=mediaVoto($id);
		$voto=round($voto);// voto redondeado
		
		$html="";
		for($i=0; $i<5; $i++){
			$num=$i+1;
			if($i<$voto)
					$html.="<img src='img/logo.png' width='25px' id='$num'/>";
				else
					$html.="<img src='img/logonoseleccionado.png' width='25px' id='$num'/>";
		
		}
		return $html;
	}
	
	function cargaGeneros()
	{	$infoGeneros = dameGeneros();
		$html="";
		while($resultado = $infoGeneros->fetch_assoc())
		{
			$html .= "<button id='".$resultado['Id']."'onclick='eligeGenero(this)'>".$resultado['Tipo']."</button>";
		}
		$html .="<button id='letras' onclick='cambiaLetras()'>Alfabeticamente</button>";
		return $html;
	}
	
	function cargaAlfabeto()
	{ $html="<button id='A' onclick='eligeLetra(this)'>A</button>
					<button id='B' onclick='eligeLetra(this)'>B</button>
					<button id='C' onclick='eligeLetra(this)'>C</button>
					<button id='D' onclick='eligeLetra(this)'>D</button>
					<button id='E' onclick='eligeLetra(this)'>E</button>
					<button id='F' onclick='eligeLetra(this)'>F</button>
					<button id='G' onclick='eligeLetra(this)'>G</button>
					<button id='H' onclick='eligeLetra(this)'>H</button>
					<button id='I' onclick='eligeLetra(this)'>I</button>
					<button id='J' onclick='eligeLetra(this)'>J</button>
					<button id='K' onclick='eligeLetra(this)'>K</button>
					<button id='L' onclick='eligeLetra(this)'>L</button>
					<button id='M' onclick='eligeLetra(this)'>M</button>
					<button id='N' onclick='eligeLetra(this)'>N</button>
					<button id='Ñ' onclick='eligeLetra(this)'>Ñ</button>
					<button id='O' onclick='eligeLetra(this)'>O</button>
					<button id='P' onclick='eligeLetra(this)'>P</button>
					<button id='Q' onclick='eligeLetra(this)'>Q</button>
					<button id='R' onclick='eligeLetra(this)'>R</button>
					<button id='S' onclick='eligeLetra(this)'>S</button>
					<button id='T' onclick='eligeLetra(this)'>T</button>
					<button id='U' onclick='eligeLetra(this)'>U</button>
					<button id='V' onclick='eligeLetra(this)'>V</button>
					<button id='W' onclick='eligeLetra(this)'>W</button>
					<button id='X' onclick='eligeLetra(this)'>X</button>
					<button id='Y' onclick='eligeLetra(this)'>Y</button>
					<button id='Z' onclick='eligeLetra(this)'>Z</button>
					<button onclick='cambiagenero()'>Genero</button>
					<button id='' onclick='eligeLetra(this)'>Todas</a></button>";
					return $html;
	}
	
	function cargaPestanaBuscador($discriminante)
	{
		$html = "";
		
		$infoPeli=damePelisBusqueda($discriminante);
				while($resultado = $infoPeli->fetch_assoc())
		{
			$html .= " <li>
						<p id='parrafoPeli'><a href='fichaPelicula.php?idPeli=".$resultado['ID']."'>".$resultado['Titulo']."</a></p> 
						<img height='160px' width='110px' src='".$resultado['Portada']."'/>
						<div id='imagenVotar'>".mostrarVotosPelicula($resultado['ID'])."</div>
					</li>";
		}
		
		
		if(empty($html))
			$html="<p>No se encontro ningun resultado</p>";
		return $html;
	}
	
	function generaBotones()
	{
	if($_GET['modo']=="alfabetico")
		$html=cargaAlfabeto();
	else
		$html=cargaGeneros();
	echo $html;
	}
	
	function generaVoto()
	{
		
		$voto= $_POST['voto'];
		$idPeli= $_POST['idPeli'];
		votarPelicula($_SESSION['user'],$idPeli,$voto);
		echo "Ha calificado la pelicula con un $voto";

	}

?>
		
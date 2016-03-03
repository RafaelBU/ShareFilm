<?php
	require_once __DIR__.'/noticiasBD.php';

	if(isset($_GET['paginador']))
		cargaNoticias();
	
	function cargaNoticias()
	{	
		$num = cuentaNoticias();
		
		if($num > 0) 
		{
			//numero de registros por página
			$rowsPerPage = 3;

			//por defecto mostramos la página 1
			$pageNum = 1;

			// si $_GET['page'] esta definido, usamos este número de página
			if(isset($_GET['page'])) {
				sleep(1);
				$pageNum = $_GET['page'];
				
			}
			
			$offset = ($pageNum - 1) * $rowsPerPage; // a partir de donde se va en la base de datos
			$total_paginas = ceil($num / $rowsPerPage); // ceil redondea hacia arriba, numero de paginas
			
			$registro = noticias($offset, $rowsPerPage);
			
			$i = count($registro);
		
			echo "<h2 id='titulo'> NOTICIAS </h2>";
			for($ind = 0;$ind < $i ;$ind++)
			{	
				$fecha = split('[ ]', $registro["$ind"]["Fecha"]); // la fecha sin hora
				
				$html='';
				
				if(isset($_SESSION["login"]))
					$html.='<a href="perfilAmigo.php?nombre='.$registro["$ind"]["Nick"].'">'.$registro["$ind"]["Nick"].'</a>';
				else
					$html.=$registro["$ind"]["Nick"];	
				
				echo'<div id="noticia" class="contenedorNoticias">
						<div id="imagen"> 
							<img src="'.$registro["$ind"]["Foto"].'" width="100%" height="190"/> 
						</div>';
				
								
				echo'	<h1><a href="vistaNoticia.php?idN='.$registro["$ind"]["ID"].'"> '.$registro["$ind"]["Titulo"].' </a></h1>';
						
				
				echo'	<div id="datosNoticia">	
							<span class="datos">por '.$html.', '.$fecha[0].'. <a href="vistaNoticia.php?idN='.$registro["$ind"]["ID"].'#comentarios"> comentarios</a></span>
						</div>';
						
				echo'	<span class="datos">'.$registro["$ind"]["Cabecera"].'<br><br> 
							<a href="vistaNoticia.php?idN='.$registro["$ind"]["ID"].'">Continuar leyendo -> </a> 
						</span>'; 
				echo '</div>';
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
	
	function cargaNoticiaConcreta($idNoticia){
		
		$noticia = noticiaConcreta($idNoticia);
		
		$fecha = split('[ ]', $noticia["Fecha"]); // la fecha sin hora
		
		$html ='';
		
		if(isset($_SESSION["login"]))
			$html.='<a href="perfilAmigo.php?nombre='.$noticia["Nick"].'">'.$noticia["Nick"].'</a>';
		else
			$html.=$noticia["Nick"];	
		
		echo'	<h1>'.$noticia["Titulo"].'</h1>';
					
		echo'	<div id="vistaEntradilla">
					<span class="datos">
						'.$noticia["Cabecera"].' 
					</span>
				</div>';
					
		echo'	<div id = "datosNoticia" class="datosVista">	
					<span class="datos">por: '.$html.'<hr/>
					'.$fecha[0].'</span>
				</div>';
				
		echo'	<img id ="imgNoticia" src="'.$noticia["Foto"].'" height="300"/>';
				
		echo   '<p>'.$noticia["Contenido"].'</p>';
		
	}
	
	function muestraComentarios($idNoticia){
		
		$array_comentarios = cargaComentarios($idNoticia);
		
		foreach ($array_comentarios as $valor){
			
			$html ='';
			
			if(isset($_SESSION["login"]))
				$html.='<a href="perfilAmigo.php?nombre='.$valor["Nick"].'">'.$valor["Nick"].'</a>';
			else
				$html.=$valor["Nick"];
			
			echo'<div id="comentar" class="comentario">
									
					<div id="infoComentario">
						<img src="'.$valor["Avatar"].'" width="50" height="50" />
						'.$html.'
						<p>'.$valor["Fecha"].'</p>
					</div>';
					
			echo	'<div id="estiloComentario">
						<p>'.$valor["Coment"].'</p>
					</div>
				</div>';
		}

	}
	
	function cargaSlide()
	{
		$html = "";
		$consulta = dameSlide();
		
		while($slide = $consulta->fetch_assoc())
		{
			$html .= "<li>";
						  $html .= "<a href = 'vistaNoticia.php?idN=".$slide['ID']."'><img src='".$slide["Foto"]."' height='190' /></a>";
						  $html .= "<p class='caption'>".$slide['Titulo']."</p>
					</li>";
		}
		
		return $html;
	}
?>
<?php
	require_once __DIR__.'/config.php';
	
	function insertar_noticia($noticia){
		global $BD;	
		$mysqltime = date("Y-m-d H:i:s", time());
		$noticia["titular"] = $BD->real_escape_string($noticia["titular"]);
		$noticia["entradilla"] = $BD->real_escape_string($noticia["entradilla"]);;
		$noticia["cuerpo"]= $BD->real_escape_string($noticia["cuerpo"]);
		$noticia["url"]= $BD->real_escape_string($noticia["url"]);
		
		$query="INSERT INTO noticias (ID,Titulo,Cabecera,Nick,Fecha,Contenido,Foto) VALUES ('','".$noticia['titular']."','".$noticia['entradilla']."','".$_SESSION['user']."','".$mysqltime."','".$noticia['cuerpo']."','".$noticia['url']."')";
		
		$BD-> query($query)
			or die ($BD->error. ' en la línea '.(__LINE__-1));
		
		$query2 = "INSERT INTO historial (nick, fecha, accion, texto) VALUES ('".$_SESSION['user']."', now(), 'escrito', '".$noticia['titular']."')";
		$BD-> query($query2)
			or die ($BD->error. ' en la línea '.(__LINE__-1));
	}

	function noticias($offset, $rowsPerPage){
		global $BD;
		$query = "SELECT *
   				  FROM noticias
				  ORDER BY Fecha DESC
				  LIMIT $offset, $rowsPerPage";
				  
		$resultado = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		if($resultado -> num_rows > 0){
			$numNoticias = $resultado->num_rows;
			
			for($contador = 0 ; $contador < $numNoticias ; $contador++) //asigno las filas en un array
				$noticias[$contador] = $resultado->fetch_assoc();
	
			$resultado->close();
		 }
		 else 
			 $noticias=array();
  
		return $noticias;
	}
	
	function cuentaNoticias(){
		global $BD;
		$query = "SELECT count(*) FROM noticias";
		
		$result = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		$result = $result->fetch_assoc();
		
		return $result["count(*)"];
	}
	
	function noticiaConcreta($id){
		global $BD;
		$query = "SELECT * FROM noticias WHERE ID like'$id'";
		$noticiaConcreta = array();
		
		if($resultado = $BD->query($query)) 
		{
			$noticiaConcreta = $resultado->fetch_assoc();
			$resultado->close();
		}
 
		return $noticiaConcreta;
	}
	
	function cargaComentarios($idNoticia){
		
		global $BD;
		
		$query = "SELECT Fecha, c.Nick, Coment, Avatar
				  FROM comentario as c, usuarios as u
				  WHERE IdNoticia = '$idNoticia' and c.Nick = u.Nick 
				  ORDER BY Fecha";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		if($consulta -> num_rows > 0) 
		{
			$numComentarios = $consulta->num_rows;
			
			for($contador = 0 ; $contador < $numComentarios ; $contador++) //asigno las filas en un array
				$comentarios[$contador] = $consulta->fetch_assoc();
		}
		else
			$comentarios = array();
			
		
		return $comentarios;
	}
	
	function insertarComentario($comentario){
		$fechaComentario = date("Y-m-d H:i:s", time());
		global $BD;
		
		$comentario["Nick"] = $BD->real_escape_string($comentario["Nick"]);
		$comentario["Comentario"] = $BD->real_escape_string($comentario["Comentario"]);
		$comentario["IdNoticia"] = $BD->real_escape_string($comentario["IdNoticia"]);
		
		$query1 = "INSERT INTO comentario(Fecha, Nick, IdNoticia, Coment) VALUES ('".$fechaComentario."','".$comentario['Nick']."','".$comentario['IdNoticia']."','".$comentario['Comentario']."')";
		
		
		$BD-> query($query1)
			or die ($BD->error. ' en la línea '.(__LINE__-1));
			
		$consulta = "SELECT Titulo FROM noticias WHERE ID = ".$comentario['IdNoticia'];
		$resultado = $BD-> query($consulta)
			or die ($BD->error. ' en la línea '.(__LINE__-1));
		
		$titulo = $resultado->fetch_assoc()['Titulo'];
		
		$query2 = "INSERT INTO historial (nick, fecha, accion, texto) VALUES ('".$comentario['Nick']."', now(), 'comentado', '".$titulo."')";
			$BD-> query($query2)
				or die ($BD->error. ' en la línea '.(__LINE__-1));
	}
	
	function dameSlide()
	{
		global $BD;
		
		$query = "SELECT * FROM noticias ORDER BY Fecha DESC LIMIT 3";
		
		$consulta = $BD->query($query)
			or die ($BD->error. ' en la línea '.(__LINE__-1));
			
		return $consulta;
	}
?>

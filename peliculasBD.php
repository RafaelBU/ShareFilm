<?php 	require_once __DIR__.'/config.php';

	function dameInfoPeli()
	{
		global $BD;
		
		$query = "SELECT IdPeli, Titulo, Portada, sum(nota)/count(IdPeli) as suma 
				FROM `vota`, peliculas 
				WHERE vota.IdPeli = peliculas.ID GROUP BY IdPeli 
				ORDER BY suma DESC
				LIMIT 3";
		$consulta = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		return $consulta;
	}
	
	function damePelis()
	{
	
	global $BD;

	$query = "SELECT * FROM peliculas
			  ORDER BY Titulo
			  ";
	$consulta = $BD->query($query)
		or die ($BD->error. " en la línea ".(__LINE__-1));
	
	return $consulta;
	}
	
	
	
	function dameInfoFicha($id)
	{
		global $BD;
		
		$query = "SELECT * FROM peliculas
				where ID like'".$id."'";
		$consulta = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		return $consulta;
	}
	
	function dameGeneros()
	{
		global $BD;
		
		$query = "SELECT * FROM genero";
		$consulta = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		return $consulta;
	}

	
	
	function insertPeli($params){
		global $BD;	
		$params = escapeInputPeli($params);
		
		$imagen = "img/peliculas/"; 
		$imagen = $imagen.basename($params['portada']['name']);
		move_uploaded_file($params['portada']['tmp_name'], $imagen);
		
		$query = "INSERT INTO peliculas (titulo, director, actores, sinopsis, portada)
		VALUES ('".$params['titulo']."','".$params['director']."','".$params['actores']."','".$params['sinopsis']."','".$imagen ."')";
		$BD-> query($query)
			or die ($BD->error. ' en la linea '.(__LINE__-1));
			
		$query2 = "SELECT id FROM peliculas
					WHERE '".$params['titulo']."' LIKE peliculas.titulo";
		$consulta=$BD->query($query2)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		$peli = $consulta->fetch_assoc();
		
		$query3 = "SELECT id FROM Genero
					WHERE '".$params['genero']."' LIKE tipo";
		$consulta=$BD->query($query3)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		$genero = $consulta->fetch_assoc();
		
		$query4 = "INSERT INTO tienegeneropeli (idPeli, Genero) VALUES ('".$peli['id']."', '".$genero['id']."')";
		$BD-> query($query4)
			or die ($BD->error. ' en la linea '.(__LINE__-1));
	}
	
	function escapeInputPeli($params)
	{
		global $BD;	
		
		$params["titulo"] = $BD->real_escape_string($params['titulo']);
		$params["director"] = $BD->real_escape_string($params['director']);
		$params["actores"] = $BD->real_escape_string($params['actores']);
		$params["sinopsis"] = $BD->real_escape_string($params['sinopsis']);
		$params["genero"] = $BD->real_escape_string($params['genero']);
		
		return $params;
	}
	
	function damePelisBusqueda($titulo)
	{
		global $BD;

		$titulo = $BD->real_escape_string($titulo);
		
		$query = "SELECT * FROM peliculas
			  WHERE Titulo LIKE '%".$titulo."%'
			  ORDER BY Titulo";
			  
		$consulta = $BD->query($query)
		or die ($BD->error. " en la línea ".(__LINE__-1));
	
		return $consulta;
	}
	
	function votarPelicula($idUsuario, $idPeli, $Nota){
		
		global $BD;
		
		$cuenta="SELECT count(*) FROM vota where IdPeli='".$idPeli."' and Nick ='".$idUsuario."'";
		$consulta = $BD->query($cuenta)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		$consulta = $consulta->fetch_assoc();
		
		//si ya existe entonces modifico su voto
		if($consulta["count(*)"] == 1){
			$modifica = "UPDATE vota 
					 SET Nota = '".$Nota."'
					 where Nick='".$idUsuario."' and IdPeli='".$idPeli."'";
			$resultado = $BD->query($modifica)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		}
		else{ // si no existe pelicula votada por ese usuario creo la fila
			$idUsuario= $BD->real_escape_string($idUsuario);
			$idPeli= $BD->real_escape_string($idPeli);
			$Nota= $BD->real_escape_string($Nota);
			
			$inserta = "INSERT INTO vota VALUES ('".$idUsuario."', '".$idPeli."', '".$Nota."')";
			
			$resultado = $BD->query($inserta)
			or die ($BD->error. " en la línea ".(__LINE__-1));
			
			$query1="SELECT * FROM peliculas where ID='".$idPeli."'";
			$consulta = $BD->query($query1)
				or die ($BD->error. " en la línea ".(__LINE__-1));
			$resultado = $consulta->fetch_assoc()['Titulo'];
			
			$query2 = "INSERT INTO historial (nick, fecha, accion, texto) VALUES ('".$_SESSION['user']."', now(), 'valorado', '".$resultado."')";
			$BD->query($query2)
				or die ($BD->error. " en la línea ".(__LINE__-1));
		}
			
	}
	
	function mediaVoto($idPeli){
		global $BD;
		
		$cuenta="SELECT avg(Nota)
				 FROM vota
				 WHERE IdPeli='".$idPeli."'";
		
		$resultado = $BD->query($cuenta)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		$resultado = mysqli_fetch_assoc($resultado);
		
		if(!$resultado["avg(Nota)"])
			$Nota=0;
		else
			$Nota=$resultado["avg(Nota)"];
		
		return $Nota;
	}
	
	function cuentaPelis()
	{
		global $BD;
		
		$cuenta="SELECT count(*)
				 FROM peliculas";
		
		$result = $BD->query($cuenta)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		$result = $result->fetch_assoc();
		
		return $result["count(*)"];
	}
	
	
	function peliculas($offset, $rowsPerPage){
		global $BD;
		$query = "SELECT *
   				  FROM peliculas
				  ORDER BY Titulo 
				  LIMIT $offset, $rowsPerPage";
				  
		$resultado = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		if($resultado -> num_rows > 0){
			$numPelis = $resultado->num_rows;
			
			for($contador = 0 ; $contador < $numPelis ; $contador++) //asigno las filas en un array
				$pelis[$contador] = $resultado->fetch_assoc();
	
			$resultado->close();
		 }
		 else 
			 $pelis=array();
  
		return $pelis;
	}
	
	function damePelisInicial($inicial,$offset, $rowsPerPage)
	{
	
	global $BD;

	$query = "SELECT * FROM peliculas
			  WHERE Titulo LIKE '".$inicial."%'
			  ORDER BY Titulo
			  LIMIT $offset, $rowsPerPage";
	$resultado = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		if($resultado -> num_rows > 0){
			$numPelis = $resultado->num_rows;
			
			for($contador = 0 ; $contador < $numPelis ; $contador++) //asigno las filas en un array
				$pelis[$contador] = $resultado->fetch_assoc();
	
			$resultado->close();
		 }
		 else 
			 $pelis=array();
  
		return $pelis;
	}
	
	function damePelisGenero($genero,$offset,$rowsPerPage)
	{
	
	global $BD;

	$query = "SELECT * FROM peliculas,tienegeneropeli
			  WHERE peliculas.ID = tienegeneropeli.idPeli and Genero =".$genero."
			  ORDER BY peliculas.Titulo
			  LIMIT $offset, $rowsPerPage";
	$resultado = $BD->query($query)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		if($resultado -> num_rows > 0){
			$numPelis = $resultado->num_rows;
			
			for($contador = 0 ; $contador < $numPelis ; $contador++) //asigno las filas en un array
				$pelis[$contador] = $resultado->fetch_assoc();
	
			$resultado->close();
		 }
		 else 
			 $pelis=array();
  
		return $pelis;
	}

		function cuentaPelisInicial($inicial)
	{
		global $BD;
		
		$cuenta="SELECT count(*)
				 FROM peliculas
				 WHERE Titulo LIKE '".$inicial."%'";
		
		$result = $BD->query($cuenta)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		$result = $result->fetch_assoc();
		
		return $result["count(*)"];
	}
	
		function cuentaPelisGenero($genero)
	{
		global $BD;
		
		$cuenta="SELECT count(*)
				 FROM peliculas,tienegeneropeli
				 WHERE peliculas.ID = tienegeneropeli.idPeli and Genero =".$genero;
		
		$result = $BD->query($cuenta)
			or die ($BD->error. " en la línea ".(__LINE__-1));
		
		$result = $result->fetch_assoc();
		
		return $result["count(*)"];
	}
?>

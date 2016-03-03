<?php
	require_once __DIR__.'/config.php';
	
	function selectUser($nombre){
		global $BD;
		$nombre = $BD->real_escape_string($nombre);
		
		$query = "SELECT nick,password,nombre,apellidos,pais,ciudad,mail,avatar,admin FROM usuarios where BINARY nick = '$nombre'";
		$usuario = false;
		if ($resultado = $BD->query($query)) 
		{
			$usuario = $resultado->fetch_assoc();
			$resultado->close();
		}
  
		return $usuario;
	}
	
	function insertUser($params)
	{ 
		global $BD;	
		$params = escapeInput($params);
		
		$imagen = "img/Avatares/";
		if($params['avatar']['error'])
		{
			$imagen.= "usuarioTrans.png";
		}
		else{ 
			$imagen .= $params['nick'];
			move_uploaded_file( $params['avatar']['tmp_name'], $imagen);
		}
		
		$query = "INSERT INTO usuarios (nick,password,nombre,apellidos,pais,ciudad,mail,avatar,admin) VALUES ('".$params['nick']."','".$params['pass']."','".$params['nombre']."','".$params['apellidos']."','".$params['pais']."','".$params['ciudad']."','".$params['email']."','".$imagen."', '0')";
		$resultado = $BD-> query($query)
			or die ($BD->error. ' en la linea '.(__LINE__-1));
			
		return $resultado;
			
	}
	
	function insertAdmin($params){ 
		global $BD;	
		$params = escapeInput($params);
		
		if($params['avatar'] == NULL)
		{
			$imagen = NULL;
		}
		
		$query = "INSERT INTO usuarios (nick,password,nombre,apellidos,pais,ciudad,mail,avatar,admin) VALUES ('".$params['nick']."','".$params['pass']."','".$params['nombre']."','".$params['apellidos']."','".$params['pais']."','".$params['ciudad']."','".$params['email']."','".$imagen."', '1')";
		$BD-> query($query)
			or die ($BD->error. ' en la linea '.(__LINE__-1));
			
	}
	
	function updateUser($params,$originalNick)
	{
		global $BD;	
		$params=escapeInput($params);
		$originalNick = $BD->real_escape_string($originalNick);
		
		$imagen = "img/Avatares/";
		if($params['avatar']['error']){
			if($originalNick == $params['nick']) {
				$imagen = $params['avatarOriginal'];
			}
			else if($originalNick != $params['nick']) {
				$imagen .= $params['nick'];
				rename($params['avatarOriginal'], $imagen);
			}
		}
		else{
			unlink($params['avatarOriginal']);
			$imagen .= $params['nick'];
			move_uploaded_file($params['avatar']['tmp_name'], $imagen);
		}
		
		
		
		$query = "UPDATE usuarios
				 SET nick='".$params['nick']."' ,password='".$params['pass']."',nombre='".$params['nombre']."',apellidos='".$params['apellidos']."',pais='".$params['pais'].
				 "',ciudad='".$params['ciudad']."',mail='".$params['email']."', avatar = '".$imagen."'
				 where nick='".$originalNick."'";
		$BD-> query($query)
			or die ($BD->error. ' en la linea '.(__LINE__-1));
	}
	
	function buscaAmigos($usuario)
	{
		global $BD;
		
		$query1 = "SELECT nick1, nick2 FROM amigo
				 WHERE Nick1 = '$usuario' or nick2 = '$usuario'";
					
		$consulta = $BD->query($query1)
			or die ($BD->error. " en la linea ".(__LINE__-1));
	
		return $consulta;
		
	}
	
	function buscaValoradas($usuario){
		global $BD;
		
		$query = "SELECT nick,fecha,accion,texto,portada FROM historial,peliculas where nick LIKE '$usuario' AND accion LIKE 'valorado' AND peliculas.Titulo LIKE texto ORDER BY fecha";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la linea ".(__LINE__-1));
			
		return $consulta;
			
	}
	
	function buscaCompradas($usuario){
		global $BD;
		
		$query = "SELECT nick,fecha,accion,texto,portada FROM historial,peliculatienda where nick LIKE '$usuario' AND accion LIKE 'comprado' AND peliculatienda.Titulo LIKE texto ORDER BY fecha";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la linea ".(__LINE__-1));
			
		return $consulta;
			
	}
	
	function buscaRecomendadasPelis($usuario){
		global $BD;
		
		$query = "SELECT nick,fecha,accion,texto,portada
		FROM historial,peliculas
		where nick LIKE '$usuario' AND accion LIKE 'recomendado' AND Titulo LIKE texto
		ORDER BY fecha";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la linea ".(__LINE__-1));
			
		return $consulta;
			
	}
	
	function buscaRecomendadasCompradas($usuario){
		global $BD;
		
		$query = "SELECT nick,fecha,accion,texto,portada
		FROM historial,peliculatienda
		where nick LIKE '$usuario' AND accion LIKE 'recomendado' AND Titulo LIKE texto
		ORDER BY fecha";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la linea ".(__LINE__-1));
			
		return $consulta;
			
	}
	
	function compartir($usuario, $pelicula){
		global $BD;
		
		$query = "INSERT INTO historial (nick, accion, texto) VALUES ('".$usuario."', 'recomendado', '".$pelicula."')";
		
		$BD->query($query);
			//or die ($BD->error. " en la linea ".(__LINE__-1));
	}
	
	function buscaMiPerfil($nombre){
		global $BD;
		
		$query = "SELECT nick, password, nombre, apellidos, pais, ciudad, mail, avatar
		FROM usuarios
		WHERE nick LIKE '$nombre'";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la linea ".(__LINE__-1));
		
		return $consulta;
	}
	
	function cuentaAmigos($nombre){
		global $BD;
		
		$query = "SELECT count(*) as numAmigos
		FROM amigo
		WHERE Nick1 LIKE '$nombre' OR Nick2 LIKE '$nombre'";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la linea ".(__LINE__-1));
		
		return $consulta;
	}
	
	function buscaPorNombre($user)
	{
		global $BD;
		
		$user = $BD->real_escape_string($user);
		
		$query = "SELECT * FROM usuarios WHERE BINARY Nick  = '$user' and Admin = 0";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la linea ".(__LINE__-1));
		
		return $consulta;
	}
	
	function esAmigo($amigo)
	{
		global $BD;
		
		$usuarioActual = $_SESSION["user"];
		
		$query = "SELECT * FROM amigo WHERE Nick1 = '$amigo' and Nick2 = '$usuarioActual'
											OR  Nick2 = '$amigo' and Nick1 = '$usuarioActual'";
		
		$consulta = $BD->query($query)
			or die ($BD->error. " en la linea ".(__LINE__-1));
		
		if($consulta->num_rows > 0)
		{
			return true;
		}
		else{
			return false;
		}
	}
	
	function añadeAmigo($user)
	{
		global $BD;
		
		$nick = $_SESSION["user"];
		
		$query = "INSERT INTO amigo VALUES('$nick', '$user')";
		
		$BD->query($query)
			or die ($BD->error. " en la linea ".(__LINE__-1));
	}
	
	function escapeInput($params)
	{
		global $BD;	
		
		$params['nick']=$BD->real_escape_string($params['nick']);
		//$params['pass'] =$BD->real_escape_string($params['pass']);
		$params['nombre'] =$BD->real_escape_string($params['nombre']);
		$params['pais'] =$BD->real_escape_string($params['pais']);
		$params['ciudad'] =$BD->real_escape_string($params['ciudad']);
		$params['apellidos'] =$BD->real_escape_string($params['apellidos']);
		$params['email'] =$BD->real_escape_string($params['email']);
		
		return $params;
	}
	
?>

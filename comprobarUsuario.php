<?php
 require_once __DIR__.'/config.php'; 
 require_once __DIR__.'/usuariosBD.php';

	$user = $_GET['user'];

	$resultado = buscaPorNombre($user);
	
	if($resultado->num_rows == 0)
	{
		echo "<p id='sinResultados'>No se encontró ningún usuario con este nick :( </p>";
	}
	else{
		while($consulta = $resultado->fetch_assoc())
		{
			echo "<div class='usuariosPopulares'>
						<img class='avatarPopular' src='".$consulta['Avatar']."'  width='50' height='50'/>
						<a href='perfilAmigo.php?nombre=".$consulta['Nick']."' class='nickUsuario'>".$consulta['Nick']."</a>";
						if(!esAmigo($consulta['Nick']) && $consulta['Nick'] != $_SESSION["user"] )
						{
							echo "<form method = 'post' action = seguirUsuario.php>
										<input type = 'hidden' name = 'user' value = '".$consulta['Nick']."'>
										<button type='submit' class='botonañadirAmigo' >Seguir</button>
									  </form>";
						}
					echo "</div>";
		}
		
	}

?>
<!DOCTYPE html>
<?php 	
		require_once __DIR__.'/config.php'; ?>
<html>
	<h3> SHARE FILM </h3>
		<div id="logo">
			<img src="img/logogrande.png" width="75" height="75"/>
		</div>
		
		<?php 
		if(!isset($_SESSION['admin']) || $_SESSION['admin'] == false){
			echo "<div id='buscador'>
					 <form method = 'get' action = 'peliculas.php'>
						<input required='required' name='buscador' maxlength='50' type='text' placeholder = 'Titulo pelicula'>
						<button type='submit' id='botonBusca' >BUSCAR</button>
					</form>
			</div>";
		}
		else {
			echo "<div id='buscador'>
					 
					 <br>
			</div>";
		}
		?>
		<ul>
			<?php
				if(isset($_SESSION["login"]) && $_SESSION["admin"] == true){
					echo "<li><a title='Alta' href= 'registroAdmin.php' >ALTA</a></li>";
					echo "<li><a title='Películas' href='peliculasAdmin.php'>PELÍCULAS</a></li>";
					echo "<li><a title='Tienda' href='tiendaAdmin.php'>TIENDA</a></li>";
				}
				else{
					if(isset($_SESSION["login"])){
						$comunidad = "comunidad.php";
						$usuarioLogin = "miPerfil.php";
					}
					else{
						$comunidad = "usuarioLogin.php";
						$usuarioLogin = "usuarioLogin.php";
					}
					echo "<li><a title='Inicio' href= 'default.php' >INICIO</a></li>";
					echo "<li><a title='Noticias' href='Noticias.php'>NOTICIAS</a></li>";
					echo "<li><a title='Películas' href='peliculas.php'>PELÍCULAS</a></li>";
					echo "<li><a title='Comunidad' href= ".$comunidad." >COMUNIDAD</a></li>";
					echo "<li><a title='Tienda' href='tienda.php'>TIENDA</a></li>";
					echo "<li><a title='Usuario' href= ".$usuarioLogin." >USUARIO</a></li>";
				}
				if(isset($_SESSION["login"])){
					echo "<li><a title='Usuario' href='logout.php'>LOGOUT</a></li>";
				}
			?>
		</ul>
</html>
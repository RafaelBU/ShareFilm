<!DOCTYPE html>
<?php	
		require_once __DIR__.'/config.php';
		require_once __DIR__.'/gestionaComunidad.php';
?>
<html>
	<head>
		<title> Comunidad ShareFilm </title>
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="lateral_izquierdo.css" />
		<link rel="stylesheet" type="text/css" href="lateral_derecho.css" />
		<link rel="stylesheet" type="text/css" href="centro.css" />
		<link rel="stylesheet" type="text/css" href="estiloComunidad.css" />
		<script src="js/jquery-1.9.1.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
		<link rel="icon" href="img/logogrande.png" type="image/png">
		<script>
			$(document).ready(function(){
				$("#tituloUsuariosP").show();
				$("#tituloResultados").hide();
				
				$("#textoBuscador").change(function(){
					$("#tituloUsuariosP").hide();
					$("#tituloResultados").show();
					
					if($("#textoBuscador").val().length < 1)
					{
						$("#tituloUsuariosP").show();
						$("#tituloResultados").hide();
						
						var url="recuperaUsuarios.php";
						$.get(url,function(data,status){
							$("#menuScroll2").html(data);
						});
					}
				});
				
				$("#botonBuscaUsuarios").click(function(){
					if($("#textoBuscador").val().length < 1)
					{
						alert('Introduce un nombre');
					}
					else{
						var url="comprobarUsuario.php?user=" + $("#textoBuscador").val();
						$.get(url,function(data,status){
							$("#menuScroll2").html(data);
						});
					}
				});
			});
			
			function cargaPaginacion(pagina){
				$('#content').html('<div id="gifCargar"><img src="img/loading.gif" width="90px" height="90px"/></div>');

				var page = pagina.id;        
				var dataString = 'page=' + page;
				
				$.ajax({
					type: "GET",
					url: "gestionaComunidad.php?paginador=true",
					data: dataString,
					success: function(data){
						$('#content').fadeIn(1000).html(data);
					}
				});

			}
		</script>
	</head>
	
	<body>
	
		<?php
			if(isset($_SESSION['login'])){
				if($_SESSION['admin'] == true)
					header("Location: registroAdmin.php");
			}
			else header("Location: default.php");
		?>
		
		<div id="contenedor">
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			
			<div id="contenedorIzquierdo">
				<h2> MAS VALORADAS </h2>
				<div id="menuScroll">
					<?php
						echo cargaMasVotadasAmigos($_SESSION["user"]);
					?>
				</div>
			</div>
			
			<div id="contenidoCentral">
				<div id="tituloCentro">	
					<h1> NOVEDADES AMIGOS </h1>
						<div id="content">
							<?php
								cargaNovedades($_SESSION["user"]);
							?>
						</div>
				</div>
			</div>
			
			<div id="contenedorDerecho">
				<h2 id="tituloUsuariosP"> USUARIOS POPULARES</h2>
				<h2 id="tituloResultados"> RESULTADOS</h2>
				
				<input id= "textoBuscador" name="buscadorUsuarios" maxlength="50" type="text" placeholder="Nick usuario">
				<button type="button" id="botonBuscaUsuarios">BUSCAR</button><br><br>
				
				<div id="menuScroll2">
					<?php
						echo cargaUsuariosPopulares();
					?>
				</div>
			</div>
			
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
		</div>
	</body>
</html>

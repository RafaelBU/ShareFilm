<!DOCTYPE html>
<?php
	require_once __DIR__.'/config.php';
	require_once __DIR__.'/usuariosBD.php';

?>
<html>
  
	<head>
		<title>Editar perfil</title>
		
		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		
		<link id="estiloLogin" href="estiloLogin.css" rel="stylesheet" type="text/css" /> 
		<link rel="stylesheet" type="text/css" href="headerYpie.css" />
		<link rel="stylesheet" type="text/css" href="estiloLogin.css" />
		<link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
		<link rel="icon" href="img/logogrande.png" type="image/png">
		
	</head>
	
	<body>
		
		<div id= "contenedor">
			
			<div id="cabecera">
				<?php include("header.php"); ?>
			</div>
			
			<div id="edicion">
				<p> Edita solo los campos que quieras cambiar, el resto se mantendran intactos</p>
			</div>
			<div id = "editarPerfil">
			<?php
				$usuario= selectUser($_SESSION['user']);
				$html = "";
				$html .= "<form method='POST' action='procesarEditar.php' enctype='multipart/form-data'>
							<fieldset>
						
								<input class = 'textField' required='required' onchange='comprobarNick(this)' name='nick' maxlength='50' type='text' placeholder='nick' value='".$usuario['nick']."'><br><br>
								<input class = 'textField' required='required' name='pass' maxlength='50' type='password' placeholder='contraseña' value=''><br><br>
								<input class = 'textField' required='required' name='nombre' maxlength='50' type='text' placeholder='nombre' value='".$usuario['nombre']."'><br><br>
								<input class = 'textField' required='required' name='apellidos' maxlength='50' type='text' placeholder='apellidos' value='".$usuario['apellidos']."'><br><br>
								<input class = 'textField' required='required' name='pais' maxlength='50' type='text' placeholder='pais' value='".$usuario['pais']."'><br><br>
								<input class = 'textField' required='required' name='ciudad' maxlength='50' type='text' placeholder='ciudad' value='".$usuario['ciudad']."'><br><br>
								<input class = 'textField' required='required' name='email' maxlength='50' type='text' placeholder='email' value='".$usuario['mail']."'><br><br>
								<input class = 'textField' required='required' name='nickoriginal' maxlength='50' type='hidden' value='".$usuario['nick']."'><br><br>
								
								<p>Añadir foto<br><input type='file' name='adjunto' /></p><br>
								<input type='hidden' name='adjuntoOriginal' value='".$usuario['avatar']."'/></p><br>
							
							<input id= 'btnReg' value='EDITAR' type='submit'>

					</fieldset> 
				</form>";
				echo $html;
			?>
			</div>
			
			<div id="pie">
				<?php include("pie.html"); ?>
			</div>
		
		</div> <!-- contenedor cierre-->
	   
	</body>
	<script src="js/jquery-1.9.1.min.js"></script>
	<script>
	function comprobarNick(nick){
	var actual = "<?php echo $_SESSION['user']; ?>";
		if($(nick).val() != actual ){
			var url="comprobarUsuarioLogin.php?nickdis=" + $(nick).val();
			$.get(url,usuarioExiste);
		}
	}
	function usuarioExiste(data,status){
		
		if(data==0)
		$("#btnReg").show();
		
	else
		{
		$("#btnReg").hide();
		alert("El nick introducido no esta disponible, por favor introduce otro");
		}
}
	</script>
	 
</html>
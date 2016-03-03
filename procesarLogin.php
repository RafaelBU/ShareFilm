<?php 
		require_once __DIR__.'/config.php';
		require_once __DIR__.'/usuariosBD.php';

		$nombre = $_POST["nick"];
		$password = $_POST["pass"];
		login($nombre,$password);


	function login($nombre,$password){

		$user = selectUser($nombre);
		
		if($user == false)
		{	
			unset($_SESSION["login"]);
			header('Location: usuarioLogin.php');
		}
		else 
		{
			if(password_verify($password, $user["password"]))
			{
				$_SESSION["login"] = true;
				$_SESSION["user"] = $nombre;
				if($user['admin'] == 0){
					$_SESSION['admin'] = false;
					unset($_SESSION["carrito"]);
					header('Location: miPerfil.php');
				}
				else if($user['admin'] == 1){
					$_SESSION['admin'] = true;
					header('Location: registroAdmin.php');
				}
			}
			else
			{
				unset($_SESSION["login"]);
				header('Location: usuarioLogin.php');
			}
		
		}
	}

?>
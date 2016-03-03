<?php 
require_once __DIR__.'/config.php';
require_once __DIR__.'/usuariosBD.php';
require_once __DIR__.'/procesarLogin.php';

$nick = $_POST['nick'];
$pass = $_POST['pass'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$pais = $_POST['pais'];
$ciudad = $_POST['ciudad'];
$email = $_POST['email'];
$nickOriginal=$_POST['nickoriginal'];


if(isset($_FILES["adjunto"])){
	$avatar = $_FILES['adjunto'];
}
else $avatar = NULL;


$avatarOriginal = $_POST['adjuntoOriginal'];
	
$params["nick" ] =$nick;
$params["pass" ] =password_hash($pass, PASSWORD_BCRYPT);
$params["nombre" ] =$nombre;
$params["apellidos" ] =$apellidos;
$params["pais" ] =$pais;
$params["ciudad" ] =$ciudad;
$params["email" ] =$email;
$params["avatar"] = $avatar;
$params["avatarOriginal"] = $avatarOriginal;



updateUser($params,$nickOriginal);
login($nick,$pass);
?>
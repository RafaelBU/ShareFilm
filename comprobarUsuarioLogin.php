<?php
require_once __DIR__.'/usuariosBD.php';


$nick= $_GET['nickdis'];
$usuario=selectUser($nick);

if($usuario)
	echo 1;
else
	echo 0;

?>
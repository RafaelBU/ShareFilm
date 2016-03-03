<?php
include_once "carrito.php";
require_once __DIR__.'/config.php'; 
require_once __DIR__.'/tiendaBD.php';

actualizaCarrito($_SESSION["user"], $_SESSION["carrito"]);

session_destroy();

header('Location: default.php');
?>
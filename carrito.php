<?php
	class carrito { 
		//atributos de la clase 
		var $num_productos; 
		var $array_id_prod; 
		var $array_nombre_prod; 
		var $array_precio_prod; 
		var $array_unidades;
		var $array_imagenes;

		//constructor. Realiza las tareas de inicializar los objetos cuando se instancian 
		//inicializa el numero de productos a 0 
		function __construct() { 
		   $this->num_productos = 0; 
		   $this->array_unidades = array(); 
		} 
		
		function dameCantidad()
		{
			$elementos = 0;
			for($i = 0; $i < $this->num_productos; $i++ )
			{
				if($this->array_id_prod[$i] != -1)
				{
					$elementos++;
				}
			}
			return $elementos;

		}
		//Introduce un producto en el carrito. Recibe los datos del producto 
		//Se encarga de introducir los datos en los arrays del objeto carrito 
		//luego aumenta en 1 el numero de productos 
		function introduce_producto($id_prod, $nombre_prod, $imagen_prod, $precio_prod, $unidades_prod)
		{ 
			$this->array_id_prod[$this->num_productos]=$id_prod; 
			$this->array_nombre_prod[$this->num_productos]=$nombre_prod; 
			$this->array_precio_prod[$this->num_productos]=$precio_prod; 
			$this->array_unidades[$id_prod] = $unidades_prod;
			$this->array_imagenes[$id_prod] = $imagen_prod;
			$this->num_productos++; 
		} 
		
		function incrementaUnidades($id_prod)
		{
			$this->array_unidades[$id_prod] ++;
		}
		
		function decrementaUnidades($id_prod)
		{
			$this->array_unidades[$id_prod] --;
		}


		//elimina un producto del carrito. recibe la linea del carrito que debe eliminar 
		//no lo elimina realmente, simplemente pone a cero el id, para saber que esta en estado retirado 
		function elimina_producto($linea){ 
			$this->array_id_prod[$linea]=-1; 
		} 
	}
?>
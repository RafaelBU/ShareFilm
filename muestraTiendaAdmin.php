<?php 
	  require_once __DIR__.'/config.php'; 
	  require_once __DIR__.'/tiendaBD.php';
	
		function generaPelisTienda(){
			$html = "";
			$consulta = dameTiendaCompleta();
			
			while($tienda = $consulta->fetch_assoc()){
				
				$html .= "<option value='".$tienda['Titulo']."'>".$tienda['Titulo']."</option>";
							
			}
			return $html;
			//echo $consulta->num_rows;
			
		}
?>
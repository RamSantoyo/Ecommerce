<?php

class ControladorReportes{

	/*=============================================
	DESCARGAR REPORTE EN EXCEL
	=============================================*/

	public function ctrDescargarReporte(){

		if(isset($_GET["reporte"])){

			$tabla = $_GET["reporte"];

			$reporte = ModeloReportes::mdlDescargarReporte($tabla);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

			$nombre = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$nombre.'"');
			header("Content-Transfer-Encoding: binary");

			/*=============================================
			REPORTE DE COMPRAS Y VENTAS
			=============================================*/

			if($_GET["reporte"] == "compras"){	

				echo utf8_decode("

					<table border='0'> 

						<tr> 
						
							<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTO</td>
							<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
							<td style='font-weight:bold; border:1px solid #eee;'>VENTA</td>
							<td style='font-weight:bold; border:1px solid #eee;'>TIPO</td>
							<td style='font-weight:bold; border:1px solid #eee;'>PROCESO DE ENVÍO</td>
							<td style='font-weight:bold; border:1px solid #eee;'>MÉTODO</td>
							<td style='font-weight:bold; border:1px solid #eee;'>EMAIL</td>		
							<td style='font-weight:bold; border:1px solid #eee;'>DIRECCIÓN</td>		
							<td style='font-weight:bold; border:1px solid #eee;'>PAÍS</td	
							<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		

						</tr>");

				foreach ($reporte as $key => $value) {

					/*=============================================
					TRAER PRODUCTO
					=============================================*/
					$item = "id";
					$valor = $value["id_producto"];

					$traerProducto = ControladorProductos::ctrMostrarProductos($item, $valor);

					/*=============================================
					TRAER CLIENTE
					=============================================*/

					$item2 = "id";
					$valor2 = $value["id_usuario"];

					$traerCliente = ControladorUsuarios::ctrMostrarUsuarios($item2, $valor2);

					 echo utf8_decode("

					 	<tr>
							<td style='border:1px solid #eee;'>".$traerProducto[0]["titulo"]."</td>
							<td style='border:1px solid #eee;'>".$traerCliente["nombre"]."</td>
							<td style='border:1px solid #eee;'>$ ".number_format($value["pago"],2)."</td>
							<td style='border:1px solid #eee;'>".$traerProducto[0]["tipo"]."</td>
							<td style='border:1px solid #eee;'>

					 ");

				 	/*=============================================
					TRAER PROCESO DE ENVÍO
					=============================================*/

					if($value["envio"] == 0 && $traerProducto[0]["tipo"] == "virtual"){

						$envio = "Entrega inmediata";
					
					}else if($value["envio"] == 0 && $traerProducto[0]["tipo"] == "fisico"){

						$envio ="Despachando el producto";

					}else if($value["envio"] == 1 && $traerProducto[0]["tipo"] == "fisico"){

						$envio = "Enviando el producto";

					}else{

						$envio = "Producto entregado";

					}

					 echo utf8_decode($envio."</td>
									<td style='border:1px solid #eee;'>".$value["metodo"]."</td>
									<td style='border:1px solid #eee;'>
					 ");

				  /*=============================================
					TRAER EMAIL CLIENTE
					=============================================*/

					if($value["email"] == ""){

						$email = $traerCliente["email"];

					}else{

						$email = $value["email"];
					
					}

					echo utf8_decode($email."</td>
			 					  	 <td style='border:1px solid #eee;'>".$value["direccion"]."</td>
			 					  	 <td style='border:1px solid #eee;'>".$value["pais"]."</td>
			 					  	 <td style='border:1px solid #eee;'>".$value["fecha"]."</td>
			 					  	 </tr>"); 		

				}


				echo utf8_decode("</table>

					");

			}

			/*=============================================
			REPORTE DE VISITAS
			=============================================*/

			if($_GET["reporte"] == "visitaspersonas"){	

				echo utf8_decode("<table border='0'> 

						<tr> 
						<td style='font-weight:bold; border:1px solid #eee;'>IP</td> 
						<td style='font-weight:bold; border:1px solid #eee;'>PAÍS</td>
						<td style='font-weight:bold; border:1px solid #eee;'>VISITAS</td>
						<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>	
						</tr>");

				foreach ($reporte as $key => $value) {

					 echo utf8_decode("<tr>
				 			
				 						<td style='border:1px solid #eee;'>".$value["ip"]."</td>
				 						<td style='border:1px solid #eee;'>".$value["pais"]."</td>
				 						<td style='border:1px solid #eee;'>".$value["visitas"]."</td>
				 						<td style='border:1px solid #eee;'>".$value["fecha"]."</td>
			 					  	 
			 					  	 </tr>"); 		
							
				}
	
				echo "</table>";

			}

			/*=============================================
			REPORTE DE USUARIOS
			=============================================*/

			if($_GET["reporte"] == "usuarios"){	

				echo utf8_decode("<table border='0'> 

						<tr> 
						<td style='font-weight:bold; border:1px solid #eee;'>NOMBRE</td> 
						<td style='font-weight:bold; border:1px solid #eee;'>EMAIL</td>
						<td style='font-weight:bold; border:1px solid #eee;'>MODO</td>
						<td style='font-weight:bold; border:1px solid #eee;'>ESTADO</td>
						<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>	
						</tr>");

				foreach ($reporte as $key => $value) {

					 echo utf8_decode("<tr>
				 			
				 						<td style='border:1px solid #eee;'>".$value["nombre"]."</td>
				 						<td style='border:1px solid #eee;'>".$value["email"]."</td>
				 						<td style='border:1px solid #eee;'>".$value["modo"]."</td>
				 						<td style='border:1px solid #eee;'>");

					 /*=============================================
  					REVISAR ESTADO
  					=============================================*/

		  			if($value["modo"] == "directo"){

			  			if( $value["verificacion"] == 1){
			  				
		  					$estado = "Desactivado";			  			

			  			}else{
			  				
			  				$estado = "Activado";
			  			
			  			}		  			

			  		}else{

			  			$estado = "Activado";

			  		}

				 	echo utf8_decode($estado."</td>
				 					<td style='border:1px solid #eee;'>".$value["fecha"]."</td>
			 					  	 
			 					  </tr>"); 		

				}


			echo "</table>";

			}


		}

	}

}
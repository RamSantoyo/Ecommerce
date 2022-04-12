<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();
$ruta = $rutas[0];

$banner = ControladorProductos::ctrMostrarBanner($ruta);


if($banner != null){

	if($banner["estado"] != 0){

		echo '<figure class="banner">

				<img src="'.$servidor.$banner["img"].'" class="img-responsive" width="100%">	

			  </figure>';

	}

}

?>


<!--=====================================
BREADCRUMB OFERTAS
======================================-->
<div class="container-fluid well well-sm">
	
	<div class="container">
		
		<div class="row">
			
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>

			</ul>

		</div>

	</div>

</div>

<!--=====================================
JUMBOTRON AVISO OFERTA
======================================-->

<?php

	if(isset($rutas[1])){

		if($rutas[1] == "aviso"){

			echo '<div class="container-fluid">

					<div class="container">
	
					 	<div class="jumbotron">

					 		<button type="button" class="close cerrarOfertas" style="margin-top:-50px;"><h1>&times;</h1></button>

					 		<h1 class="text-center">¡Hola!</h1> 

					 		 <p class="text-center">
					 		 	
								Tu artículo ha sido asignado a tus compras, pero antes queremos presentarte las siguientes ofertas, si no deseas ver las ofertas y continuar en el artículo que acabas de adquirir haz click en el siguiente botón:
								<br><br>
								<a href="'.$url.'perfil">
								<button class="btn btn-default backColor btn-lg">
								VER ARTÍCULOS COMPRADOS
								</button>
								</a>
								<br><br>
								<a href="#moduloOfertas">
								<button class="btn btn-default btn-lg">
								VER OFERTAS
								</button>
								</a>

					 		 </p>
					 
					 	</div>

					</div>

				</div>';

		}

	}

?>

<div class="container-fluid">

	<div class="container">

		<div class="row" id="moduloOfertas">
			
			<?php

			$item = null;
			$valor = null;

			date_default_timezone_set('America/Mexico_City');

			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			
			$fechaActual = $fecha.' '.$hora;
			
			/*=============================================
			TRAEMOS LAS OFERTAS DE CATEGORÍAS
			=============================================*/

			$respuesta = ControladorProductos::ctrMostrarCategorias($item, $valor);

			foreach ($respuesta as $key => $value) {

				if($value["oferta"] == 1){

					if($value["finOferta"] > $fecha){

						$datetime1 = new DateTime($value["finOferta"]);
						$datetime2 = new DateTime($fechaActual);

						$interval = date_diff($datetime1, $datetime2);

						$finOferta = $interval->format('%a');

						echo '<div class="col-md-4 col-sm-6 col-xs-12">

							<div class="ofertas">
								
								<h3 class="text-center text-uppercase">

									¡OFERTA ESPECIAL PARA <br>'.$value["categoria"].'!
								
								</h3>

								<figure>

									<img class="img-responsive" src="'.$servidor.$value["imgOferta"].'" width="100%">

									<div class="sombraSuperior"></div>';

									if($value["descuentoOferta"] != 0){


										echo '<h1 class="text-center text-uppercase">%'.$value["descuentoOferta"].' OFF</h1>';
									
									}else{

										echo '<h1 class="text-center text-uppercase">$ '.$value["precioOferta"].'</h1>';

									}
			

								echo '</figure>';

								if($finOferta == 0){

									echo '<h4 class="text-center">La oferta termina hoy</h4>';

								}else if($finOferta == 1){

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' día</h4>';

								}else{

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' días</h4>';
								}

							echo '<center>
								
								<div class="countdown" finOferta="'.$value["finOferta"].'"></div>

								<a href="'.$url.$value["ruta"].'" class="pixelOferta" titulo="'.$value["categoria"].'">

								<button class="btn btniroferta btn-lg text-uppercase"><strong>Ver Ofertas</strong></button>

								</a>

							</center>
								
							</div>

						</div>';

					}

				}
				
			}


			
			/*=============================================
			TRAEMOS LAS OFERTAS DE SUBCATEGORÍAS
			=============================================*/

			$respuestaSubcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

			foreach ($respuestaSubcategorias as $key => $value) {

				if($value["oferta"] == 1 && $value["ofertadoPorCategoria"] == 0){

					if($value["finOferta"] > $fecha){

						$datetime1 = new DateTime($value["finOferta"]);
						$datetime2 = new DateTime($fechaActual);

						$interval = date_diff($datetime1, $datetime2);

						$finOferta = $interval->format('%a');

						echo '<div class="col-md-4 col-sm-6 col-xs-12">

							<div class="ofertas">
								
								<h3 class="text-center text-uppercase">

									¡OFERTA ESPECIAL EN <br>'.$value["subcategoria"].'!
								
								</h3>

								<figure>

									<img class="img-responsive" src="'.$servidor.$value["imgOferta"].'" width="100%">

									<div class="sombraSuperior"></div>';

									if($value["descuentoOferta"] != 0){


										echo '<h1 class="text-center text-uppercase">%'.$value["descuentoOferta"].' OFF</h1>';
									
									}else{

										echo '<h1 class="text-center text-uppercase">$ '.$value["precioOferta"].'</h1>';

									}
			

								echo '</figure>';

								if($finOferta == 0){

									echo '<h4 class="text-center">La oferta termina hoy</h4>';

								}else if($finOferta == 1){

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' día</h4>';

								}else{

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' días</h4>';
								}

							echo '<center>
								
								<div class="countdown" finOferta="'.$value["finOferta"].'"></div>

								<a href="'.$url.$value["ruta"].'" class="pixelOferta">

								<button class="btn btniroferta btn-lg text-uppercase"><strong>Ver Ofertas</strong></button>

								</a>

							</center>
								
							</div>

						</div>';

					}

				}
				
			}

			/*=============================================
			TRAEMOS LAS OFERTAS DE PRODUCTOS
			=============================================*/

			$ordenar = "id";

			$respuestaProductos = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);

			foreach ($respuestaProductos as $key => $value) {

			if($value["oferta"] == 1 && $value["ofertadoPorCategoria"] == 0 && $value["ofertadoPorSubCategoria"] == 0){

					if($value["finOferta"] > $fecha){

						$datetime1 = new DateTime($value["finOferta"]);
						$datetime2 = new DateTime($fechaActual);

						$interval = date_diff($datetime1, $datetime2);

						$finOferta = $interval->format('%a');

						echo '<div class="col-md-4 col-sm-6 col-xs-12">

							<div class="ofertas">
								
								<h3 class="text-center text-uppercase">

									¡OFERTA ESPECIAL EN <br>'.$value["titulo"].'!
								
								</h3>

								<figure>

									<img class="img-responsive" src="'.$servidor.$value["imgOferta"].'" width="100%">

									<div class="sombraSuperior"></div>';

									if($value["descuentoOferta"] != 0){


										echo '<h1 class="text-center text-uppercase">%'.$value["descuentoOferta"].' OFF</h1>';
									
									}else{

										echo '<h1 class="text-center text-uppercase">$ '.$value["precioOferta"].'</h1>';

									}
			

								echo '</figure>';

								if($finOferta == 0){

									echo '<h4 class="text-center">La oferta termina hoy</h4>';

								}else if($finOferta == 1){

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' día</h4>';

								}else{

									echo '<h4 class="text-center">La oferta termina en '.$finOferta.' días</h4>';
								}

							echo '<center>
								
								<div class="countdown" finOferta="'.$value["finOferta"].'"></div>

								<a href="'.$url.$value["ruta"].'" class="pixelOferta">

								<button class="btn btniroferta btn-lg text-uppercase"><strong>Ver ahora</strong></button>

								</a>

							</center>
								
							</div>

						</div>';

					}if($fechaActual > $value["finOferta"]){

						$item = "oferta";
						$valor = 0;
						$item1 = "precioOferta";
						$id = $value["id"];

						ControladorProductos::ctrCambiarOferta($id, $item, $item1, $valor);


					}

				}

			}

			?>


		</div>

	</div>

</div>


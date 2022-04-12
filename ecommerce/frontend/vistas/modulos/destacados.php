<!--=====================================
BANNER
======================================-->

<?php

$servidor = Ruta::ctrRutaServidor();

$ruta = "sin-categoria";

$banner = ControladorProductos::ctrMostrarBanner($ruta);

if($banner != null){

	if($banner["estado"] != 0){

		echo '<figure class="banner">

				<img src="'.$servidor.$banner["img"].'" class="img-responsive" width="100%">	

			  </figure>';

	}

}

/*=============================================
PRODUCTOS DESTACADOS
=============================================*/

$titulosModulos = array("ARTÍCULOS NUEVOS", "LO MÁS VENDIDO", "LO MÁS VISTO");
$rutaModulos = array("articulos-nuevos","lo-mas-vendido","lo-mas-visto");

$base = 0; 
$tope = 4;

if($titulosModulos[0] == "ARTÍCULOS NUEVOS"){

$ordenar = "id";
$item = "estado";
$valor = 1;
$modo = "DESC";

$gratis = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);	

date_default_timezone_set('America/Mexico_City');

	$fecha = date('Y-m-d');
	$hora = date('H:i:s');
				
	$fechaActual = $fecha.' '.$hora;

	foreach ($gratis as $key => $value) {

			if($fechaActual > $value["finOferta"]){

			$item = "oferta";
			$valor = 0;
			$item1 = "precioOferta";
			$id = $value["id"];

			ControladorProductos::ctrCambiarOferta($id, $item, $item1, $valor);


			}
			
}	

$ordenar = "id";
$item = "estado";
$valor = 1;
$modo = "DESC";

$gratis = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

if($titulosModulos[1] == "LO MÁS VENDIDO"){

$ordenar = "ventas";
$item = "estado";
$valor = 1;
$modo = "DESC";

$ventas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

	date_default_timezone_set('America/Mexico_City');

	$fecha = date('Y-m-d');
	$hora = date('H:i:s');
				
	$fechaActual = $fecha.' '.$hora;

	foreach ($ventas as $key => $value) {

			if($fechaActual > $value["finOferta"]){

			$item = "oferta";
			$valor = 0;
			$item1 = "precioOferta";
			$id = $value["id"];

			ControladorProductos::ctrCambiarOferta($id, $item, $item1, $valor);


			}
		
}	

$ordenar = "ventas";
$item = "estado";
$valor = 1;
$modo = "DESC";

$ventas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

if($titulosModulos[2] == "LO MÁS VISTO"){

$ordenar = "vistas";
$item = "estado";
$valor = 1;
$modo = "DESC";

$vistas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

date_default_timezone_set('America/Mexico_City');

	$fecha = date('Y-m-d');
	$hora = date('H:i:s');
				
	$fechaActual = $fecha.' '.$hora;

	foreach ($vistas as $key => $value) {

			if($fechaActual > $value["finOferta"]){

			$item = "oferta";
			$valor = 0;
			$item1 = "precioOferta";
			$id = $value["id"];

			ControladorProductos::ctrCambiarOferta($id, $item, $item1, $valor);


			}
		
}

$ordenar = "vistas";
$item = "estado";
$valor = 1;
$modo = "DESC";

$vistas = ControladorProductos::ctrMostrarProductos($ordenar, $item, $valor, $base, $tope, $modo);

}

$modulos = array($gratis, $ventas, $vistas);

for($i = 0; $i < count($titulosModulos); $i ++){

	echo '<div class="container-fluid well well-sm barraProductos">

			<div class="container">
				
				<div class="row">
					
					<div class="col-xs-12 organizarProductos">

						<div class="btn-group pull-right">

							 <button type="button" class="btn btn-default btnGrid" id="btnGrid'.$i.'">
							 	
								<i class="fa fa-th" aria-hidden="true"></i>  

								<span class="col-xs-0 pull-right"> CUADRICULA</span>

							 </button>

							 <button type="button" class="btn btn-default btnList" id="btnList'.$i.'">
							 	
								<i class="fa fa-list" aria-hidden="true"></i> 

								<span class="col-xs-0 pull-right"> LISTA</span>

							 </button>
							
						</div>		

					</div>

				</div>

			</div>

		</div>


		<div class="container-fluid productos">
	
			<div class="container">
		
				<div class="row">

					<div class="col-xs-12 tituloDestacado">

						<div class="col-sm-6 col-xs-12">
					
							<h1><small>'.$titulosModulos[$i].' </small></h1>

						</div>

						<div class="col-sm-6 col-xs-12">
					
							<a href="'.$rutaModulos[$i].' ">
								
								<button class="btn btn-default backColor pull-right">
									
									VER MÁS <span class="fa fa-chevron-right"></span>

								</button>

							</a>

						</div>

					</div>

					<div class="clearfix"></div>

					<hr>

				</div>

				<ul class="grid'.$i.'">';

				foreach ($modulos[$i] as $key => $value) {

					if($value["estado"] != 0){
					
					echo '<li class="col-md-3 col-sm-6 col-xs-12">

							<figure>
								
								<a href="'.$value["ruta"].'" class="pixelProducto">
									
									<img src="'.$servidor.$value["portada"].'" class="img-responsive">

								</a>

							</figure>

							<h4>
					
								<small>
									
									<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["titulo"].'<br>

										<span style="color:rgba(0,0,0,0)">-</span>';

										if($value["nuevo"] != 0){

											echo '<span class="label label-warning fontSize">Nuevo</span> ';

										}

										if($value["oferta"] != 0){

											echo '<span class="label label-warning fontSize">'.$value["descuentoOferta"].'% off</span>';

										}

									echo '</a>	

								</small>			

							</h4>

							<div class="col-xs-6 precio">';

							if($value["precio"] == 0){

								echo '<h2><small>GRATIS</small></h2>';

							}else{

								if($value["oferta"] != 0){

									echo '<h3>

											<small>
						
												<strong class="oferta">MX $'.$value["precio"].'</strong>

											</small>

											<small><strong>$'.$value["precioOferta"].'</strong></small>
										
										</h3>';

								}else{

									echo '<h3><small><strong>MX $'.$value["precio"].'</strong></small></h3>';

								}
								
							}
											
							echo '</div>

							<div class="col-xs-6 enlaces">
								
								<div class="btn-group pull-right">
									
									<button type="button" class="btn btn-default btn-xs deseos" idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">
										
										<i class="fa fa-heart" aria-hidden="true"></i>

									</button>';

									if($value["tipo"] == "virtual" && $value["precio"] != 0){

										if($value["oferta"] != 0){

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}else{

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}

									}

									echo '<a href="'.$value["ruta"].'" class="pixelProducto">
									
										<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">
											
											<i class="fa fa-eye" aria-hidden="true"></i>

										</button>	
									
									</a>

								</div>

							</div>

						</li>';

					}	
				}

				echo '</ul>

				<ul class="list'.$i.'" style="display:none">';

				foreach ($modulos[$i] as $key => $value) {

					if($value["estado"] != 0){

					echo '<li class="col-xs-12">
					  
				  		<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							   
							<figure>
						
								<a href="'.$value["ruta"].'" class="pixelProducto">
									
									<img src="'.$servidor.$value["portada"].'" class="img-responsive">

								</a>

							</figure>

					  	</div>
							  
						<div class="col-lg-10 col-md-7 col-sm-8 col-xs-12">
							
							<h1>

								<small>

									<a href="'.$value["ruta"].'" class="pixelProducto">

										<a href="'.$value["ruta"].'" class="pixelProducto">
										
										'.$value["titulo"].'<br>';

										if($value["nuevo"] != 0){

											echo '<span class="label label-warning">Nuevo</span> ';

										}

										if($value["oferta"] != 0){

											echo '<span class="label label-warning">'.$value["descuentoOferta"].'% off</span>';

										}		

									echo '</a>

								</small>

							</h1>

							<p class="text-muted">'.$value["titular"].'</p>';

							if($value["precio"] == 0){

								echo '<h2><small>GRATIS</small></h2>';

							}else{

								if($value["oferta"] != 0){

									echo '<h2>

											<small>
						
												<strong class="oferta">MX $'.$value["precio"].'</strong>

											</small>

											<small>$'.$value["precioOferta"].'</small>
										
										</h2>';

								}else{

									echo '<h2><small>MX $'.$value["precio"].'</small></h2>';

								}
								
							}

							echo '<div class="btn-group pull-left enlaces">
						  	
						  		<button type="button" class="btn btn-default btn-xs deseos"  idProducto="'.$value["id"].'" data-toggle="tooltip" title="Agregar a mi lista de deseos">

						  			<i class="fa fa-heart" aria-hidden="true"></i>

						  		</button>';

						  		if($value["tipo"] == "virtual" && $value["precio"] != 0){

										if($value["oferta"] != 0){

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precioOferta"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}else{

											echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value["id"].'" imagen="'.$servidor.$value["portada"].'" titulo="'.$value["titulo"].'" precio="'.$value["precio"].'" tipo="'.$value["tipo"].'" peso="'.$value["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

											<i class="fa fa-shopping-cart" aria-hidden="true"></i>

											</button>';

										}

									}

						  		echo '<a href="'.$value["ruta"].'" class="pixelProducto">

							  		<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">

							  		<i class="fa fa-eye" aria-hidden="true"></i>

							  		</button>

						  		</a>
							
							</div>

						</div>

						<div class="col-xs-12"><hr></div>

					</li>';

				}	

				}

				echo '</ul>

			</div>

		</div>';

}

?>


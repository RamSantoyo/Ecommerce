

<?php
    
    $url = Ruta::ctrRuta();

 ?>


<!--=====================================
BREADCRUMB CARRITO DE COMPRAS
======================================-->

<div class="container-fluid well well-sm">
	
	<div class="container">
		
		<div class="row">
			
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">CARRITO DE COMPRAS</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>

			</ul>

		</div>

	</div>

</div>

<!--=====================================
TABLA CARRITO DE COMPRAS
======================================-->

<div class="container-fluid">

	<div class="container">

		<div class="panel panel-default">
			
			<!--=====================================
			CABECERA CARRITO DE COMPRAS
			======================================-->

			<div class="panel-heading cabeceraCarrito">
				
				<div class="col-md-6 col-sm-7 col-xs-12 text-center">
					
					<h3>
						<small>PRODUCTO</small>
					</h3>

				</div>

				<div class="col-md-2 col-sm-1 col-xs-0 text-center">
					
					<h3>
						<small>PRECIO</small>
					</h3>

				</div>

				<div class="col-sm-2 col-xs-0 text-center">
					
					<h3>
						<small>CANTIDAD</small>
					</h3>

				</div>

				<div class="col-sm-2 col-xs-0 text-center">
					
					<h3>
						<small>SUBTOTAL</small>
					</h3>

				</div>

			</div>

			<!--=====================================
			CUERPO CARRITO DE COMPRAS
			======================================-->

			<div class="panel-body cuerpoCarrito">



			</div>

			<!--=====================================
			SUMA DEL TOTAL DE PRODUCTOS
			======================================-->

			<div class="panel-body sumaCarrito">

				<div class="col-md-4 col-sm-6 col-xs-12 pull-right well">
					
					<div class="col-xs-6">
						
						<h4>TOTAL:</h4>

					</div>

					<div class="col-xs-6">

						<h4 class="sumaSubTotal">
							
							<strong>MXN $<span></span></strong>

						</h4>

					</div> 

				</div>

			</div>

			<!--=====================================
			BOTÓN CHECKOUT
			======================================-->

			<div class="panel-heading cabeceraCheckout">
				
				<?php

				if(isset($_SESSION["validarSesion"])){

					if($_SESSION["validarSesion"] == "ok"){

						echo '<a id="btnCheckout" href="#modalCheckout" data-toggle="modal" idUsuario="'.$_SESSION["id"].'">
						<button class="btn btn-light pagobtn btn-lg pull-right"><i class="fa fa-credit-card-alt" aria-hidden="true"></i><strong> REALIZAR PAGO</strong></button></a>';

					}


				}else{

					echo '<a href="#modalIngreso" data-toggle="modal"><button class="btn btn-light pagobtn btn-lg pull-right">
					<i class="fa fa-credit-card-alt" aria-hidden="true"></i>
					<strong> REALIZAR PAGO</strong></button></a>';
				}

			?>	

			</div>

		</div>

	</div>

</div>


<!--=====================================
VENTANA MODAL PARA CHECKOUT

modal-lg 
======================================-->

<div id="modalCheckout" class="modal fade modalFormulario" role="dialog">

	<div class="modal-content modal-dialog"> 

		<div class="modal-body modalTitulo">

			<h2 class="">	
				<strong>¡Pronto sera tuyo!</strong>	
			</h2>


			<button type="button" class="close" data-dismiss="modal" style="color:black;">&times;</button>

				<div class="contenidoCheckout">


				<?php

				$respuesta = ControladorCarrito::ctrMostrarTarifas();

				echo '<input type="hidden" id="tasaImpuesto" value="'.$respuesta["impuesto"].'">
					  <input type="hidden" id="envioNacional" value="'.$respuesta["envioNacional"].'">
				      <input type="hidden" id="envioInternacional" value="'.$respuesta["envioInternacional"].'">
				      <input type="hidden" id="tasaMinimaNal" value="'.$respuesta["tasaMinimaNal"].'">
				      <input type="hidden" id="tasaMinimaInt" value="'.$respuesta["tasaMinimaInt"].'">
				      <input type="hidden" id="tasaPais" value="'.$respuesta["pais"].'">

				';

				?>

						<div class="formEnvio row">
							
							<h4 class="text-center well text-muted text-uppercase">
								<i class="fa fa-home" aria-hidden="true"></i>
								<i class="fa fa-long-arrow-left" aria-hidden="true"></i>
								<i class="fa fa-truck" aria-hidden="true"></i>

								Lugar de envío
							
							</h4>

							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 seleccionePais">
					

						        
								
							</div>

							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 numero">
					

						        
								
							</div>

							<div class="col-xs-12 informes">
					

						        
								
							</div>

						</div>

						<br>

						<div class="formaPago row">
						
							<h4 class="text-center well text-muted text-uppercase">!Paga de forma segura¡
							<i class="fa fa-heart" aria-hidden="true"></i>	
							</h4>

							<figure class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<center>
									
									<input id="checkPaypal" class="radiobtn" type="radio" name="pago" value="paypal" checked>

								</center>	
								
								<center>

								<img src="<?php echo $url; ?>vistas/img/plantilla/paypal.png" class="img-thumbnail pay">

								</center>		

							</figure>							

					</div>

					<br>

						<div class="listaProductos row">
						
						<h4 class="text-center well text-muted text-uppercase">Productos</h4>

						<table class="table table-striped tablaProductos">
							
							 <thead>
							 	
								<tr>		
									<th>Producto</th>
									<th>Cantidad</th>
									<th>Precio</th>
								</tr>

							 </thead>

							 <tbody>
							 	


							 </tbody>

						</table>

						<div class="col-sm-6 col-xs-12 pull-right">
							
							<table class="table table-striped tablaTasas">
								
								<tbody>
									
									<tr>
										<td>Subtotal</td>	
										<td><span class="cambioDivisa">MXN</span> $<span class="valorSubtotal" valor="0">0</span></td>	
									</tr>

									<tr>
										<td>Envío</td>	
										<td><span class="cambioDivisa">MXN</span> $<span class="valorTotalEnvio" valor="0">0</span></td>	
									</tr>

									<tr style="display: none;">
										<td>Impuesto</td>	
										<td><span class="cambioDivisa">MXN</span> $<span class="valorTotalImpuesto" valor="0">0</span></td>	
									</tr>

									<tr>
										<td>IVA</td>	
										<td><span class="ISR"></span><span>Incluido</span></td>	
									</tr>

									<tr>
										<td><strong>Total</strong></td>	
										<td><strong><span class="cambioDivisa">MXN</span> $<span class="valorTotalCompra" valor="0">0</span></strong></td>	
									</tr>

								</tbody>	

							</table>

							 <div class="divisa">

							 	<select class="form-control divisacambio" align='right' id="cambiarDivisa" name="divisa">

							 		
							 	</select>
								
								<!--=====================================

							 	/<i class="fa fa-usd" aria-hidden="true"></i> Seleccionar Divisa

							 	======================================-->	

							 	<br>

							 </div>

					     <br>

						</div>

						<div class="clearfix"></div>

		
						<button class="btn btn-block btn-lg btn btn-success btnPagar">PAGAR</button>

					</div>

			</div>

		</div>

		<div class="modal-footer">
      	
      	</div>

	</div>

</div>
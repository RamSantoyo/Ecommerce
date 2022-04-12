<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

/*=============================================
INICIO DE SESIÓN USUARIO
=============================================*/

if(isset($_SESSION["validarSesion"])){

	if($_SESSION["validarSesion"] == "ok"){

	  echo '<script>
		
			localStorage.setItem("usuario","'.$_SESSION["id"].'");

			</script>';

	}

}



/*=============================================
CREAR EL OBJETO DE LA API GOOGLE
=============================================*/

$cliente = new Google_Client();
$cliente->setAuthConfig('modelos/client_secret.json');
$cliente->setAccessType("offline");
$cliente->setScopes(['profile','email']);

/*=============================================
RUTA PARA EL LOGIN DE GOOGLE
=============================================*/

$rutaGoogle = $cliente->createAuthUrl();

/*=============================================
RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE
=============================================*/

if(isset($_GET["code"])){

	$token = $cliente->authenticate($_GET["code"]);

	$_SESSION['id_token_google'] = $token;

	$cliente->setAccessToken($token);

}

/*=============================================
RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
=============================================*/

if($cliente->getAccessToken()){

 	$item = $cliente->verifyIdToken();

 	$datos = array("nombre"=>$item["name"],
				   "email"=>$item["email"],
				   "foto"=>$item["picture"],
				   "password"=>"null",
				   "modo"=>"google",
				   "verificacion"=>0,
				   "emailEncriptado"=>"null");

 	$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

 	echo '<script>
		
	setTimeout(function(){

		window.location = localStorage.getItem("rutaActual");

	},1000);

 	</script>';

 	

}

?>


<!--=====================================
TOP
======================================-->

<div class="container-fluid barraSuperior" id="top">
	
	<div class="container">
		
		<div class="row">
	
			<!--=====================================
			SOCIAL
			======================================-->

			<div class="col-lg-6 col-md-7 col-sm-5 col-xs-12 social">
				
				<ul>	

					<?php

					$social = ControladorPlantilla::ctrEstiloPlantilla();

                    $jsonRedesSociales = json_decode($social["redesSociales"],true);
                    
                    foreach ($jsonRedesSociales as $key => $value) {

                    	if($value["activo"] != 0){

	                       echo '<li>
							<a href="'.$value["url"].'" target="_blank">
								<i class="fa '.$value["red"].' redSocial '.$value["estilo"].'" aria-hidden="true"></i>
							</a>
							</li>';

						}
                    } 

					?>

					<a href=""><img src="http://localhost/frontend/vistas/img/plantilla/envios.png" id="img1"></a>
													
				</ul>

			</div>
 
			<!--=====================================
			REGISTRO
			======================================-->

			<div class="col-lg-6 col-md-5 col-sm-7 col-xs-12 registro">
				
				<ul style="padding-left:20px:">


					<?php

				if(isset($_SESSION["validarSesion"])){

					if($_SESSION["validarSesion"] == "ok"){

						if($_SESSION["modo"] == "directo"){

							if($_SESSION["foto"] != ""){

								echo '<li>

										<img class="img-circle" src="'.$url.$_SESSION["foto"].'" width="6%">
										<a class="nombre">'.$_SESSION["nombre"].'</a>

									 </li>';

							}else{

								echo '<li>

									<img class="img-circle imagen" src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" width="6%"><a class="nombre"> '.$_SESSION["nombre"].'</a>

								</li>';

							}

							echo '<li>|</li>
							 <li><a href="'.$url.'perfil">Ver Perfil</a></li>
							 <li>|</li>
							 <li><a href="'.$url.'salir">Salir <i class="fa fa-sign-out"></a></i></li>';


						}

						if($_SESSION["modo"] == "facebook"){

							echo '<li>

									<img class="img-circle imagen" src="'.$_SESSION["foto"].'" width="6%">
									<a class="nombre">'.$_SESSION["nombre"].'</a>

								   </li>
								   <li>|</li>
						 		   <li><a href="'.$url.'perfil">Ver Perfil</a></li>
						 		   <li>|</li>
						 		   <li><a href="'.$url.'salir" class="salir">Salir <i class="fa fa-sign-out"></a></i></li>';

						}

						if($_SESSION["modo"] == "google"){

							echo '<li>

									<img class="img-circle imagen" src="'.$_SESSION["foto"].'" width="6%">
									<a class="nombre">'.$_SESSION["nombre"].'</a>

								   </li>
								   <li>|</li>
						 		   <li><a href="'.$url.'perfil">Ver Perfil</a></li>
						 		   <li>|</li>
						 		   <li><a href="'.$url.'salir">Salir <i class="fa fa-sign-out"></a></i></li>';

						}

					}

				}else{
					
					echo'<li><a href="#modalIngreso" data-toggle="modal"><i class="fa fa-sign-in"><FONT SIZE=2> Ingresar</font></i></a>
					</li>
					<li>|</li>
					<li><a href="#modalRegistro" data-toggle="modal"><i class="fa fa-user-plus"><FONT SIZE=2> Crear una cuenta</font></a></li></i>';	

					}
					
					?>	
				</ul>

			</div>	

		</div>	

	</div>

</div>

<!--=====================================
HEADER
======================================-->

<header class="container-fluid">
	
	<div class="container">
		
		<div class="row" id="cabezote">

			<!--=====================================
			LOGOTIPO
			======================================-->
			
			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
				
				<a href="<?php echo $url;  ?>">
						
					<img src="<?php echo $servidor.$social["logo"]; ?>" class="img-responsive">

				</a>
				
			</div>

			<!--=====================================
			BLOQUE CATEGORÍAS Y BUSCADOR
			======================================-->

			<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
					
				<!--=====================================
				BOTÓN CATEGORÍAS
				======================================-->

				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 categoria" id="btnCategorias">
					
					<p style="cursor:pointer;">CATEGORÍAS 
					
						<span class="pull-right">
							<i class="fa fa-bars" style="color:#FFCD00;"></i>
						</span>
					
					</p>

				</div>

				<!--=====================================
				BUSCADOR
				======================================-->
				
				<div class="input-group col-lg-8 col-md-8 col-sm-8 col-xs-12" id="buscador">
					
					<input type="search" name="buscar" class="form-control" placeholder="Buscar...">	

					<span class="input-group-btn">
						
						<a href="<?php echo $url; ?>buscador/1/recientes">

							<button class="btn btn-default busca" type="submit">
								
								<i class="fa fa-search"></i>

							</button>

						</a>

					</span>

				</div>
			
			</div>

			<!--=====================================
			CARRITO DE COMPRAS
			======================================-->

			<div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="carrito">

				<a href="<?php echo $url;?>ofertas">

					<button class="btn btn-link pull-left btnoferton"> 
						
						<i class="fa fa-tags fa-2x oferton" aria-hidden="true"></i>

						<div class="textomobil" style="margin-left:70px;">ofertas</div>

						<strong><div class="texto-encima"style="margin-left: -15px;">¡Ofertas!</strong>
					
					</button>
				
				</a>


				<a href="<?php echo $url;?>carrito-de-compras">

					<button class="btn btn-link pull-left"> 
						
						<i class="fa fa-shopping-cart fa-2x cesta" aria-hidden="true"></i>
					
					</button>				 

					<strong><p style="font-size:14px;">Tu carrito lleva: <span class="cantidadCesta"></span></strong>
					<!--===================================== 
					<br><span class="sumaCesta"></span></p></strong>
					======================================-->
				</a>			

			</div>

		</div>

		<!--=====================================
		CATEGORÍAS
		======================================-->

		<div class="col-xs-12 backColor" id="categorias">
			
          <?php 

          		$item = null;
          		$valor =null;
          
                $categorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

                foreach ($categorias as $key => $value) {

                	if($value["estado"] != 0){

                   echo '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12">
							
							<h4>
								<a href="'.$url.$value["ruta"].'" class="pixelCategorias" titulo="'.$value["categoria"].'">'.$value["categoria"].'</a>
							</h4>
							
							<hr>

							<ul>';
							 /*<!--=====================================
								SUBCATEGORÍAS
							  ======================================-->*/

		  					$item = "id_categoria";

		  					$valor = $value["id"];
								
                              $subcategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

                              
                              foreach ($subcategorias as $key => $value) {

                              	echo '<li><a href="'.$url.$value["ruta"].'" class="pixelSubCategorias" titulo="'.$value["subcategoria"].'">'.$value["subcategoria"].'</a></li>';
                              }

							echo '</ul> </div>';

					}		
                }

          ?>	

		</div>

	</div>

</header>

<!--=====================================
			VENTANA DE REGISTRO
======================================-->
  
 <div class="modal fade modalFormulario" id="modalRegistro" role="dialog">

    <div class="modal-content modal-dialog" id="contenedor">

		 <!-- Modal TITULO -->
        <div class="modal-body modalTitulo">

        	<h3 class="ventanasmodal">Registrate</h3>

           <button type="button" class="close" data-dismiss="modal">&times;</button>

           <!--=====================================
			REGISTRO FACEBOOK
			======================================-->

				<div class="col-sm-6 col-xs-12 facebook">
					
					<p>
					  <i  class="fa fa-facebook" aria-hidden="true"></i>
					<small>&nbsp;| Con Facebook</small>
					</p>

				</div>

			<!--=====================================
			REGISTRO GOOGLE
			======================================-->
			<a href="<?php echo $rutaGoogle; ?>">

				<div class="col-sm-6 col-xs-12 google">
					
					<p>
					<img style="margin-left: -5px; margin-right:5px;" src="http://localhost/frontend/vistas/img/plantilla/google.png" width="8%">
					| Con Google
					</p>

				</div>

			</a>
			<!--=====================================
			REGISTRO DIRECTO  FORMULARIO
			======================================-->
			<form method="post" onsubmit="return registroUsuario()">
				
			<hr>
			
			<!--=====================================
			FORMULARIO USUARIO
			======================================-->

					<div class="form-group">
						
						<div class="input-group">
							
							<span class="input-group-addon">
								
								<i class="fa fa-user"></i>
							
							</span>

							<input type="text" class="form-control" id="regUsuario" name="regUsuario" placeholder="Nombre Completo" required>

						</div>

					</div>


			<!--=====================================
			FORMULARIO CORREO
			======================================-->	

					<div class="form-group">
					
						<div class="input-group">
							
							<span class="input-group-addon">
								
								<i class="fa fa-envelope"></i>
							
							</span>

							<input type="email" class="form-control" id="regEmail" name="regEmail" placeholder="Correo Electrónico" required>

						</div>

				    </div>

			<!--=====================================
			FORMULARIO PASSWORD
			======================================-->

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-lock"></i>
						
						</span>

						<input type="password" class="form-control" id="regPassword" name="regPassword" placeholder="Contraseña" required>

					</div>

				</div>



				    <div class="checkBox">
					
						<label>
							
							<input id="regPoliticas" type="checkbox">
						
								<small>
									
									He leído y acepto el aviso legal y la política de privacidad.

									<br>

									<a href="https://www.iubenda.com/privacy-policy/10505790" class="iubenda-white iubenda-embed">Leer más...
									</a>
									  <script type="text/javascript">(function (w,d) {var loader = function () 
									  {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0];
									  s.src = "//cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);};
									  if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent)
									  {w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);
									  </script>

								</small>

						</label>

					</div>

					<?php

					$registro = new ControladorUsuarios();
					$registro -> ctrRegistroUsuario();

					?>


					<center><input type="submit" class="btn btn-default" value="Crear cuenta" id="Envio"></center>	


			</form>

       </div>


	    <div class="modal-footer">

	          ¿Ya tienes una cuenta registrada? | <strong><a href="#modalIngreso" data-dismiss="modal" data-toggle="modal">Ingresar</a></strong>   
	    
	    </div>

   </div>
   
</div>

<!--=====================================
VENTANA MODAL PARA EL INGRESO
======================================-->

<div class="modal fade modalFormulario" id="modalIngreso" role="dialog">

    <div class="modal-content modal-dialog modal-sm" id="contenedor">

        <div class="modal-body modalTitulo">

        	<h3 class="ventanasmodal">Ingresar</h3>

           <button type="button" class="close" data-dismiss="modal">&times;</button>
        	
			<!--=====================================
			INGRESO FACEBOOK
			======================================-->

			<div class="col-sm-12 col-xs-12 facebook">
				
				<p>
				  <i class="fa fa-facebook"></i>
					<small>&nbsp;| Continuar con Facebook</small>
				</p>

			</div>

			<!--=====================================
			INGRESO GOOGLE
			======================================-->
			<a href="<?php echo $rutaGoogle; ?>">
			
				<div class="col-sm-12 col-xs-12 google">
					
					<p>
					  <img style="margin-left: -5px; margin-right:5px;" src="http://localhost/frontend/vistas/img/plantilla/google.png" width="7%">
						| Continuar con Google
					</p>

				</div>

			</a>

			<br>

			<!--=====================================
			INGRESO DIRECTO
			======================================-->

			<form method="post">
				
			<hr>

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="fa fa-envelope"></i>
						
						</span>

						<input type="email" class="form-control" id="ingEmail" name="ingEmail" placeholder="Correo Electrónico" required>

					</div>

				</div>

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-lock"></i>
						
						</span>

						<input type="password" class="form-control" id="ingPassword" name="ingPassword" placeholder="Contraseña" required>

					</div>

				</div>
				
				<?php
					
					$ingreso = new ControladorUsuarios();
					$ingreso -> ctrIngresoUsuario();
					
				?>
				

				<center><input type="submit" class="btn btn-default btnIngreso" value="Ingresar" id="Envio"></center>	

				<br>

				<center>
					
					<a href="#modalPassword" data-dismiss="modal" data-toggle="modal">¿Olvidaste tu contraseña?</a>

				</center>

			</form>

        </div>

        <div class="modal-footer">
          
			¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>

        </div>
      
    </div>

</div>


<!--=====================================
VENTANA MODAL PARA OLVIDO DE CONTRASEÑA
======================================-->

<div class="modal fade modalFormulario" id="modalPassword" role="dialog">

    <div class="modal-content modal-dialog">

        <div class="modal-body modalTitulo">

        	<h3 class="backColor">Solicitud de Nueva Contraseña</h3>

           <button type="button" class="close" data-dismiss="modal">&times;</button>
        	
			<!--=====================================
			OLVIDO CONTRASEÑA
			======================================-->

			<form method="post">

				<label class="text-muted">Escribe el correo electrónico con el que estás registrado y ahí te enviaremos una nueva contraseña:</label>

				<div class="form-group">
					
					<div class="input-group">
						
						<span class="input-group-addon">
							
							<i class="glyphicon glyphicon-envelope"></i>
						
						</span>
					
						<input type="email" class="form-control" id="passEmail" name="passEmail" placeholder="Correo Electrónico" required>

					</div>

				</div>			
				
				<?php
					
					$password = new ControladorUsuarios();
					$password -> ctrOlvidoPassword();
					
				?>
				
				<center>

				<input type="submit" class="btn btn-default btn-block" value="ENVIAR" id="Envio">	
				
				</center>

			</form>

        </div>

        <div class="modal-footer">
          
			¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>

        </div>
      
    </div>

</div>

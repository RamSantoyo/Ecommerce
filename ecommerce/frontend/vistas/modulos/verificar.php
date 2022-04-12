<!--=====================================
VERIFICAR
======================================-->

<?php

	$usuarioVerificado = false;
	
	$item = "EmailEncriptado";
	$valor =  $rutas[1];

	$respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

	if($valor == $respuesta["emailEncriptado"]){

		$id = $respuesta["id"];
		$item2 = "verificacion";
		$valor2 = 0;

		$respuesta2 = ControladorUsuarios::ctrActualizarUsuario($id, $item2, $valor2);

		if($respuesta2 == "ok"){

			$usuarioVerificado = true;

		}

	}
		

?>

<div class="container">
	
	<div class="row">
	 
		<div class="col-xs-12 text-center verificar">
			
			<?php

				if($usuarioVerificado){

					echo '<h3>Gracias</h3>
						<h2><small>¡Hemos verificado su correo electrónico, ya puedes seguir disfrutando!</small></h2>

						<br>

						<a href="#modalIngreso" data-toggle="modal"><button class="btn btn-default btn-lg" style="background:#FFCD00;">INGRESAR</button></a>';
				

				}else{

					echo '<h3>Error</h3>

					<h2><small>¡No se ha podido verificar el correo electrónico,  vuelva a registrarse!</small></h2>

					<br>

					<a href="#modalRegistro" data-toggle="modal"><button class="btn btn-default btn-lg" style="background:#FFCD00;">REGISTRO</button></a>';


				}

			?>

		</div>

	</div>

</div>


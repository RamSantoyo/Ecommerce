<?php

class ControladorBanner{

	/*=============================================
	MOSTRAR BANNER
	=============================================*/

	static public function ctrMostrarBanner($item, $valor){

		$tabla = "banner";

		$respuesta = ModeloBanner::mdlMostrarBanner($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR BANNER
	=============================================*/

	static public function ctrCrearBanner(){

		if(isset($_POST["tipoBanner"])){

			/*=============================================
			VALIDAR IMAGEN BANNER
			=============================================*/

			$rutaBanner = "";

			if(isset($_FILES["fotoBanner"]["tmp_name"]) && !empty($_FILES["fotoBanner"]["tmp_name"])){

				/*=============================================
				DEFINIMOS LAS MEDIDAS
				=============================================*/

				list($ancho, $alto) = getimagesize($_FILES["fotoBanner"]["tmp_name"]);

				$nuevoAncho = 1600;
				$nuevoAlto = 550;

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/	

				if($_FILES["fotoBanner"]["type"] == "image/jpeg"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/

					$rutaBanner = "vistas/img/banner/".$_FILES["fotoBanner"]["name"].".jpg";

					$origen = imagecreatefromjpeg($_FILES["fotoBanner"]["tmp_name"]);	

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $rutaBanner);

				}

				if($_FILES["fotoBanner"]["type"] == "image/png"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/

					$rutaBanner = "vistas/img/banner/".$_FILES["fotoBanner"]["name"].".png";

					$origen = imagecreatefrompng($_FILES["fotoBanner"]["tmp_name"]);						

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, FALSE);
			
					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $rutaBanner);

				}

			}

			if(isset($_POST["rutaBanner"]) && !empty($_POST["rutaBanner"])){

				$ruta = $_POST["rutaBanner"];

			}else{

				$ruta = "sin-categoria";

			}

			$datos = array("img"=>$rutaBanner,
						   "estado"=>1,
						   "tipo"=>$_POST["tipoBanner"],
						   "ruta"=>$ruta);

			$respuesta = ModeloBanner::mdlIngresarBanner("banner", $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Banner ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {

						window.location = "banner";

						}
					})

				</script>';

			}

		}

	}


	/*=============================================
	EDITAR BANNER
	=============================================*/

	static public function ctrEditarBanner(){

		if(isset($_POST["editarTipoBanner"])){

			/*=============================================
			VALIDAR IMAGEN BANNER
			=============================================*/

			$rutaBanner = $_POST["antiguaFotoBanner"];

			if(isset($_FILES["fotoBanner"]["tmp_name"]) && !empty($_FILES["fotoBanner"]["tmp_name"])){

				/*=============================================
				BORRAMOS ANTIGUA FOTO PORTADA
				=============================================*/

				unlink($_POST["antiguaFotoBanner"]);


				/*=============================================
				DEFINIMOS LAS MEDIDAS
				=============================================*/

				list($ancho, $alto) = getimagesize($_FILES["fotoBanner"]["tmp_name"]);

				$nuevoAncho = 1600;
				$nuevoAlto = 550;

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/	

				if($_FILES["fotoBanner"]["type"] == "image/jpeg"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/

					$rutaBanner = "vistas/img/banner/".$_POST["rutaBanner"].".jpg";

					$origen = imagecreatefromjpeg($_FILES["fotoBanner"]["tmp_name"]);	

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $rutaBanner);

				}

				if($_FILES["fotoBanner"]["type"] == "image/png"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/

					$rutaBanner = "vistas/img/banner/".$_POST["rutaBanner"].".png";

					$origen = imagecreatefrompng($_FILES["fotoBanner"]["tmp_name"]);						

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, FALSE);
			
					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $rutaBanner);

				}

			}

			$datos = array("id"=>$_POST["idBanner"],
						   "img"=>$rutaBanner,
						   "tipo"=>$_POST["editarTipoBanner"],
						   "ruta"=>$_POST["rutaBanner"]);

			$respuesta = ModeloBanner::mdlEditarBanner("banner", $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Banner ha sido editado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {

						window.location = "banner";

						}
					})

				</script>';

			}


		}

	}

	/*=============================================
	ELIMINAR BANNER
	=============================================*/

	static public function ctrEliminarBanner(){

		if(isset($_GET["idBanner"])){

			/*=============================================
			ELIMINAR IMAGEN BANNER
			=============================================*/

			if($_GET["imgBanner"] != ""){

				unlink($_GET["imgBanner"]);		

			}

			$respuesta = ModeloBanner::mdlEliminarBanner("banner", $_GET["idBanner"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El banner ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "banner";

								}
							})

				</script>';

			}		


		}

	}



}
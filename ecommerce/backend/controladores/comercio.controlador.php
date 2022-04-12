<?php

class ControladorComercio{

	/*=============================================
	SELECCIONAR PLANTILLA
	=============================================*/

	static public function ctrSeleccionarPlantilla(){

		$tabla = "plantilla";

		$respuesta = ModeloComercio::mdlSeleccionarPlantilla($tabla);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR LOGO O ICONO
	=============================================*/

	static public function ctrActualizarLogoIcono($item, $valor){

		$tabla = "plantilla";
		$id = 1;

		$plantilla = ModeloComercio::mdlSeleccionarPlantilla($tabla);

		/*=============================================
		CAMBIANDO LOGOTIPO O ICONO
		=============================================*/	

		$valorNuevo = $valor;

		if(isset($valor["tmp_name"])){

			list($ancho, $alto) = getimagesize($valor["tmp_name"]);

			/*=============================================
			CAMBIANDO LOGOTIPO
			=============================================*/	

			if($item == "logo"){

				unlink("../".$plantilla["logo"]);

				$nuevoAncho = 500;
				$nuevoAlto = 100;

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				if($valor["type"] == "image/jpeg"){

					$ruta = "../vistas/img/plantilla/logo.jpg";

					$origen = imagecreatefromjpeg($valor["tmp_name"]);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);

				}

				if($valor["type"] == "image/png"){

					$ruta = "../vistas/img/plantilla/logo.png";

					$origen = imagecreatefrompng($valor["tmp_name"]);

					imagealphablending($destino, FALSE);

					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);

				}

			}

			/*=============================================
			CAMBIANDO ICONO
			=============================================*/	

			if($item == "icono"){

				unlink("../".$plantilla["icono"]);

				$nuevoAncho = 100;
				$nuevoAlto = 100;

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				if($valor["type"] == "image/jpeg"){

					$ruta = "../vistas/img/plantilla/icono.jpg";

					$origen = imagecreatefromjpeg($valor["tmp_name"]);					

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);
			
				}

				if($valor["type"] == "image/png"){

					$ruta = "../vistas/img/plantilla/icono.png";

					$origen = imagecreatefrompng($valor["tmp_name"]);

					imagealphablending($destino, FALSE);
        			
        			imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);
			
				}

			}

			$valorNuevo = substr($ruta, 3);

		}

		$respuesta = ModeloComercio::mdlActualizarLogoIcono($tabla, $id, $item, $valorNuevo);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR COLORES
	=============================================*/

	static public function ctrActualizarColores($datos){

		$tabla = "plantilla";
		$id = 1;

		$respuesta = ModeloComercio::mdlActualizarColores($tabla, $id, $datos);

		return $respuesta;


	}

	/*=============================================
	ACTUALIZAR SCRIPT
	=============================================*/

	static public function ctrActualizarScript($datos){

		$tabla = "plantilla";
		$id = 1;

		$respuesta = ModeloComercio::mdlActualizarScript($tabla, $id, $datos);

		return $respuesta;


	}

	/*=============================================
	SELECCIONAR COMERCIO
	=============================================*/

	static public function ctrSeleccionarComercio(){

		$tabla = "comercio";

		$respuesta = ModeloComercio::mdlSeleccionarComercio($tabla);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR INFORMACION
	=============================================*/

	static public function ctrActualizarInformacion($datos){

		$tabla = "comercio";
		$id = 1;

		$respuesta = ModeloComercio::mdlActualizarInformacion($tabla, $id, $datos);

		return $respuesta;


	}


}



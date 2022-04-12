<?php

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";


class AjaxVentas{

	/*=============================================
	ACTUALIZAR PROCESO DE ENVÍO
	=============================================*/
	

  	public $idVenta;
  	public $etapa;

  	public function ajaxEnvioVenta(){

  		$respuesta = ModeloVentas::mdlActualizarVenta("compras", "envio", $this->etapa, "id", $this->idVenta);

  		echo $respuesta;

	}

}

/*=============================================
ACTUALIZAR PROCESO DE ENVÍO
=============================================*/


if(isset($_POST["idVenta"])){

	$envioVenta = new AjaxVentas();
	$envioVenta -> idVenta = $_POST["idVenta"];
	$envioVenta -> etapa = $_POST["etapa"];
	$envioVenta -> ajaxEnvioVenta();

}

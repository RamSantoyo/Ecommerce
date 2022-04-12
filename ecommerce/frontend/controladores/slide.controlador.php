<?php

class ControladorSlide{

	public function ctrMostrarSlide(){

		$tabla = "slide";

		$respuesta = ModeloSlide::mdlMostrarSlide($tabla);

		return $respuesta;
		
	}

}
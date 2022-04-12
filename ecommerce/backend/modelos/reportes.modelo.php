<?php

require_once "conexion.php";

class ModeloReportes{
		
	/*=============================================
	DESCARGAR REPORTE
	=============================================*/

	static public function mdlDescargarReporte($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
		
		$stmt = null;
	
	}


	
}
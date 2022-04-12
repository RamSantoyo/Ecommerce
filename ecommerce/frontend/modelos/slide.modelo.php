<?php

require_once "conexion.php";

class ModeloSlide{

	static public function mdlMostrarSlide($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY orden ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

}
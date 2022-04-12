<?php

require_once "conexion.php";

class ModeloSlide{	

	/*=============================================
	MOSTRAR SLIDE
	=============================================*/

	static public function mdlMostrarSlide($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY orden ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CREAR SLIDE
	=============================================*/

	static public function mdlCrearSlide($tabla, $datos, $orden){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(imgFondo, tipoSlide, estiloTextoSlide, titulo1, titulo2, titulo3, boton, url, orden) VALUES (:imgFondo, :tipoSlide, :estiloTextoSlide, :titulo1, :titulo2, :titulo3, :boton, :url, :orden)");

		$stmt->bindParam(":imgFondo", $datos["imgFondo"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoSlide", $datos["tipoSlide"], PDO::PARAM_STR); 
		$stmt->bindParam(":estiloTextoSlide", $datos["estiloTextoSlide"], PDO::PARAM_STR); 
		$stmt->bindParam(":titulo1", $datos["titulo1"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo2", $datos["titulo2"], PDO::PARAM_STR);
 		$stmt->bindParam(":titulo3", $datos["titulo3"], PDO::PARAM_STR);
		$stmt->bindParam(":boton", $datos["boton"], PDO::PARAM_STR);
		$stmt->bindParam(":url", $datos["url"], PDO::PARAM_STR);
		$stmt->bindParam(":orden", $orden, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR ORDEN SLIDE
	=============================================*/

	static public function mdlActualizarOrdenSlide($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");

		$stmt->bindParam(":orden", $datos["orden"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR SLIDE
	=============================================*/

	static public function mdlActualizarSlide($tabla, $rutaFondo, $rutaProducto, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, tipoSlide = :tipoSlide, estiloImgProducto = :estiloImgProducto, estiloTextoSlide = :estiloTextoSlide, imgFondo = :imgFondo, imgProducto = :imgProducto, titulo1 = :titulo1, titulo2 = :titulo2, titulo3 = :titulo3, boton = :boton, url = :url WHERE id = :id");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoSlide", $datos["tipoSlide"], PDO::PARAM_STR);
		$stmt->bindParam(":estiloImgProducto", $datos["estiloImgProducto"], PDO::PARAM_STR); 
		$stmt->bindParam(":estiloTextoSlide", $datos["estiloTextoSlide"], PDO::PARAM_STR); 
		$stmt->bindParam(":imgFondo", $rutaFondo, PDO::PARAM_STR);
		$stmt->bindParam(":imgProducto", $rutaProducto, PDO::PARAM_STR);
		$stmt->bindParam(":titulo1", $datos["titulo1"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo2", $datos["titulo2"], PDO::PARAM_STR); 
		$stmt->bindParam(":titulo3", $datos["titulo3"], PDO::PARAM_STR);
		$stmt->bindParam(":boton", $datos["boton"], PDO::PARAM_STR); 
		$stmt->bindParam(":url", $datos["url"], PDO::PARAM_STR);   
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);	

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}

	/*=============================================
	ELIMINAR SLIDE
	=============================================*/

	static public function mdlEliminarSlide($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

		
	}


}
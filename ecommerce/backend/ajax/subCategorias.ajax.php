<?php


require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxSubCategorias{

	/*=============================================
  	ACTIVAR SUBCATEGORIA
 	=============================================*/	

	public $activarSubCategoria;
	public $activarId;

	public function ajaxActivarSubCategoria(){

		$tabla = "subcategorias";

		$item1 = "estado";
		$valor1 = $this->activarSubCategoria;

		$item2 = "id";
		$valor2 = $this->activarId;	

		ModeloProductos::mdlActualizarProductos("productos", $item1, $valor1, "id_subcategoria", $valor2);

		$respuesta = ModeloSubCategorias::mdlActualizarSubCategorias($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

	/*=============================================
	VALIDAR NO REPETIR SUBCATEGORÍA
	=============================================*/	

	public $validarSubCategoria;

	public function ajaxValidarSubCategoria(){

		$item = "subcategoria";
		$valor = $this->validarSubCategoria;

		$respuesta = ControladorSubCategorias::ctrMostrarSubCategorias($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR SUBCATEGORIA
	=============================================*/	

	public $idSubCategoria;

	public function ajaxEditarSubCategoria(){

		$item = "id";
		$valor = $this->idSubCategoria;

		$respuesta = ControladorSubCategorias::ctrMostrarSubCategorias($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	TRAER SUBCATEGORIAS DE ACUERDO A LA CATEGORÍA
	=============================================*/	

	public $idCategoria;

	public function ajaxTraerSubCategoria(){

		$item = "id_categoria";
		$valor = $this->idCategoria;

		$respuesta = ControladorSubCategorias::ctrMostrarSubCategorias($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
ACTIVAR SUBCATEGORIA
=============================================*/	

if(isset($_POST["activarSubCategoria"])){

	$activarSubCategoria = new AjaxSubCategorias();
	$activarSubCategoria -> activarSubCategoria = $_POST["activarSubCategoria"];
	$activarSubCategoria -> activarId = $_POST["activarId"];
	$activarSubCategoria -> ajaxActivarSubCategoria();

}

/*=============================================
VALIDAR NO REPETIR SUBCATEGORÍA
=============================================*/

if(isset( $_POST["validarSubCategoria"])){

	$valSubCategoria = new AjaxSubCategorias();
	$valSubCategoria -> validarSubCategoria = $_POST["validarSubCategoria"];
	$valSubCategoria -> ajaxValidarSubCategoria();

}

/*=============================================
EDITAR SUBCATEGORIA
=============================================*/
if(isset($_POST["idSubCategoria"])){

	$editarSubCategoria = new AjaxSubCategorias();
	$editarSubCategoria -> idSubCategoria = $_POST["idSubCategoria"];
	$editarSubCategoria -> ajaxEditarSubCategoria();

}

/*=============================================
TRAER SUBCATEGORIAS DE ACUERDO A LA CATEGORÍA
=============================================*/
if(isset($_POST["idCategoria"])){

	$traerSubCategoria = new AjaxSubCategorias();
	$traerSubCategoria -> idCategoria = $_POST["idCategoria"];
	$traerSubCategoria -> ajaxTraerSubCategoria();

}
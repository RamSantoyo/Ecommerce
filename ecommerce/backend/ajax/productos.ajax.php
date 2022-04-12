<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

require_once "../controladores/cabeceras.controlador.php";
require_once "../modelos/cabeceras.modelo.php";

class AjaxProductos{

	/*=============================================
  	ACTIVAR PRODUCTOS
 	=============================================*/	

 	public $activarProducto;
	public $activarId;

	public function ajaxActivarProducto(){

		$tabla = "productos";

		$item1 = "estado";
		$valor1 = $this->activarProducto;

		$item2 = "id";
		$valor2 = $this->activarId;	

		$respuesta = ModeloProductos::mdlActualizarProductos($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;

	}

	/*=============================================
	VALIDAR NO REPETIR PRODUCTO
	=============================================*/	

	public $validarProducto;

	public function ajaxValidarProducto(){

		$item = "titulo";
		$valor = $this->validarProducto;

		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	RECIBIR MULTIMEDIA
	=============================================*/

	public $imagenMultimedia;
	public $rutaMultimedia;	

	public function  ajaxRecibirMultimedia(){

		$datos = $this->imagenMultimedia;
		$ruta = $this->rutaMultimedia;

		$respuesta = ControladorProductos::ctrSubirMultimedia($datos, $ruta);

		echo $respuesta;

	}

	/*=============================================
	GUARDAR PRODUCTO Y EDITAR PRODUCTO
	=============================================*/	

	public $tituloProducto;
	public $rutaProducto;
	public $seleccionarTipo;
	public $detalles;			
	public $seleccionarCategoria;
	public $seleccionarSubCategoria;
	public $descripcionProducto;
	public $pClavesProducto;
	public $precio;
	public $peso;
	public $entrega;
	public $multimedia;
	public $fotoPortada;
	public $fotoPrincipal;
	public $selActivarOferta;
	public $precioOferta;
	public $descuentoOferta;
	public $finOferta;
	public $fotoOferta;

	public $id;
	public $antiguaFotoPortada;
	public $antiguaFotoPrincipal;
	public $antiguaFotoOferta;
	public $idCabecera;

	public function  ajaxCrearProducto(){

		$datos = array(
			"tituloProducto"=>$this->tituloProducto,
			"rutaProducto"=>$this->rutaProducto,
			"tipo"=>$this->seleccionarTipo,
			"detalles"=>$this->detalles,					
			"categoria"=>$this->seleccionarCategoria,
			"subCategoria"=>$this->seleccionarSubCategoria,
			"descripcionProducto"=>$this->descripcionProducto,
			"pClavesProducto"=>$this->pClavesProducto,
			"precio"=>$this->precio,
			"peso"=>$this->peso,
			"entrega"=>$this->entrega,
			"multimedia"=>$this->multimedia,
			"fotoPortada"=>$this->fotoPortada,
			"fotoPrincipal"=>$this->fotoPrincipal,
			"selActivarOferta"=>$this->selActivarOferta,
			"precioOferta"=>$this->precioOferta,
			"descuentoOferta"=>$this->descuentoOferta,
			"fotoOferta"=>$this->fotoOferta,
			"finOferta"=>$this->finOferta
			);

		$respuesta = ControladorProductos::ctrCrearProducto($datos);

		echo $respuesta;

	}

	/*=============================================
	TRAER PRODUCTOS
	=============================================*/	

	public $idProducto;

	public function ajaxTraerProducto(){

		$item = "id";
		$valor = $this->idProducto;

		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	EDITAR PRODUCTOS
	=============================================*/	

	public function  ajaxEditarProducto(){

		$datos = array(
			"idProducto"=>$this->id,
			"tituloProducto"=>$this->tituloProducto,
			"rutaProducto"=>$this->rutaProducto,
			"tipo"=>$this->seleccionarTipo,
			"detalles"=>$this->detalles,					
			"categoria"=>$this->seleccionarCategoria,
			"subCategoria"=>$this->seleccionarSubCategoria,
			"descripcionProducto"=>$this->descripcionProducto,
			"pClavesProducto"=>$this->pClavesProducto,
			"precio"=>$this->precio,
			"peso"=>$this->peso,
			"entrega"=>$this->entrega,
			"multimedia"=>$this->multimedia,
			"fotoPortada"=>$this->fotoPortada,
			"fotoPrincipal"=>$this->fotoPrincipal,
			"selActivarOferta"=>$this->selActivarOferta,
			"precioOferta"=>$this->precioOferta,
			"descuentoOferta"=>$this->descuentoOferta,
			"fotoOferta"=>$this->fotoOferta,
			"finOferta"=>$this->finOferta,
			"antiguaFotoPortada"=>$this->antiguaFotoPortada,
			"antiguaFotoPrincipal"=>$this->antiguaFotoPrincipal,
			"antiguaFotoOferta"=>$this->antiguaFotoOferta,
			"idCabecera"=>$this->idCabecera
			);

		$respuesta = ControladorProductos::ctrEditarProducto($datos);

	
		echo $respuesta;

	}

 }

/*=============================================
ACTIVAR PRODUCTOS
=============================================*/	

if(isset($_POST["activarProducto"])){

	$activarProducto = new AjaxProductos();
	$activarProducto -> activarProducto = $_POST["activarProducto"];
	$activarProducto -> activarId = $_POST["activarId"];
	$activarProducto -> ajaxActivarProducto();

}

/*=============================================
VALIDAR NO REPETIR PRODUCTO
=============================================*/

if(isset($_POST["validarProducto"])){

	$valProducto = new AjaxProductos();
	$valProducto -> validarProducto = $_POST["validarProducto"];
	$valProducto -> ajaxValidarProducto();

}

#RECIBIR ARCHIVOS MULTIMEDIA
#-----------------------------------------------------------
if(isset($_FILES["file"])){

	$multimedia = new AjaxProductos();
	$multimedia -> imagenMultimedia = $_FILES["file"];
	$multimedia -> rutaMultimedia = $_POST["ruta"];
	$multimedia -> ajaxRecibirMultimedia();

}

#CREAR PRODUCTO
#-----------------------------------------------------------
if(isset($_POST["tituloProducto"])){

	$producto = new AjaxProductos();
	$producto -> tituloProducto = $_POST["tituloProducto"];
	$producto -> rutaProducto = $_POST["rutaProducto"];
	$producto -> seleccionarTipo = $_POST["seleccionarTipo"];
	$producto -> detalles = $_POST["detalles"];		
	$producto -> seleccionarCategoria = $_POST["seleccionarCategoria"];
	$producto -> seleccionarSubCategoria = $_POST["seleccionarSubCategoria"];
	$producto -> descripcionProducto = $_POST["descripcionProducto"];
	$producto -> pClavesProducto = $_POST["pClavesProducto"];
	$producto -> precio = $_POST["precio"];
	$producto -> peso = $_POST["peso"];
	$producto -> entrega = $_POST["entrega"];
	$producto -> multimedia = $_POST["multimedia"];

	if(isset($_FILES["fotoPortada"])){

		$producto -> fotoPortada = $_FILES["fotoPortada"];

	}else{

		$producto -> fotoPortada = null;

	}	

	if(isset($_FILES["fotoPrincipal"])){

		$producto -> fotoPrincipal = $_FILES["fotoPrincipal"];

	}else{

		$producto -> fotoPrincipal = null;

	}	

	$producto -> selActivarOferta = $_POST["selActivarOferta"];
	$producto -> precioOferta = $_POST["precioOferta"];
	$producto -> descuentoOferta = $_POST["descuentoOferta"];	

	if(isset($_FILES["fotoOferta"])){

		$producto -> fotoOferta = $_FILES["fotoOferta"];

	}else{

		$producto -> fotoOferta = null;

	}	

	$producto -> finOferta = $_POST["finOferta"];

	$producto -> ajaxCrearProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/
if(isset($_POST["idProducto"])){

	$traerProducto = new AjaxProductos();
	$traerProducto -> idProducto = $_POST["idProducto"];
	$traerProducto -> ajaxTraerProducto();

}

/*=============================================
EDITAR PRODUCTO
=============================================*/
if(isset($_POST["id"])){

	$editarProducto = new AjaxProductos();
	$editarProducto -> id = $_POST["id"];
	$editarProducto -> tituloProducto = $_POST["editarProducto"];
	$editarProducto -> rutaProducto = $_POST["rutaProducto"];
	$editarProducto -> seleccionarTipo = $_POST["seleccionarTipo"];
	$editarProducto -> detalles = $_POST["detalles"];		
	$editarProducto -> seleccionarCategoria = $_POST["seleccionarCategoria"];
	$editarProducto -> seleccionarSubCategoria = $_POST["seleccionarSubCategoria"];
	$editarProducto -> descripcionProducto = $_POST["descripcionProducto"];
	$editarProducto -> pClavesProducto = $_POST["pClavesProducto"];
	$editarProducto -> precio = $_POST["precio"];
	$editarProducto -> peso = $_POST["peso"];
	$editarProducto -> entrega = $_POST["entrega"];
	$editarProducto -> multimedia = $_POST["multimedia"];

	if(isset($_FILES["fotoPortada"])){

		$editarProducto -> fotoPortada = $_FILES["fotoPortada"];

	}else{

		$editarProducto -> fotoPortada = null;

	}	

	if(isset($_FILES["fotoPrincipal"])){

		$editarProducto -> fotoPrincipal = $_FILES["fotoPrincipal"];

	}else{

		$editarProducto -> fotoPrincipal = null;

	}	

	$editarProducto -> selActivarOferta = $_POST["selActivarOferta"];
	$editarProducto -> precioOferta = $_POST["precioOferta"];
	$editarProducto -> descuentoOferta = $_POST["descuentoOferta"];	

	if(isset($_FILES["fotoOferta"])){

		$editarProducto -> fotoOferta = $_FILES["fotoOferta"];

	}else{

		$editarProducto -> fotoOferta = null;

	}	

	$editarProducto -> finOferta = $_POST["finOferta"];

	$editarProducto -> antiguaFotoPortada = $_POST["antiguaFotoPortada"];
	$editarProducto -> antiguaFotoPrincipal = $_POST["antiguaFotoPrincipal"];
	$editarProducto -> antiguaFotoOferta = $_POST["antiguaFotoOferta"];
	$editarProducto -> idCabecera = $_POST["idCabecera"];

	$editarProducto -> ajaxEditarProducto();

}



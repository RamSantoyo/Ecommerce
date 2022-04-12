
/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
VISUALIZAR LA CESTA DEL CARRITO DE COMPRAS
=============================================*/

if(localStorage.getItem("cantidadCesta") != null){

	$(".cantidadCesta").html(localStorage.getItem("cantidadCesta"));
	$(".sumaCesta").html(localStorage.getItem("sumaCesta"));

}else{

	$(".cantidadCesta").html("0");
	$(".sumaCesta").html("0");
}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
VISUALIZAR LOS PRODUCTOS EN LA PÁGINA CARRITO DE COMPRAS
=============================================*/
if(localStorage.getItem("listaProductos") != null){

var listaCarrito = JSON.parse(localStorage.getItem("listaProductos"));

}else{
		/*=============================================
			SI YA NO QUEDAN PRODUCTOS HAY QUE REMOVER TODO
		=============================================*/

		$(".cuerpoCarrito").html('<center><div class="well"><H2>Aún no hay productos en el carrito de compras.</H2></div></center>');
		$(".sumaCarrito").hide();
		$(".cabeceraCheckout").hide();
}

for(var i = 0; i < indice.length; i++){

	if(indice[i] == "carrito-de-compras"){

		listaCarrito.forEach(funcionForEach);

		function funcionForEach(item, index){

			var datosProducto = new FormData();
				var precio = 0;

				datosProducto.append("id", item.idProducto);

				$.ajax({

					url:rutaOculta+"ajax/producto.ajax.php",
					method:"POST",
					data: datosProducto,
					cache: false,
					contentType: false,
					processData:false,
					dataType: "json",
					success: function(respuesta){
			
						if(respuesta["precioOferta"] == 0){

							precio = respuesta["precio"];

						}else{

							precio = respuesta["precioOferta"];
							
						}

					$(".cuerpoCarrito").append(


							'<div clas="row itemCarrito">'+
								
								'<div class="col-sm-1 col-xs-12">'+
									
									'<br>'+

									'<center>'+
										
										'<button class="btn btn-default tache quitarItemCarrito" idProducto="'+item.idProducto+'" peso="'+item.peso+'">'+
											
											'<i class="fa fa-times"></i>'+

										'</button>'+

										'<span class="textoelimina">Eliminar </span>'+

									'</center>'+

									'<br>'+		

								'</div>'+
								'<div class="col-sm-1 col-xs-12">'+
									
									'<figure>'+
										
										'<img src="'+item.imagen+'" class="img-thumbnail">'+

									'</figure>'+

								'</div>'+

								'<div class="col-sm-4 col-xs-12">'+

									'<br>'+

									'<p class="tituloCarritoCompra text-left">'+item.titulo+'</p>'+

								'</div>'+

								'<div class="col-md-2 col-sm-1 col-xs-12">'+

									'<br>'+

									'<p class="precioCarritoCompra text-center">MXN $<span>'+precio+'</span></p>'+

								'</div>'+

								'<div class="col-md-2 col-sm-3 col-xs-8">'+

									'<br>'+	

									'<div class="col-xs-8">'+

										'<center>'+
										
											'<input type="number" class="form-control cantidadItem" min="1" value="'+item.cantidad+'" tipo="'+item.tipo+'" precio="'+precio+'" idProducto="'+item.idProducto+'" item="'+index+'">'+

										'</center>'+

									'</div>'+

								'</div>'+

								'<div class="col-md-2 col-sm-1 col-xs-4 text-center">'+
									
									'<br>'+

									'<p class="subTotal'+index+' subtotales">'+
										
										'<strong>MXN $<span>'+(Number(item.cantidad)*Number(precio))+'</span></strong>'+

									'</p>'+

								'</div>'+
								
							'</div>'+

							'<div class="clearfix"></div>'+

							'<hr>');

				/*=============================================
				EVITAR MANIPULAR LA CANTIDAD EN PRODUCTOS VIRTUALES
				=============================================*/

				$(".cantidadItem[tipo='virtual']").attr("readonly","true");

				// /*=============================================
				// /*=============================================
				// /*=============================================
				// /*=============================================
				// /*=============================================
				// ACTUALIZAR SUBTOTAL
				// =============================================*/

				var precioCarritoCompra = $(".cuerpoCarrito .precioCarritoCompra span");
				
				cestaCarrito(precioCarritoCompra.length);

				sumaSubtotales();


				}

			})	
				
   		}

  	}

}


/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
AGREGAR AL CARRITO
=============================================*/

$(".agregarCarrito").click(function(){

	var idProducto = $(this).attr("idProducto");
	var imagen = $(this).attr("imagen");
	var titulo = $(this).attr("titulo");
	var precio = $(this).attr("precio");
	var tipo = $(this).attr("tipo");
	var peso = $(this).attr("peso");

	var agregarAlCarrito = false;


	/*=============================================
	CAPTURAR DETALLES
	=============================================*/

	if(tipo == "virtual"){

		agregarAlCarrito = true;

	}else{

		var seleccionarDetalle = $(".seleccionarDetalle");
		
		for(var i = 0; i < seleccionarDetalle.length; i++){

			console.log("seleccionarDetalle", $(seleccionarDetalle[i]).val());

			if($(seleccionarDetalle[i]).val() == ""){

				swal({
					  title: "Debe seleccionar Talla y Color",
					  text: "",
					  type: "warning",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "¡Seleccionar!",
					  closeOnConfirm: false
					})

				return;

			}else{

				titulo = titulo + "-" + $(seleccionarDetalle[i]).val();

				agregarAlCarrito = true;

				$(seleccionarDetalle[i]).val("");

			}

		}		

	}



	/*=============================================
	ALMACENAR EN EL LOCALSTARGE LOS PRODUCTOS AGREGADOS AL CARRITO
	=============================================*/

	if(agregarAlCarrito){

		/*=============================================
		RECUPERAR ALMACENAMIENTO DEL LOCALSTORAGE
		=============================================*/

		if(localStorage.getItem("listaProductos") == null){

			listaCarrito = [];

		}else{

			var listaProductos = JSON.parse(localStorage.getItem("listaProductos"));

			for(var i = 0; i < listaProductos.length; i++){

				if(listaProductos[i]["idProducto"] == idProducto && listaProductos[i]["tipo"] == "virtual"){

					swal({
					  title: "Ya está agregado al carrito de compras",
					  text: "",
					  type: "warning",
					  showCancelButton: false,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "¡Volver!",
					  closeOnConfirm: false
					})

					return;

				}

			}

			listaCarrito.concat(localStorage.getItem("listaProductos"));

		}

		listaCarrito.push({"idProducto":idProducto,
						   "imagen":imagen,
						   "titulo":titulo,
						   "precio":precio,
					       "tipo":tipo,
				           "peso":peso,
				           "cantidad":"1"});

		localStorage.setItem("listaProductos", JSON.stringify(listaCarrito));

		/*=============================================
		ACTUALIZAR LA CESTA
		=============================================*/

		var cantidadCesta = Number($(".cantidadCesta").html()) + 1;
		var sumaCesta = Number($(".sumaCesta").html()) + Number(precio);

		$(".cantidadCesta").html(cantidadCesta);
		$(".sumaCesta").html(sumaCesta);

		localStorage.setItem("cantidadCesta", cantidadCesta);
		localStorage.setItem("sumaCesta", sumaCesta);
		
		/*=============================================
		MOSTRAR ALERTA DE QUE EL PRODUCTO YA FUE AGREGADO
		=============================================*/

			swal({
			  title: "",
			  text: "¡Se ha agregado correctamente al carrito!",
			  type: "success",
			  showCancelButton: true,
			  confirmButtonColor: "#01A8E6",
			  cancelButtonText: "¡Continuar comprando!",
			  confirmButtonText: "¡Ir a mi carrito de compras!",
			  closeOnConfirm: false
			},
			function(isConfirm){
				if (isConfirm) {	   
					 window.location = rutaOculta+"carrito-de-compras";			
				} 
		});	

	}

})

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
QUITAR PRODUCTOS DEL CARRITO
=============================================*/

$(document).on("click", ".quitarItemCarrito", function(){

	$(this).parent().parent().parent().remove();

	var idProducto = $(".cuerpoCarrito button");
	var imagen = $(".cuerpoCarrito img");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var precio = $(".cuerpoCarrito .precioCarritoCompra span");
	var cantidad = $(".cuerpoCarrito .cantidadItem");

	/*=============================================
	SI AÚN QUEDAN PRODUCTOS VOLVERLOS AGREGAR AL CARRITO (LOCALSTORAGE)
	=============================================*/

	listaCarrito = [];

	if(idProducto.length != 0){

		for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var imagenArray = $(imagen[i]).attr("src");
			var tituloArray = $(titulo[i]).html();
			var precioArray = $(precio[i]).html();
			var pesoArray = $(idProducto[i]).attr("peso");
			var tipoArray = $(cantidad[i]).attr("tipo");
			var cantidadArray = $(cantidad[i]).val();

			listaCarrito.push({"idProducto":idProductoArray,
						   "imagen":imagenArray,
						   "titulo":tituloArray,
						   "precio":precioArray,
					       "tipo":tipoArray,
				           "peso":pesoArray,
				           "cantidad":cantidadArray});

		}

		localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

		sumaSubtotales();
		cestaCarrito(listaCarrito.length);

	}else{

		/*=============================================
		SI YA NO QUEDAN PRODUCTOS HAY QUE REMOVER TODO
		=============================================*/	

		localStorage.removeItem("listaProductos");

		localStorage.setItem("cantidadCesta","0");
		
		localStorage.setItem("sumaCesta","0");

		$(".cantidadCesta").html("0");
		$(".sumaCesta").html("0");

		$(".cuerpoCarrito").html('<center><div class="well"><H2>Aún no hay productos en el carrito de compras.</H2></div></center>');
		$(".sumaCarrito").hide();
		$(".cabeceraCheckout").hide();

	}


})

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
GENERAR SUBTOTAL DESPUES DE CAMBIAR CANTIDAD
=============================================*/

$(document).on("change", ".cantidadItem", function(){

	var cantidad = $(this).val();
	var precio = $(this).attr("precio");
	var idProducto = $(this).attr("idProducto");
	var item = $(this).attr("item");

			/*=============================================
			EVITAR NUMEROS NEGATIVOS
			=============================================*/

			 if(cantidad < 1){

			    cantidad = 1;
			  }
  			

	$(".subTotal"+item).html('<strong>MXN $<span>'+(cantidad*precio).toFixed(2)+'</span></strong>');

	/*=============================================
	ACTUALIZAR LA CANTIDAD EN EL LOCALSTORAGE
	=============================================*/

	var idProducto = $(".cuerpoCarrito button");
	var imagen = $(".cuerpoCarrito img");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra");
	var precio = $(".cuerpoCarrito .precioCarritoCompra span");
	var cantidad = $(".cuerpoCarrito .cantidadItem");

	listaCarrito = [];

	for(var i = 0; i < idProducto.length; i++){

			var idProductoArray = $(idProducto[i]).attr("idProducto");
			var imagenArray = $(imagen[i]).attr("src");
			var tituloArray = $(titulo[i]).html();
			var precioArray = $(precio[i]).html();
			var pesoArray = $(idProducto[i]).attr("peso");
			var tipoArray = $(cantidad[i]).attr("tipo");
			var cantidadArray = $(cantidad[i]).val();

			/*=============================================
			EVITAR NUMEROS NEGATIVOS
			=============================================*/


			 if(cantidadArray < 1){

			    cantidadArray = 1;
			  }
						listaCarrito.push({"idProducto":idProductoArray,
						   "imagen":imagenArray,
						   "titulo":tituloArray,
						   "precio":precioArray,
					       "tipo":tipoArray,
				           "peso":pesoArray,
				           "cantidad":cantidadArray});

		}

		localStorage.setItem("listaProductos",JSON.stringify(listaCarrito));

		sumaSubtotales();
		cestaCarrito(listaCarrito.length);	

})


/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
SUMA DE TODOS LOS SUBTOTALES
=============================================*/

function sumaSubtotales(){

	var subtotales = $(".subtotales span");
	var arraySumaSubtotales = [];
	
	for(var i = 0; i < subtotales.length; i++){

		var subtotalesArray = $(subtotales[i]).html();


		arraySumaSubtotales.push(Number(subtotalesArray));
		
	}

	
	function sumaArraySubtotales(total, numero){

		return total + numero;

	}

	var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales);
	
	$(".sumaSubTotal").html('<strong>MXN $<span>'+(sumaTotal).toFixed(2)+'</span></strong>');

	$(".sumaCesta").html((sumaTotal).toFixed(2));

	localStorage.setItem("sumaCesta", (sumaTotal).toFixed(2));


}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
ACTUALIZAR CESTA AL CAMBIAR CANTIDAD
=============================================*/

function cestaCarrito(cantidadProductos){

	/*=============================================
	SI HAY PRODUCTOS EN EL CARRITO
	=============================================*/

	if(cantidadProductos != 0){
		
		var cantidadItem = $(".cuerpoCarrito .cantidadItem");

		var arraySumaCantidades = [];
	
		for(var i = 0; i < cantidadItem .length; i++){

			var cantidadItemArray = $(cantidadItem[i]).val();

			/*=============================================
			EVITAR NUMEROS NEGATIVOS
			=============================================*/

			 if(cantidadItemArray < 1){

			    cantidadItemArray = 1;
			  }
			
			arraySumaCantidades.push(Number(cantidadItemArray));
			
		}
	
		function sumaArrayCantidades(total, numero){

			return total + numero;

		}

		var sumaTotalCantidades = arraySumaCantidades.reduce(sumaArrayCantidades);
		
		$(".cantidadCesta").html(sumaTotalCantidades );
		localStorage.setItem("cantidadCesta", sumaTotalCantidades);

	}

}

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
CHECKOUT
=============================================*/

$("#btnCheckout").click(function(){ 

	$(".listaProductos table.tablaProductos tbody").html("");

	$("#checkPaypal").prop("checked",true);
	$("#checkMercado").prop("checked", false);

	var idUsuario = $(this).attr("idUsuario");
	var peso = $(".cuerpoCarrito button, .comprarAhora button");
	var titulo = $(".cuerpoCarrito .tituloCarritoCompra, .comprarAhora .tituloCarritoCompra");
	var cantidad = $(".cuerpoCarrito .cantidadItem, .comprarAhora .cantidadItem");
	var subtotal = $(".cuerpoCarrito .subtotales span, .comprarAhora .subtotales span");
	var tipoArray =[];
	var cantidadPeso = [];

	/*=============================================
	SUMA SUBTOTAL
	=============================================*/
	var sumaSubTotal = $(".sumaSubTotal span")
	
	$(".valorSubtotal").html($(sumaSubTotal).html());
	$(".valorSubtotal").attr("valor",$(sumaSubTotal).html());

	/*=============================================
	TASAS DE IMPUESTO
	=============================================*/

	var impuestoTotal = ($(".valorSubtotal").html() * $("#tasaImpuesto").val()) /100;
	
	$(".valorTotalImpuesto").html((impuestoTotal).toFixed(2));
	$(".valorTotalImpuesto").attr("valor",(impuestoTotal).toFixed(2));

	sumaTotalCompra();

	/*=============================================
	VARIABLES ARRAY 
	=============================================*/
	for(var i = 0; i < titulo.length; i++){

		var pesoArray = $(peso[i]).attr("peso");
		var tituloArray = $(titulo[i]).html();
		var cantidadArray = $(cantidad[i]).val();		
		var subtotalArray = $(subtotal[i]).html();

			/*=============================================
			EVITAR NUMEROS NEGATIVOS
			=============================================*/

			 if(cantidadArray < 1){

			    cantidadArray = 1;
			  }


		/*=============================================
		EVALUAR EL PESO DE ACUERDO A LA CANTIDAD DE PRODUCTOS
		=============================================*/

		cantidadPeso[i] = pesoArray * cantidadArray;

		function sumaArrayPeso(total, numero){

			return total + numero;

		}

		var sumaTotalPeso = cantidadPeso.reduce(sumaArrayPeso);


		/*=============================================
		MOSTRAR PRODUCTOS DEFINITIVOS A COMPRAR
		=============================================*/

		$(".listaProductos table.tablaProductos tbody").append('<tr>'+
															   '<td class="valorTitulo">'+tituloArray+'</td>'+
															   '<td class="valorCantidad">'+cantidadArray+'</td>'+
															   '<td>$<span class="valorItem" valor="'+subtotalArray+'">'+subtotalArray+'</span></td>'+
															   '<tr>');

	
		/*=============================================
		SELECCIONAR PAÍS DE ENVÍO SI HAY PRODUCTOS FÍSICOS
		=============================================*/
	
		tipoArray.push($(cantidad[i]).attr("tipo"));
		
		function checkTipo(tipo){


			return tipo == "fisico";
		
		}
	}
		/*=============================================
		EXISTEN PRODUCTOS FÍSICOS
		=============================================*/

		if(tipoArray.find(checkTipo) == "fisico"){

			$(".seleccionePais").html('<select class="form-control paises" id="seleccionarPais" required>'+
						
						          '<option value="">Seleccione el país</option>'+

					              '</select>'+

					              '<br>');

			$(".numero").html('<input type="text" class="form-control celular" id="phone" placeholder="Telefono de contacto" required>');


			$(".informes").html(  '<center>'+

					              '<H4>'+

						          '<strong>Al realizar tu pago, los productos serán enviados a la dirección asignada de tu cuenta Paypal</strong>'+

						          '<p>'+

						          '<br>'+

						          '<a href="">'+	

						          '<h4>¿Dudas? Comunicate con nosotros</h4>'+

						          '</a>'+
						          
						          '</H4>'+
						          '</center>');

			
			$(".formEnvio").show();

			$(".btnPagar").attr("tipo","fisico");


			/*=============================================
			SOLO NUMEROS 
			=============================================*/

			formEnvio = document.querySelector('#phone');
			formEnvio.addEventListener('keypress', function (e){
				if (!soloNumeros(event)){
			  	e.preventDefault();
			  }
			})

			//Solo permite introducir numeros.
			function soloNumeros(e){
			    var key = e.charCode;
			    console.log(key);
			    return key >= 48 && key <= 57;
			}

			/*=============================================
			REMOVER ALERTA AL DAR CLIC EN INPUT
			=============================================*/

			$("input").focus(function(){

				$(".alert").remove();
			})


				$.ajax({
				url:rutaOculta+"vistas/js/plugins/countries.json",
				type: "GET",
				cache: false,
				contentType: false,
				processData:false,
				dataType:"json",
				success: function(respuesta){

					respuesta.forEach(seleccionarPais);

					function seleccionarPais(item, index){

						var pais = item.name;
						var codPais = item.code;

						$("#seleccionarPais").append('<option value="'+codPais+'">'+pais+'</option>');
					
					}

				}
			})
			
			/*=============================================
			EVALUAR TASAS DE ENVÍO SI EL PRODUCTO ES FÍSICO
			=============================================*/

			$("#seleccionarPais").change(function(){

				$(".alert").remove();

				var pais = $(this).val();
				var tasaPais = $("#tasaPais").val();

				if(pais == tasaPais){

					var resultadoPeso = sumaTotalPeso * $("#envioNacional").val();
					
						if(resultadoPeso < $("#tasaMinimaNal").val()){

							$(".valorTotalEnvio").html($("#tasaMinimaNal").val());
							$(".valorTotalEnvio").attr("valor", $("#tasaMinimaNal").val());

						}else{

							$(".valorTotalEnvio").html(resultadoPeso);
							$(".valorTotalEnvio").attr("valor",resultadoPeso);
						}

				}else{

				var resultadoPeso = sumaTotalPeso * $("#envioInternacional").val();
				
					if(resultadoPeso < $("#tasaMinimaInt").val()){

						$(".valorTotalEnvio").html($("#tasaMinimaInt").val());
						$(".valorTotalEnvio").attr("valor",$("#tasaMinimaInt").val());

					}else{

						$(".valorTotalEnvio").html(resultadoPeso);
						$(".valorTotalEnvio").attr("valor",resultadoPeso);

					}

				}

				/*=============================================
				RETORNAR VALORES AL CAMBIAR PAIS
				=============================================*/
				$("#cambiarDivisa").val("MXN");
				$(".cambioDivisa").html("MXN");

				$(".valorSubtotal").html($(".valorSubtotal").attr("valor"))
		    	$(".valorTotalEnvio").html($(".valorTotalEnvio").attr("valor"))
		    	$(".valorTotalImpuesto").html($(".valorTotalImpuesto").attr("valor"))
		    	$(".valorTotalCompra").html($(".valorTotalCompra").attr("valor"))

		    	var valorItem = $(".valorItem");


		    	for(var i = 0; i < valorItem.length; i++){

		    		$(valorItem[i]).html($(valorItem[i]).attr("valor"));

		    	}

				sumaTotalCompra();	

			})	

		}else{


			$(".btnPagar").attr("tipo","virtual");
		}

})



/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
SUMA TOTAL DE LA COMPRA
=============================================*/
function sumaTotalCompra(){

	var sumaTotalTasas = Number($(".valorSubtotal").html())+ 
	                     Number($(".valorTotalEnvio").html())+ 
	                     Number($(".valorTotalImpuesto").html());


	$(".valorTotalCompra").html((sumaTotalTasas).toFixed(2));
	$(".valorTotalCompra").attr("valor",(sumaTotalTasas).toFixed(2));

	localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));

}


/*=============================================
/*=============================================
/*=============================================
/*=============================================
MÉTODO DE PAGO PARA CAMBIO DE DIVISA
=============================================*/

var metodoPago = "paypal";
divisas(metodoPago);

$("input[name='pago']").change(function(){

	var metodoPago = $(this).val();

	if(metodoPago == "mercadopago"){

		$(".btnPagar").hide();
		$(".mercadopago-button").hide();
		$(".formMercado").show();
		$(".btnmercado").show();
		$(".pregunta").show();


	}else{

		$(".btnPagar").show();
		$(".formMercado").hide();

	}



	/*=============================================
		RETORNAR VALORES AL CAMBIAR PAIS
	=============================================*/


	sumaTotalCompra();

			

})


/*=============================================
/*=============================================
/*=============================================
/*=============================================
FUNCIÓN PARA EL CAMBIO DE DIVISA
=============================================*/

function divisas(metodoPago){

	$("#cambiarDivisa").html("");

	if(metodoPago == "paypal"){

		$("#cambiarDivisa").append('<option value="MXN">MXN</option>')

	}else{

		$("#cambiarDivisa").append('<option value="MXN">MXN</option>')

	}

}


/*=============================================
/*=============================================
/*=============================================
/*=============================================
CAMBIO DE DIVISA
=============================================*/

var divisaBase = "MXN";

$("#cambiarDivisa").change(function(){

	$(".alert").remove();

	if($("#seleccionarPais").val() == ""){

		$("#cambiarDivisa").after('<div class="alert alert-warning">SELECCIONE UN PAIS DE ENVIO</div>');

		return;

	}
	
	var divisa = $(this).val();

	$.ajax({

		url: "https://free.currconv.com/api/v7/convert?q="+divisaBase+"_"+divisa+"&compact=ultra&apiKey=95583d3603881e114154",
		type:"GET",
		cache: false,
	    contentType: false,
	    processData: false,
	    dataType:"jsonp",
	    success:function(respuesta){

	    	/*=============================================
			NO ACEPTA 0 ENTONCES AGARRA LOS DECIMALES
			=============================================*/
	        	
	    var conversion = (respuesta["MXN_"+divisa]).toFixed(2);


	    	$(".cambioDivisa").html(divisa);
	    	
	    	if(divisa == "MXN"){

	    		$(".valorSubtotal").html($(".valorSubtotal").attr("valor"))
		    	$(".valorTotalEnvio").html($(".valorTotalEnvio").attr("valor"))
		    	$(".valorTotalImpuesto").html($(".valorTotalImpuesto").attr("valor"))
		    	$(".valorTotalCompra").html($(".valorTotalCompra").attr("valor"))

		    	var valorItem = $(".valorItem");


		    	for(var i = 0; i < valorItem.length; i++){

		    		$(valorItem[i]).html($(valorItem[i]).attr("valor"));

		    	}
	    		
	    	}else{
	
	    		
		    	$(".valorSubtotal").html(
		    		
		    		Math.ceil(Number(conversion) * Number($(".valorSubtotal").attr("valor"))*100)/100

		    	)

		    	$(".valorTotalEnvio").html(

		    		(Number(conversion) * Number($(".valorTotalEnvio").attr("valor"))).toFixed(2)

		    	)

		    	$(".valorTotalImpuesto").html(

		    		(Number(conversion) * Number($(".valorTotalImpuesto").attr("valor"))).toFixed(2)

		    	)

		    	$(".valorTotalCompra").html(

		    		(Number(conversion) * Number($(".valorTotalCompra").attr("valor"))).toFixed(2)

		    	)

		    	var valorItem = $(".valorItem");

		    	localStorage.setItem("total",hex_md5($(".valorTotalCompra").html()));

		    	for(var i = 0; i < valorItem.length; i++){

		    			$(valorItem[i]).html(

		    			(Number(conversion) * Number($(valorItem[i]).attr("valor"))).toFixed(2)


		    			);

		    	}

		    }

	    	sumaTotalCompra();

	    }

	})	

	

})


/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
BOTÓN PAGAR PAYPAL 
=============================================*/

$(".btnPagar").click(function(){

	var tipo = $(this).attr("tipo");

	if(tipo == "fisico" && $("#seleccionarPais").val() == ""){

		$(".btnPagar").after('<center><div class="alert alert-warning">COMPLETE TODOS LOS CAMPOS</div></center>');

		return;
	}

	if($("#phone").val() == ""){

		$(".btnPagar").after('<center><div class="alert alert-warning">COMPLETE TODOS LOS CAMPOS</div></center>');

		return;
	}else{

		$(".alert").remove();
	}

	/*=============================================
	CAPTURAR VALORES
	=============================================*/

	var divisa = $("#cambiarDivisa").val();
	var total = $(".valorTotalCompra").html();
	var totalEncriptado = localStorage.getItem("total");
	var impuesto = $(".valorTotalImpuesto").html();
	var envio = $(".valorTotalEnvio").html();
	var subtotal = $(".valorSubtotal").html();
	var titulo = $(".valorTitulo");
	var cantidad = $(".valorCantidad");
	var valorItem = $(".valorItem");
	var idProducto = $('.cuerpoCarrito button, .comprarAhora button');
	var telefono = $("#phone").val();

	var tituloArray = [];
	var cantidadArray = [];
	var valorItemArray = [];
	var idProductoArray = [];

	for(var i = 0; i < titulo.length; i++){

		tituloArray[i] = $(titulo[i]).html();
		cantidadArray[i] = $(cantidad[i]).html();
		valorItemArray[i] = $(valorItem[i]).html();
		idProductoArray[i] = $(idProducto[i]).attr("idProducto");

	}

	var datos = new FormData();

	datos.append("divisa", divisa);
	datos.append("total",total);
	datos.append("totalEncriptado",totalEncriptado);
	datos.append("impuesto",impuesto);
	datos.append("envio",envio);
	datos.append("subtotal",subtotal);
	datos.append("tituloArray",tituloArray);
	datos.append("cantidadArray",cantidadArray);
	datos.append("valorItemArray",valorItemArray);
	datos.append("idProductoArray",idProductoArray);
	datos.append("telefono",telefono);


		$.ajax({
			 url:rutaOculta+"ajax/carrito.ajax.php",
			 method:"POST",
			 data: datos,
			 cache: false,
	         contentType: false,
	         processData: false,
	         success:function(respuesta){

	               window.location = respuesta;

	         }

		})

})


/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
AGREGAR PRODUCTOS GRATIS
=============================================*/
$(".agregarGratis").click(function(){

	var idProducto = $(this).attr("idProducto");
	var idUsuario = $(this).attr("idUsuario");
	var tipo = $(this).attr("tipo");
	var titulo = $(this).attr("titulo");
	var agregarGratis = false;

	/*=============================================
	VERIFICAR QUE NO TENGA EL PRODUCTO ADQUIRIDO
	=============================================*/

	var datos = new FormData();

	datos.append("idUsuario", idUsuario);
	datos.append("idProducto", idProducto);

	$.ajax({
		url:rutaOculta+"ajax/carrito.ajax.php",
		method:"POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	success:function(respuesta){
      	    
      	    if(respuesta != "false"){

  	    		swal({
				  title: "¡Usted ya adquirió este producto!",
				  text: "",
				  type: "warning",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Regresar",
				  closeOnConfirm: false
				})


      	    }else{

				if(tipo == "virtual"){

					agregarGratis = true;

				}else{

					var seleccionarDetalle = $(".seleccionarDetalle");

					for(var i = 0; i < seleccionarDetalle.length; i++){

						if($(seleccionarDetalle[i]).val() == ""){

								swal({
									  title: "Debe seleccionar Talla y Color",
									  text: "",
									  type: "warning",
									  showCancelButton: false,
									  confirmButtonColor: "#DD6B55",
									  confirmButtonText: "¡Seleccionar!",
									  closeOnConfirm: false
									})

						}else{

							titulo = titulo + "-" + $(seleccionarDetalle[i]).val();

							agregarGratis = true;

						}

					}		

				}

				if(agregarGratis){

					window.location = rutaOculta+"index.php?ruta=finalizar-compra&gratis=true&producto="+idProducto+"&titulo="+titulo;

				}
    	    
      	    }

      	}

	})
	

})

/*=============================================
/*=============================================
/*=============================================
/*=============================================
/*=============================================
BOTÓN PAGAR MERCADO
=============================================*/

$(".btnmercado").click(function(){

	if($("#seleccionarPais").val() == ""){


		$(".formMercado").after('<center><div class="alert alert-warning">COMPLETE TODOS LOS CAMPOS</div></center>');
		
		return;

	}if($("#phone").val() == ""){

		$(".formMercado").after('<center><div class="alert alert-warning">COMPLETE TODOS LOS CAMPOS</div></center>');

		return;
	}

	$(".mercadopago-button").show();
	$(".btnmercado").hide();
	$(".pregunta").hide();


	var divisa = $("#cambiarDivisa").val();
	var total = $(".valorTotalCompra").html();
	var totalEncriptado = localStorage.getItem("total");
	var impuesto = $(".valorTotalImpuesto").html();
	var envio = $(".valorTotalEnvio").html();
	var subtotal = $(".valorSubtotal").html();
	var titulo = $(".valorTitulo");
	var cantidad = $(".valorCantidad");
	var valorItem = $(".valorItem");
	var idProducto = $('.cuerpoCarrito button, .comprarAhora button');
	var telefono = $("#phone").val();

	var tituloArray = [];
	var cantidadArray = [];
	var valorItemArray = [];
	var idProductoArray = [];

	for(var i = 0; i < titulo.length; i++){

		tituloArray[i] = $(titulo[i]).html();
		cantidadArray[i] = $(cantidad[i]).html();
		valorItemArray[i] = $(valorItem[i]).html();
		idProductoArray[i] = $(idProducto[i]).attr("idProducto");

	}

	var datos = new FormData();

	datos.append("divisa", divisa);
	datos.append("total",total);
	datos.append("totalEncriptado",totalEncriptado);
	datos.append("impuesto",impuesto);
	datos.append("envio",envio);
	datos.append("subtotal",subtotal);
	datos.append("tituloArray",tituloArray);
	datos.append("cantidadArray",cantidadArray);
	datos.append("valorItemArray",valorItemArray);
	datos.append("idProductoArray",idProductoArray);
	datos.append("telefono",telefono);

	
})
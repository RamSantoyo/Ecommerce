/*=============================================
CARGAR LA TABLA DINÁMICA DE SUBCATEGORÍAS
=============================================*/

// $.ajax({

// 	url:"ajax/tablaSubCategorias.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}


// })

var tablaSubCategorias = $('.tablaSubCategorias').DataTable({

	"ajax":"ajax/tablaSubCategorias.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
    "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

});


/*=============================================
ACTIVAR SUBCATEGORÍA
=============================================*/

$('.tablaSubCategorias tbody').on("click", ".btnActivar", function(){

	var idSubCategoria = $(this).attr("idSubCategoria");
	var estadoSubCategoria = $(this).attr("estadoSubCategoria");

	var datos = new FormData();
 	datos.append("activarId", idSubCategoria);
  	datos.append("activarSubCategoria", estadoSubCategoria);

  	$.ajax({

	  url:"ajax/subCategorias.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){    
          // console.log("respuesta", respuesta);

      }

  	})

  	if(estadoSubCategoria == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoSubCategoria',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoSubCategoria',0);

  	}

})


/*=============================================
REVISAR SI LA SUBCATEGORÍA YA EXISTE
=============================================*/

$(".validarSubCategoria").change(function(){

	$(".alert").remove();

	var subCategoria = $(this).val();

	var datos = new FormData();
	datos.append("validarSubCategoria", subCategoria);

	 $.ajax({
	    url:"ajax/subCategorias.ajax.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	// console.log("respuesta", respuesta);
	    	
	    	if(respuesta.length != 0){

	    		$(".validarSubCategoria").parent().after('<div class="alert alert-warning">Esta Subcategoría ya existe en la base de datos</div>');

	    		$(".validarSubCategoria").val("");

	    	}

	    }

	})
})

/*=============================================
RUTA SUBCATEGORÍA
=============================================*/

function limpiarUrl(texto){
      var texto = texto.toLowerCase(); 
      texto = texto.replace(/[á]/, 'a');
      texto = texto.replace(/[é]/, 'e');
      texto = texto.replace(/[í]/, 'i');
      texto = texto.replace(/[ó]/, 'o');
      texto = texto.replace(/[ú]/, 'u');
      texto = texto.replace(/[ñ]/, 'n');
      texto = texto.replace(/ /g, "-")
      return texto;
   }

$(".tituloSubCategoria").change(function(){

	$(".rutaSubCategoria").val(

		limpiarUrl($(".tituloSubCategoria").val())

	);

})

/*=============================================
SUBIENDO LA FOTO DE PORTADA
=============================================*/

$(".fotoPortada").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaFotoPortada").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".fotoPortada").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarPortada").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
ACTIVAR OFERTA
=============================================*/

function activarOferta(event){

	if(event == "oferta"){

		$(".datosOferta").show();
		$(".valorOferta").prop("required",true);
		$(".valorOferta").val("");



	}else{

		$(".datosOferta").hide();
		$(".valorOferta").prop("required",false);
		$(".valorOferta").val("");

	}
}


$(".selActivarOferta").change(function(){

	activarOferta($(this).val())

})

/*=============================================
VALOR OFERTA
=============================================*/
$(".valorOferta").change(function(){

	if($(this).attr("id") == "precioOferta"){

		$("#precioOferta").prop("readonly",true);
		$("#descuentoOferta").prop("readonly",false);
		$("#descuentoOferta").val(0);

	}

	if($(this).attr("id") == "descuentoOferta"){

		$("#descuentoOferta").prop("readonly",true);
		$("#precioOferta").prop("readonly",false);
		$("#precioOferta").val(0);

	}


})

/*=============================================
SUBIENDO LA FOTO DE LA OFERTA
=============================================*/

$(".fotoOferta").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".fotoOferta").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".fotoOferta").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarOferta").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================
EDITAR SUBCATEGORÍA
=============================================*/

$(".tablaSubCategorias tbody").on("click", ".btnEditarSubCategoria", function(){

	var idSubCategoria = $(this).attr("idSubCategoria");
	
	var datos = new FormData();
	datos.append("idSubCategoria", idSubCategoria);

	$.ajax({

		url:"ajax/subCategorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){
					
			$("#modalEditarSubCategoria .editarIdSubCategoria").val(respuesta[0]["id"]);
			$("#modalEditarSubCategoria .tituloSubCategoria").val(respuesta[0]["subcategoria"]);
			$("#modalEditarSubCategoria .rutaSubCategoria").val(respuesta[0]["ruta"]);

			/*=============================================
			EDITAR NOMBRE SUBCATEGORÍA Y RUTA
			=============================================*/

			$("#modalEditarSubCategoria .tituloSubCategoria").change(function(){

				$("#modalEditarSubCategoria .rutaSubCategoria").val(limpiarUrl($("#modalEditarSubCategoria .tituloSubCategoria").val()));

			})

			/*=============================================
			TRAEMOS LA CATEGORIA
			=============================================*/

			if(respuesta[0]["id_categoria"] != 0){
			
				var datosCategoria = new FormData();
				datosCategoria.append("idCategoria", respuesta[0]["id_categoria"]);
				

				$.ajax({

						url:"ajax/categorias.ajax.php",
						method: "POST",
						data: datosCategoria,
						cache: false,
						contentType: false,
						processData: false,
						dataType: "json",
						success: function(respuesta){

							$("#modalEditarSubCategoria .seleccionarCategoria").val(respuesta["id"]);
							$("#modalEditarSubCategoria .optionEditarCategoria").html(respuesta["categoria"]);
						}

					})

			}else{

				$("#modalEditarSubCategoria .optionEditarCategoria").html("SIN CATEGORÍA");

			}

			/*=============================================
			TRAEMOS DATOS DE CABECERA
			=============================================*/

			var datosCabecera = new FormData();
			datosCabecera.append("ruta", respuesta[0]["ruta"]);

			$.ajax({

					url:"ajax/cabeceras.ajax.php",
					method: "POST",
					data: datosCabecera,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta){
						// console.log("respuesta", respuesta);

						/*=============================================
						CARGAMOS EL ID DE LA CABECERA
						=============================================*/

						$("#modalEditarSubCategoria .editarIdCabecera").val(respuesta["id"]);

						/*=============================================
						CARGAMOS LA DESCRIPCION
						=============================================*/

						$("#modalEditarSubCategoria .descripcionSubCategoria").val(respuesta["descripcion"]);

						/*=============================================
						CARGAMOS LAS PALABRAS CLAVES
						=============================================*/	
						
						if(respuesta["palabrasClaves"] != null){

							$(".editarPalabrasClaves").html('<div class="input-group">'+
	              
	                		'<span class="input-group-addon"><i class="fa fa-key"></i></span>'+ 

							'<input type="text" class="form-control input-lg tagsInput pClavesSubCategoria" value="'+respuesta["palabrasClaves"]+'" data-role="tagsinput" name="pClavesSubCategoria">'+

							'</div>');

							$("#modalEditarSubCategoria .pClavesSubCategoria").tagsinput('items');

							$(".bootstrap-tagsinput").css({"padding":"11px",
							   						   "width":"100%",
 							   						   "border-radius":"1px"})

						}else{

							$(".editarPalabrasClaves").html('<div class="input-group">'+
	              
	                		'<span class="input-group-addon"><i class="fa fa-key"></i></span>'+ 

							'<input type="text" class="form-control input-lg tagsInput pClavesSubCategoria" value="" data-role="tagsinput" name="pClavesSubCategoria">'+

							'</div>');

							$("#modalEditarSubCategoria .pClavesSubCategoria").tagsinput('items');

							$(".bootstrap-tagsinput").css({"padding":"11px",
							   						   "width":"100%",
 							   						   "border-radius":"1px"})

						}

						/*=============================================
						CARGAMOS LA IMAGEN DE PORTADA
						=============================================*/

						$("#modalEditarSubCategoria .previsualizarPortada").attr("src", respuesta["portada"]);
						$("#modalEditarSubCategoria .antiguaFotoPortada").val(respuesta["portada"]);
					}

			});

			/*=============================================
			PREGUNTAMOS SI EXITE OFERTA
			=============================================*/

			if(respuesta[0]["oferta"] != 0){

				$("#modalEditarSubCategoria .selActivarOferta").val("oferta");

				$("#modalEditarSubCategoria .datosOferta").show();
				$("#modalEditarSubCategoria .valorOferta").prop("required",true);

				$("#modalEditarSubCategoria #precioOferta").val(respuesta[0]["precioOferta"]);
				$("#modalEditarSubCategoria #descuentoOferta").val(respuesta[0]["descuentoOferta"]);

				if(respuesta[0]["precioOferta"] != 0){

					$("#modalEditarSubCategoria #precioOferta").prop("readonly",true);
					$("#modalEditarSubCategoria #descuentoOferta").prop("readonly",false);

				}

				if(respuesta[0]["descuentoOferta"] != 0){

					$("#modalEditarSubCategoria #descuentoOferta").prop("readonly",true);
					$("#modalEditarSubCategoria #precioOferta").prop("readonly",false);

				}
	
				$("#modalEditarSubCategoria .previsualizarOferta").attr("src", respuesta[0]["imgOferta"]);

				$("#modalEditarSubCategoria .antiguaFotoOferta").val(respuesta[0]["imgOferta"]);
				
				$("#modalEditarSubCategoria .finOferta").val(respuesta[0]["finOferta"]);						

			}else{

				$("#modalEditarSubCategoria .selActivarOferta").val("");
				$("#modalEditarSubCategoria .datosOferta").hide();
				$("#modalEditarSubCategoria .valorOferta").prop("required",false);
				$("#modalEditarSubCategoria .previsualizarOferta").attr("src", "vistas/img/ofertas/default/default.jpg");
				$("#modalEditarSubCategoria .antiguaFotoOferta").val(respuesta[0]["imgOferta"]);

			}

			/*=============================================
			CREAR NUEVA OFERTA AL EDITAR
			=============================================*/

			$("#modalEditarSubCategoria .selActivarOferta").change(function(){

				activarOferta($(this).val())

			})

			$("#modalEditarSubCategoria .valorOferta").change(function(){

				if($(this).attr("id") == "precioOferta"){

					$("#modalEditarSubCategoria #precioOferta").prop("readonly",true);
					$("#modalEditarSubCategoria #descuentoOferta").prop("readonly",false);
					$("#modalEditarSubCategoria #descuentoOferta").val(0);

				}

				if($(this).attr("id") == "descuentoOferta"){

					$("#modalEditarSubCategoria #descuentoOferta").prop("readonly",true);
					$("#modalEditarSubCategoria #precioOferta").prop("readonly",false);
					$("#modalEditarSubCategoria #precioOferta").val(0);

				}		

			})

		}

	});

})

/*=============================================
ELIMINAR SUBCATEGORÍA
=============================================*/
$(".tablaSubCategorias").on("click", ".btnEliminarSubCategoria", function(){

  var idSubCategoria = $(this).attr("idSubCategoria");
  var imgOferta = $(this).attr("imgOferta");
  var rutaCabecera = $(this).attr("rutaCabecera");
  var imgPortada = $(this).attr("imgPortada");

  swal({
    title: '¿Está seguro de borrar la subcategoría?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar subcategoría!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=subcategorias&idSubCategoria="+idSubCategoria+"&imgOferta="+imgOferta+"&rutaCabecera="+rutaCabecera+"&imgPortada="+imgPortada;

    }

  })

})



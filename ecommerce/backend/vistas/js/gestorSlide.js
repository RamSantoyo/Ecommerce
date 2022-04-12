/*=============================================
AGREGAR SLIDE
=============================================*/

$(".agregarSlide").click(function(){

	var imgFondo = "vistas/img/slide/default/fondo.jpg";
	var tipoSlide = "slideOpcion1";
	var estiloTextoSlide = '{"top":"20","right":"","left":"15","width":"40"}';
	var titulo1 = '{"texto":"Lorem Ipsum","color":"#333"}';
	var titulo2 = '{"texto":"Lorem ipsum dolor sit","color":"#777"}';
	var titulo3 = '{"texto":"Lorem ipsum dolor sit","color":"#888"}';
	var boton = 'VER PRODUCTO';
	var url = '#';

	var datos = new FormData();
	datos.append("crearSlide", "ok");
	datos.append("imgFondo", imgFondo);
	datos.append("tipoSlide", tipoSlide);
	datos.append("estiloTextoSlide", estiloTextoSlide);
	datos.append("titulo1", titulo1);
	datos.append("titulo2", titulo2);
	datos.append("titulo3", titulo3);
	datos.append("boton", boton);
	datos.append("url", url);

	$.ajax({

		url:"ajax/slide.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			
			if(respuesta == "ok"){

				swal({
				  type: "success",
				  title: "El slide ha sido agregado correctamente",
				  showConfirmButton: true,
				  confirmButtonText: "Cerrar"
				  }).then((result) => {
					if (result.value) {

					window.location = "slide";

					}
				})

			}

		}

	})

})

/*=============================================
CAMBIAR EL ORDEN DEL SLIDE
=============================================*/
var itemSlide = $(".itemSlide");

$('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999,
    stop: function(event){

    	for(var i = 0; i < itemSlide.length; i++){

    		var datos = new FormData();
			datos.append("idSlide", event.target.children[i].id);
			datos.append("orden", (i+1));

			$.ajax({

				url:"ajax/slide.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success: function(respuesta){
				
					
							
				}

			})

    	}   

    }

});

/*=============================================
VARIABLES GLOBALES PARA CAMBIOS DEL SLIDE
=============================================*/

var guardarSlide = $(".guardarSlide");
var tipoSlide = $(".tipoSlide");
var tipoSlideIzq = $(".tipoSlideIzq");
var tipoSlideDer = $(".tipoSlideDer");
var slideOpciones = $(".slideOpciones");
var previsualizarFondo = $(".previsualizarFondo");
var previsualizarProducto = $(".previsualizarProducto");
var subirFondo = null;
var subirImgProducto = null;

/*=============================================
ACTUALIZAR NOMBRE SLIDE
=============================================*/

$(".nombreSlide").change(function(){

	var nombre = $(this).val();
	var indiceSlide = $(this).attr("indice");

	$(guardarSlide[indiceSlide]).attr("nombreSlide", nombre);
	

})

/*=============================================
CHECKED PARA EL TIPO DE SLIDE
=============================================*/
for(var i = 0; i < tipoSlide.length; i++){

	if($(tipoSlide[i]).val()=="slideOpcion1"){

		$(tipoSlideIzq[i]).parent().addClass("checked");

	}else{

		$(tipoSlideDer[i]).parent().addClass("checked");

	}

}

/*=============================================
CAMBIO DE TIPO DE SLIDE
=============================================*/

for(var i = 0; i < tipoSlide.length; i++){

	$("input[name='tipoSlide"+i+"']").on("ifChecked",function(){

		var tipoSlide = $(this).val();
		var indiceSlide = $(this).attr("indice");
		var slide = $(".slide");
		var posHorizontal = $(".posHorizontal");
		var posHorizontalTexto = $(".posHorizontalTexto");

		$(posHorizontal[indiceSlide]).attr("tipoSlide", tipoSlide);
		$(posHorizontalTexto[indiceSlide]).attr("tipoSlide", tipoSlide);

		$(slideOpciones[indiceSlide]).addClass(tipoSlide);

		var anchoSlide = $(slide[indiceSlide]).css("width").replace(/px/, " ");
		
		if(tipoSlide == "slideOpcion1"){

			// ORGANIZAR IMAGEN PRODUCTO

			var posHImagen = $(slideOpciones[indiceSlide]).children("img").css("left").replace(/px/, " ");
			
			var nuevaPosHImagen = posHImagen*100/anchoSlide;
			
			$(slideOpciones[indiceSlide]).children("img").css({"left": "", "right": nuevaPosHImagen+"%"})

			$(guardarSlide[indiceSlide]).attr("estiloImgProductoLeft", "");
			$(guardarSlide[indiceSlide]).attr("estiloImgProductoRight", nuevaPosHImagen);

			// ORGANIZAR TEXTO SLIDE 

			var posHTexto = $(slideOpciones[indiceSlide]).children('.textosSlide').css("right").replace(/px/, " ");
			
			var nuevaPosHTexto = posHTexto*100/anchoSlide;

			$(slideOpciones[indiceSlide]).children(".textosSlide").css({"left": nuevaPosHTexto + "%" , "right": "", "text-align": "left"})

			$(guardarSlide[indiceSlide]).attr("estiloTextoSlideRight", "");
			$(guardarSlide[indiceSlide]).attr("estiloTextoSlideLeft", nuevaPosHTexto);	


		}else{

			// ORGANIZAR IMAGEN PRODUCTO

			var posHImagen = $(slideOpciones[indiceSlide]).children("img").css("right").replace(/px/, " ");
			
			var nuevaPosHImagen = posHImagen*100/anchoSlide;

			$(slideOpciones[indiceSlide]).children("img").css({"left": nuevaPosHImagen+"%", "right": ""})

			$(guardarSlide[indiceSlide]).attr("estiloImgProductoRight", "");
			$(guardarSlide[indiceSlide]).attr("estiloImgProductoLeft", nuevaPosHImagen);

			// ORGANIZAR TEXTO SLIDE 

			var posHTexto = $(slideOpciones[indiceSlide]).children('.textosSlide').css("left").replace(/px/, " ");
			
			var nuevaPosHTexto = posHTexto*100/anchoSlide;

			$(slideOpciones[indiceSlide]).children(".textosSlide").css({"left": "", "right": nuevaPosHTexto+"%", "text-align": "right"})

			$(guardarSlide[indiceSlide]).attr("estiloTextoSlideLeft", "");
			$(guardarSlide[indiceSlide]).attr("estiloTextoSlideRight", nuevaPosHTexto);

		}

		$(guardarSlide[indiceSlide]).attr("tipoSlide", tipoSlide);

	})


}

/*=============================================
CAMBIO DE FONDO
=============================================*/
$(".subirFondo").change(function(){

	var imagenFondo = this.files[0];

	var indiceSlide = $(this).attr("indice");

	/*=============================================
	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
	=============================================*/

	if(imagenFondo["type"] != "image/jpeg" && imagenFondo["type"] != "image/png"){

		$(".subirFondo").val("");

		 swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen debe estar en formato JPG o PNG!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	}else if(imagenFondo["size"] > 2000000){

		$(".subirFondo").val("");

		 swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen no debe pesar más de 2MB!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	}else{

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagenFondo);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;
			$(previsualizarFondo[indiceSlide]).attr("src", rutaImagen);
			$(slideOpciones[indiceSlide]).parent().children('.cambiarFondo').attr("src", rutaImagen);
			$(guardarSlide[indiceSlide]).attr("imgFondo", "");

		})



	}

})

/*=============================================
CAMBIO DE IMAGEN PRODUCTO
=============================================*/

$(".subirImgProducto").change(function(){

	var imagenProducto = this.files[0];
	var indiceSlide = $(this).attr("indice");

	/*=============================================
	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
	=============================================*/

	if(imagenProducto["type"] != "image/jpeg" && imagenProducto["type"] != "image/png"){

		$("#subirLogo").val("");

		 swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen debe estar en formato JPG o PNG!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	}else if(imagenProducto["size"] > 2000000){

		$("#subirLogo").val("");

		 swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen no debe pesar más de 2MB!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	}else{

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagenProducto);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;

			$(previsualizarProducto[indiceSlide]).attr("src", rutaImagen);
			
			$(slideOpciones[indiceSlide]).children('.imgProducto').attr("src", rutaImagen);
			
			$(slideOpciones[indiceSlide]).children('.imgProducto').css({"top":"15%","right":"10%","left":"","width":"30%"});

			$(guardarSlide[indiceSlide]).attr("estiloImgProductoRight", "10");
			$(guardarSlide[indiceSlide]).attr("estiloImgProductoLeft", "");
			$(guardarSlide[indiceSlide]).attr("estiloImgProductoTop", "15");
			$(guardarSlide[indiceSlide]).attr("estiloImgProductoWidth", "30");

			$(guardarSlide[indiceSlide]).attr("imgProducto", "");

		})

	}

});

/*=============================================
CAMBIAR TEXTO Y COLOR SLIDE
=============================================*/

// TEXTO Y COLOR 1

$(".cambioTituloTexto1").change(function(){

	var indiceSlide = $(this).attr("indice");
	var texto1 = $(this).val();

	$(slideOpciones[indiceSlide]).children('.textosSlide').children("h1").html(texto1);

	$(guardarSlide[indiceSlide]).attr("titulo1Texto", texto1);

})

$(".cambioColorTexto1").change(function(){

	var indiceSlide = $(this).attr("indice");
	var color1 = $(this).val();

	$(slideOpciones[indiceSlide]).children('.textosSlide').children("h1").css({"color":color1});
	
	$(guardarSlide[indiceSlide]).attr("titulo1Color", color1);

})

// TEXTO Y COLOR 2

$(".cambioTituloTexto2").change(function(){

	var indiceSlide = $(this).attr("indice");
	var texto2 = $(this).val();

	$(slideOpciones[indiceSlide]).children('.textosSlide').children("h2").html(texto2);

	$(guardarSlide[indiceSlide]).attr("titulo2Texto", texto2);

})

$(".cambioColorTexto2").change(function(){

	var indiceSlide = $(this).attr("indice");
	var color2 = $(this).val();

	$(slideOpciones[indiceSlide]).children('.textosSlide').children("h2").css({"color":color2});
	
	$(guardarSlide[indiceSlide]).attr("titulo2Color", color2);

})

// TEXTO Y COLOR 3

$(".cambioTituloTexto3").change(function(){

	var indiceSlide = $(this).attr("indice");
	var texto3 = $(this).val();

	$(slideOpciones[indiceSlide]).children('.textosSlide').children("h3").html(texto3);

	$(guardarSlide[indiceSlide]).attr("titulo3Texto", texto3);

})

$(".cambioColorTexto3").change(function(){

	var indiceSlide = $(this).attr("indice");
	var color3 = $(this).val();

	$(slideOpciones[indiceSlide]).children('.textosSlide').children("h3").css({"color":color3});
	
	$(guardarSlide[indiceSlide]).attr("titulo3Color", color3);

})

/*=============================================
CAMBIAR POSICIÓN IMAGEN PRODUCTO SLIDE
=============================================*/

for(var i = 0; i < slideOpciones.length; i++){

	// VERTICAL

	var posVertical = new Slider('.posVertical'+i, {
		
		formatter: function(value) {

			$(".posVertical").change(function(){

				var indiceSlide = $(this).attr("indice");	

				$(slideOpciones[indiceSlide]).children('img').css({"top":value+"%"});

				$(guardarSlide[indiceSlide]).attr("estiloImgProductoTop", value);

			})

			return value;	
			
					
		}

	})

	// HORIZONTAL

	var posHorizontal = new Slider('.posHorizontal'+i, {

		formatter: function(value) {

			$(".posHorizontal").change(function(){

				var tipoSlide = $(this).attr("tipoSlide");
				var indiceSlide = $(this).attr("indice");

				if(tipoSlide == "slideOpcion1"){

					$(slideOpciones[indiceSlide]).children('img').css({"right":value+"%"});

					$(guardarSlide[indiceSlide]).attr("estiloImgProductoRight", value);
					$(guardarSlide[indiceSlide]).attr("estiloImgProductoLeft", "");			

				}else{

					$(slideOpciones[indiceSlide]).children('img').css({"left":value+"%"});

					$(guardarSlide[indiceSlide]).attr("estiloImgProductoLeft", value);
					$(guardarSlide[indiceSlide]).attr("estiloImgProductoRight", "");

				}

			})

			return value;	
			
		}

	})

	// ANCHO

	var anchoImagen = new Slider('.anchoImagen'+i, {

		formatter: function(value) {

			$(".anchoImagen").change(function(){

				var indiceSlide = $(this).attr("indice");
				
				$(slideOpciones[indiceSlide]).children('img').css({"width":value+"%"});

				$(guardarSlide[indiceSlide]).attr("estiloImgProductoWidth", value);

			})

			return value;	
			
		}

	})

	/*=============================================
	CAMBIAR POSICIÓN TEXTO
	=============================================*/

	// VERTICAL

	var posVerticalTexto = new Slider('.posVerticalTexto'+i, {
		
		formatter: function(value) {

			$(".posVerticalTexto").change(function(){

				var indiceSlide = $(this).attr("indice");	

				$(slideOpciones[indiceSlide]).children('.textosSlide').css({"top":value+"%"});

				$(guardarSlide[indiceSlide]).attr("estiloTextoSlideTop", value);

			})
			
			return value;	
								
		}

	})

	// HORIZONTAL

	var posHorizontalTexto = new Slider('.posHorizontalTexto'+i, {

		formatter: function(value) {

			$(".posHorizontalTexto").change(function(){

				var tipoSlide = $(this).attr("tipoSlide");
				var indiceSlide = $(this).attr("indice");

				if(tipoSlide == "slideOpcion1"){

					$(slideOpciones[indiceSlide]).children('.textosSlide').css({"left":value+"%"});

					$(guardarSlide[indiceSlide]).attr("estiloTextoSlideLeft", value);
					$(guardarSlide[indiceSlide]).attr("estiloTextoSlideRight", "");			

				}else{

					$(slideOpciones[indiceSlide]).children('.textosSlide').css({"right":value+"%"});

					$(guardarSlide[indiceSlide]).attr("estiloTextoSlideRight", value);
					$(guardarSlide[indiceSlide]).attr("estiloTextoSlideLeft", "");

				}

			})

			return value;	
			
		}

	})

	// ANCHO

	var anchoImagenTexto = new Slider('.anchoTexto'+i, {

		formatter: function(value) {

			$(".anchoTexto").change(function(){

				var indiceSlide = $(this).attr("indice");
				
				$(slideOpciones[indiceSlide]).children('.textosSlide').css({"width":value+"%"});

				$(guardarSlide[indiceSlide]).attr("estiloTextoSlideWidth", value);

			})

			return value;	
			
		}

	})

}

/*=============================================
CAMBIO DE BOTÓN
=============================================*/

$(".botonSlide").change(function(){

	var textoBoton = $(this).val();
	var indiceSlide = $(this).attr("indice");

	$(slideOpciones[indiceSlide]).children('.textosSlide').children("a").children("button").remove();

	$(slideOpciones[indiceSlide]).children('.textosSlide').append('<a href="">'+

				                            					  '<button class="btn btn-default backColor text-uppercase">'+

				                         						  textoBoton+'<span class="fa fa-chevron-right"></span>'+

			                            						  '</button>'+

			                          							  '</a>');

	$(guardarSlide[indiceSlide]).attr("boton", textoBoton);	

})

/*=============================================
CAMBIO DE URL BOTÓN
=============================================*/

$(".urlSlide").change(function(){

	var urlBoton = $(this).val();
	var indiceSlide = $(this).attr("indice");
	var botonSlide = $(".botonSlide");

	if($(botonSlide[indiceSlide]).val() == ""){

		$(".urlSlide").val("");

		 swal({
	      title: "Error al poner la URL",
	      text: "¡Debe escribir primero el texto del botón!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });		

	}else{	

		$(slideOpciones[indiceSlide]).children('.textosSlide').children("a").attr("href", urlBoton);
	
		$(guardarSlide[indiceSlide]).attr("url", urlBoton);	
	}

})

/*=============================================
GUARDAR SLIDE
=============================================*/

$(".guardarSlide").click(function(){

	var id = $(this).attr("id");
	var indiceSlide = $(this).attr("indice");
	var nombre = $(this).attr("nombreSlide");
	var tipoSlide = $(this).attr("tipoSlide");

	var estiloImgProductoTop = $(this).attr("estiloImgProductoTop");
    var estiloImgProductoRight = $(this).attr("estiloImgProductoRight"); 
    var estiloImgProductoLeft = $(this).attr("estiloImgProductoLeft");
    var estiloImgProductoWidth = $(this).attr("estiloImgProductoWidth"); 

    var estiloImgProducto = {"top": estiloImgProductoTop,
							"right": estiloImgProductoRight,
							"left": estiloImgProductoLeft,
							"width": estiloImgProductoWidth};

	var estiloTextoSlideTop = $(this).attr("estiloTextoSlideTop");
    var estiloTextoSlideRight = $(this).attr("estiloTextoSlideRight");
    var estiloTextoSlideLeft = $(this).attr("estiloTextoSlideLeft");
    var estiloTextoSlideWidth = $(this).attr("estiloTextoSlideWidth");

    var estiloTextoSlide = {"top": estiloTextoSlideTop,
						   "right": estiloTextoSlideRight,
						   "left": estiloTextoSlideLeft,
						   "width": estiloTextoSlideWidth};

	// CAPTURAMOS EL CAMBIO DE FONDO

	var imgFondo = $(this).attr("imgFondo");

	if(imgFondo == ""){

		subirFondo = $(".subirFondo");
		imgFondo = $(this).attr("rutaImgFondo");

	}

	// CAPTURAMOS EL CAMBIO DE IMAGEN DEL PRODUCTO

	var imgProducto = $(this).attr("imgProducto");

	if(imgProducto == ""){

		subirImgProducto = $(".subirImgProducto");
		imgProducto = $(this).attr("rutaImgProducto");
		
	}

	// CAPTURAMOS EL TÍTULO 1

	var titulo1Texto = $(this).attr("titulo1Texto");
    var titulo1Color = $(this).attr("titulo1Color");

    var titulo1 = {"texto": titulo1Texto,
			       "color": titulo1Color};

   // CAPTURAMOS EL TÍTULO 2

	var titulo2Texto = $(this).attr("titulo2Texto");
    var titulo2Color = $(this).attr("titulo2Color");

    var titulo2 = {"texto": titulo2Texto,
			       "color": titulo2Color};

	// CAPTURAMOS EL TÍTULO 3

	var titulo3Texto = $(this).attr("titulo3Texto");
    var titulo3Color = $(this).attr("titulo3Color");

    var titulo3 = {"texto": titulo3Texto,
			       "color": titulo3Color};
	
	var boton = $(this).attr("boton");
	var url = $(this).attr("url");

	/*=============================================
	AJAX
	=============================================*/

	var datos = new FormData();
	datos.append("id", id);
	datos.append("nombre", nombre);
	datos.append("tipoSlide", tipoSlide);
	datos.append("estiloImgProducto", JSON.stringify(estiloImgProducto));
	datos.append("estiloTextoSlide", JSON.stringify(estiloTextoSlide));

	// ENVIAMOS EL CAMBIO DE FONDO

	datos.append("imgFondo", imgFondo);

	if(subirFondo != null){

		datos.append("subirFondo", subirFondo[indiceSlide].files[0]);

	}else{

		datos.append("subirFondo", subirFondo);
	}

	// ENVIAMOS EL CAMBIO DE IMAGEN PRODUCTO

	datos.append("imgProducto", imgProducto);

	if(subirImgProducto != null){
		
	
		datos.append("subirImgProducto", subirImgProducto[indiceSlide].files[0]);

	}else{

		datos.append("subirImgProducto", subirImgProducto);

	}

	// ENVIAMOS EL CAMBIO DE TÍTULO 1

	datos.append("titulo1", JSON.stringify(titulo1));

	// ENVIAMOS EL CAMBIO DE TÍTULO 2

	datos.append("titulo2", JSON.stringify(titulo2));

	// ENVIAMOS EL CAMBIO DE TÍTULO 3

	datos.append("titulo3", JSON.stringify(titulo3));

	datos.append("boton", boton);
	datos.append("url", url);

	$.ajax({

		url:"ajax/slide.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
					
			if(respuesta == "ok"){

				swal({
				  type: "success",
				  title: "El slide ha sido cambiado correctamente",
				  showConfirmButton: true,
				  confirmButtonText: "Cerrar"
				  }).then((result) => {
					if (result.value) {

					window.location = "slide";

					}
				})
			}

		}

	})

})

/*=============================================
ELIMINAR SLIDE
=============================================*/

$(".eliminarSlide").click(function(){

	var idSlide = $(this).attr("id");
	var imgFondo = $(this).attr("imgFondo");
	var imgProducto = $(this).attr("imgProducto");

	swal({

		title: '¿Está seguro de borrar el slide?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar slide!'
        }).then((result) => {
        if (result.value) {

        	window.location = "index.php?ruta=slide&idSlide="+idSlide+"&imgFondo="+imgFondo+"&imgProducto="+imgProducto;

        }


	})


})

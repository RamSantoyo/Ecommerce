/*=============================================
PLANTILLA
=============================================*/

var rutaOculta = $("#rutaOculta").val();

// Herramienta TOOLTIP
$('[data-toggle="tooltip"]').tooltip(); 

$.ajax({

	url:rutaOculta+"ajax/plantilla.ajax.php",
	success:function(respuesta){

		var colorFondo = JSON.parse(respuesta).colorFondo;
		var colorTexto = JSON.parse(respuesta).colorTexto;
		var barraSuperior = JSON.parse(respuesta).barraSuperior;
		var textoSuperior = JSON.parse(respuesta).textoSuperior;
		
		$(".backColor, .backColor a").css({"background": colorFondo,
											"color": colorTexto})

		$(".barraSuperior, .barraSuperior a").css({"background": barraSuperior, 
			                                       "color": textoSuperior})

	}

})

/*=============================================
CUADRÍCULA O LISTA
=============================================*/

var btnList = $(".btnList");

for(var i = 0; i < btnList.length; i++){

	$("#btnGrid"+i).click(function(){

		var numero = $(this).attr("id").substr(-1);

		$(".list"+numero).hide();
		$(".grid"+numero).show();

		$("#btnGrid"+numero).addClass("backColor");
		$("#btnList"+numero).removeClass("backColor");

	})

	$("#btnList"+i).click(function(){

		var numero = $(this).attr("id").substr(-1);

		$(".list"+numero).show();
		$(".grid"+numero).hide();

		$("#btnGrid"+numero).removeClass("backColor");
		$("#btnList"+numero).addClass("backColor");

	})

}

/*=============================================
EFECTOS CON EL SCROLL
=============================================*/

$(window).scroll(function(){

	var scrollY = window.pageYOffset;

	if(window.matchMedia("(min-width:768px)").matches){

		if($(".banner").html() != null){

			if(scrollY < ($(".banner").offset().top)-150){

				$(".banner img").css({"margin-top":-scrollY/3+"px"})

			}else{

				scrollY = 0;
			}

		}

	}	
	
})

$.scrollUp({

	scrollText:"",
	scrollSpeed: 2000,
	easingType: "easeOutQuint"

});

/*=============================================
MIGAS DE PAN
=============================================*/

var pagActiva = $(".pagActiva").html();

if(pagActiva != null){

	var regPagActiva = pagActiva.replace(/-/g, " ");

	$(".pagActiva").html(regPagActiva);

}

/*=============================================
ENLACES PAGINACIÓN
=============================================*/

var url = window.location.href;

var indice = url.split("/");

var pagActual = indice[5];
console.log("pagActual", pagActual);

if(isNaN(pagActual)){

	$("#item1").addClass("active");

}else{
	
	$("#item"+pagActual).addClass("active");	
}


/*=============================================
OFERTAS
=============================================*/
$(".cerrarOfertas").click(function(){

	$(this).parent().remove();

})

/*=============================================
CONTADOR DE TIEMPO
=============================================*/

var finOferta = $(".countdown");
var fechaFinOferta = [];

for(var i = 0; i < finOferta.length; i++){

	fechaFinOferta[i] = $(finOferta[i]).attr("finOferta");

	$(finOferta[i]).dsCountDown({

	endDate: new Date(fechaFinOferta[i]),

	theme: 'flat', 

	titleDays: 'Días', 

	titleHours: 'Horas', 

	titleMinutes: 'Minutos', 

	titleSeconds: 'Segundos' 


	});


}


/*=============================================
EVENTOS PIXEL DE FACEBOOK
=============================================*/

$(".pixelCategorias").click(function(){

	var titulo = $(this).attr("titulo");

	fbq('track', 'Categoria '+titulo, {

		title: titulo

	})

})

$(".pixelSubCategorias").click(function(){

	var titulo = $(this).attr("titulo");

	fbq('track', 'Subcategoria '+titulo, {

		title: titulo

	})

})


$(".pixelOferta").click(function(){

	var titulo = $(this).attr("titulo");

	fbq('track', 'Oferta '+titulo, {

		title: titulo

	})

})










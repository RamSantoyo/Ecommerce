/* iCheck */
$('input').iCheck({
	checkboxClass: 'icheckbox_square-blue',
	radioClass: 'iradio_square-blue',
	increaseArea: '20%' // optional
});

/* jQueryKnob */
$('.knob').knob();

/* SideBar Menu */
$('.sidebar-menu').tree();

//Colorpicker
$('.my-colorpicker').colorpicker();

//Tags Input
$(".tagsInput").tagsinput({
	maxTags: 10,
	confirmKeys: [44],
	cancelConfirmKeysOnEmpty: false,
 	trimValue: false
})

$(".bootstrap-tagsinput").css({"padding":"11px",
							   "width":"100%",
 							   "border-radius":"1px"})

//Datepicker	
$('.datepicker').datepicker({
	format: 'yyyy-mm-dd 23:59:59',
	startDate: '0d'
});

/*=============================================
CORRECCIÓN BOTONERAS OCULTAS BACKEND	
=============================================*/

if(window.matchMedia("(max-width:767px)").matches){
	
	$("body").removeClass('sidebar-collapse');

}else{

	$("body").addClass('sidebar-collapse');
}

/*=============================================
ACTIVAR SIDEBAR
=============================================*/

$(document).on("click", ".sidebar-menu li", function(){

	localStorage.setItem("botonera", $(this).children().attr("href"));

})

if(localStorage.getItem("botonera") == null){

	$(".sidebar-menu li").removeClass("active");

	$(".sidebar-menu li a[href='inicio']").parent().addClass("active")
	
}else{

	$(".sidebar-menu li").removeClass("active");

	$("a[href='"+localStorage.getItem("botonera")+"']").parent().addClass("active")
	
}

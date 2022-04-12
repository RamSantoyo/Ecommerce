/*=============================================
CABEZOTE
=============================================*/

$("#btnCategorias").click(function(){

	if(window.matchMedia("(max-width:767px)").matches){

		$("#btnCategorias").after($("#categorias").slideToggle("slow"))

	}else{

		$("#cabezote").after($("#categorias").slideToggle("fast"))
		
	}
		
}) 

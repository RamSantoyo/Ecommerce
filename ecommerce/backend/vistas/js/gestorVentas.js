/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url:"ajax/tablaVentas.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

$(".tablaVentas").DataTable({
	 "ajax": "ajax/tablaVentas.ajax.php",
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
PROCESO DE ENVÍO
=============================================*/


$(".tablaVentas tbody").on("click", ".btnEnvio", function(){


	var idVenta = $(this).attr("idVenta");
	var etapa = $(this).attr("etapa");

	var datos = new FormData();
 	datos.append("idVenta", idVenta);
  	datos.append("etapa", etapa);

  		$.ajax({

  		 url:"ajax/ventas.ajax.php",
  		 method: "POST",
	  	data: datos,
	  	cache: false,
      	contentType: false,
      	processData: false,
      	success: function(respuesta){ 
      	    
      	  console.log("respuesta", respuesta);

      	} 	 

  	});

  	if(etapa == 1){
	
  		$(this).addClass('btn-warning');
  		$(this).removeClass('btn-danger');
  		$(this).html('Enviando el producto');
  		$(this).attr('etapa', 2);

  	}

	if(etapa == 2){
	
  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-warning');
  		$(this).html('Producto entregado');
	
  	}
  	

})
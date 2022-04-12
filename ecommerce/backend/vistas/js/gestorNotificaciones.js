/*=============================================
ACTUALIZAR NOTIFICACIONES
=============================================*/

$(".actualizarNotificaciones").click(function(e){

	e.preventDefault();

	var item = $(this).attr("item");

	var datos = new FormData();
 	datos.append("item", item );

  	$.ajax({

  		 url:"ajax/notificaciones.ajax.php",
  		 method: "POST",
	  	data: datos,
	  	cache: false,
      	contentType: false,
      	processData: false,
      	success: function(respuesta){

  		  	if(respuesta == "ok"){

      	    	if(item == "nuevosUsuarios"){

      	    		window.location = "usuarios";
      	    	}

      	    	if(item == "nuevasVentas"){

      	    		window.location = "ventas";
      	    	}

      	    	if(item == "nuevasVisitas"){

      	    		window.location = "visitas";
      	    	}

      	    }

      	 }

  	})
})
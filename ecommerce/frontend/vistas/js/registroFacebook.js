/*=============================================
BOTÓN FACEBOOK
=============================================*/

$(".facebook").click(function(){

	FB.login(function(response){

		validarUsuario();

	}, {scope: 'public_profile, email'})

})

/*=============================================
VALIDAR EL INGRESO
=============================================*/

function validarUsuario(){

	FB.getLoginStatus(function(response){

		statusChangeCallback(response);

	})

}

/*=============================================
VALIDAMOS EL CAMBIO DE ESTADO EN FACEBOOK
=============================================*/

function statusChangeCallback(response){

	if(response.status === 'connected'){

		testApi();

	}else{

		swal({
          title: "¡ERROR!",
          text: "¡Ocurrió un error al ingresar con Facebook, vuelve a intentarlo!",
          type: "error",
          confirmButtonText: "Cerrar",
          closeOnConfirm: false
      	},

      	function(isConfirm){
           	if (isConfirm) {    
              	window.location = localStorage.getItem("rutaActual");
            } 
      	});

	}

}

/*=============================================
INGRESAMOS A LA API DE FACEBOOK
=============================================*/

function testApi(){

	FB.api('/me?fields=id,name,email,picture',function(response){

		if(response.email == null){

			swal({
	          title: "¡ERROR!",
	          text: "¡Para poder ingresar al sistema debe proporcionar la información del correo electrónico!",
	          type: "error",
	          confirmButtonText: "Cerrar",
	          closeOnConfirm: false
	      	},

	      	function(isConfirm){
	           	if (isConfirm) {    
	              	window.location = localStorage.getItem("rutaActual");
	            } 
	      	});

		}else{

			var email = response.email;
			var nombre = response.name;
			var foto = "http://graph.facebook.com/"+response.id+"/picture?type=large";

			var datos = new FormData();
			datos.append("email", email);
			datos.append("nombre",nombre);
			datos.append("foto",foto);

			$.ajax({

				url:rutaOculta+"ajax/usuarios.ajax.php",
				method:"POST",
				data:datos,
				cache:false,
				contentType:false,
				processData:false,
				success:function(respuesta){
					
					if(respuesta == "ok"){

						window.location = localStorage.getItem("rutaActual");
					
					}else{

						swal({
				          title: "¡ERROR!",
				          text: "¡El correo electrónico "+email+" ya está registrado con un método diferente a Facebook!",
				          type: "error",
				          confirmButtonText: "Cerrar",
				          closeOnConfirm: false
				      	},

				      	function(isConfirm){
				           	if (isConfirm) {    
				              
			           		 FB.getLoginStatus(function(response){

			           		 	 if(response.status === 'connected'){     

			           		 	 	FB.logout(function(response){

			           		 	 		deleteCookie("fblo_142241770527446");

			           		 	 		setTimeout(function(){

			           		 	 			window.location=rutaOculta+"salir";

			           		 	 		},500)

			           		 	 	});

			           		 	 	function deleteCookie(name){

			           		 	 		 document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';

			           		 	 	}

			           		 	 }

			           		 })

				            } 
				      	});

					}

				}

			})

		}

	})


/*=============================================
SALIR DE FACEBOOK
=============================================*/

$(".salir").click(function(e){

	e.preventDefault();

	 FB.getLoginStatus(function(response){

	 	 if(response.status === 'connected'){     
	 	 
	 	 	FB.logout(function(response){

	 	 		deleteCookie("fblo_142241770527446");

	 	 		console.log("salir");

	 	 		setTimeout(function(){

	 	 			window.location=rutaOculta+"salir";

	 	 		},500)

	 	 	});

	 	 	function deleteCookie(name){

	 	 		 document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';

	 	 	}

	 	 }

	 })

})

}


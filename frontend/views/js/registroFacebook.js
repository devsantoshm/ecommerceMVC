$(".facebook").click(function(){
	FB.login(function(response){
		validarUsuario();
	}, {scope: 'public_profile, email'})
})

function validarUsuario(){
	FB.getLoginStatus(function(response){
		statusChangeCallback(response);
	})
}

function statusChangeCallback(response){
	if (response.status === 'connected') {
		testApi();	
	} else {
		swal({
			  title:"¡ERROR!",
			  text: "¡Ocurrio un error al ingresar con Facebook, vuelva a intentarlo!",
			  type: "error",
			  confirmButtonText: "Cerrar",
			  closeOnConfirm: false
			},
			function(isConfirm){
				if(isConfirm){
					window.location = localStorage.getItem("rutaActual");
				}
			}
		);
	}
}

function testApi(){
	FB.api('/me?fields=id,name,email,picture', function(response){
		if (response.email == null) { // si no comparte su correo electrónico
			swal({
			  title:"¡ERROR!",
			  text: "¡Para poder ingresar al sistema debe proporcionar su correo electrónico!",
			  type: "error",
			  confirmButtonText: "Cerrar",
			  closeOnConfirm: false
			},
			function(isConfirm){
				if(isConfirm){
					window.location = localStorage.getItem("rutaActual");
				}
			}
		);
		} else {
			var email = response.email;
			console.log("email", email);
			var nombre = response.name;
			var foto = "http://graph.facebook.com/"+response.id+"/picture?type=large";
			var datos = new FormData();
			datos.append("email", email)
			datos.append("nombre", nombre)
			datos.append("foto", foto)

			$.ajax({
				url: rutaFron+"ajax/AjaxUser.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response){
					
				}
			})
		}
	})
}
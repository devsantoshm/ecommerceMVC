
var rutaActual = location.href;

$(".btnIngreso, .facebook, .google").click(function(){
	localStorage.setItem("rutaActual", rutaActual);
})

$("input").focus(function(){
	$(".alert").remove()
})

var validerEmailRepetido = false;

$("#regEmail").change(function(){

	var email = $("#regEmail").val();
	var datos = new FormData();
	datos.append("validarEmail", email);

	$.ajax({
		url: rutaFron+"ajax/AjaxUser.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(response){
			//console.log("resp", response)
			if (response == "false") {
				
				$(".alert").remove();
				validerEmailRepetido = false

			} else {
				
				var modo = JSON.parse(response).modo;	
				if (modo == "directo") {
					modo = "esta página";
				}

				$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> El correo electrónico ya existe, fue registrado en '+modo+'</div>')

				validerEmailRepetido = true
			}
		}
	})
})

function registroUsuario(){

	$(".alert").remove();

	var nombre = $("#regUsuario").val()
	
	if (nombre != "") {
		var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]*$/;
		if (!expresion.test(nombre)) {
			$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten números ni caracteres especiales</div>')
			return false;
		}
	} else {
		$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
			return false;
	}

	var email = $("#regEmail").val()
	
	if (email != "") {
		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
		if (!expresion.test(email)) {
			$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Escrib correctamente el correo electrónico</div>')
			return false;
		}

		if (validerEmailRepetido) {
			$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> El correo electrónico ya existe</div>')
			return false;
		}
	} else {
		$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
			return false;
	}

	var password = $("#regPassword").val()
	
	if (password != "") {
		var expresion = /^[a-zA-Z0-9]*$/;
		if (!expresion.test(password)) {
			$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>')
			return false;
		}
	} else {
		$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Este campo es obligatorio</div>')
			return false;
	}

	var politicas = $("#regPoliticas:checked").val()
	
	if (politicas != "on") {
		$("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Debe aceptar nuestras condiciones de uso y políticas de privacidad</div>')
		return false;
	}

	return true;
}

$("#btnCambiarFoto").click(function(){
	$("#imgPerfil").toggle();
	$("#subirImagen").toggle();
})

$("#datosImagen").change(function(){
	var imagen = this.files[0];
	//console.log("imagen", imagen)
	if (imagen["type"] != "image/jpeg") {
		$("#datosImagen").val("");
		swal({
			  title:"Error al subir la imagen",
			  text: "¡La imagen debe estas en formato JPG!",
			  type: "error",
			  confirmButtonText: "Cerrar",
			  closeOnConfirm: false
			},
			function(isConfirm){
				if(isConfirm){
					window.location = rutaFron+"perfil"
				}
			}
		);		
	} else if (Number(imagen["size"]) > 2000000) {//mayor a 2mb
		
		$("#datosImagen").val("");
		swal({
			  title:"Error al subir la imagen",
			  text: "¡La imagen no debe pasar más de 2 MB!",
			  type: "error",
			  confirmButtonText: "Cerrar",
			  closeOnConfirm: false
			},
			function(isConfirm){
				if(isConfirm){
					window.location = rutaFron+"perfil"
				}
			}
		);		
	} else {
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen)

		$(datosImagen).on("load", function(event){
			var rutaImagen = event.target.result
			$(".previsualizar").attr("src", rutaImagen)
		})
	}

})

$(".calificarProducto").click(function(){
	var idComentario = $(this).attr("idComentario")
	$("#idComentario").val(idComentario)
})

$("input[name='puntaje']").change(function(){
	var puntaje = $(this).val()

	switch(puntaje){
		case "0.5":
		$("#estrellas").html('<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i>')
		break;

		case "1.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i>')
		break;

		case "1.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i>')
		break;

		case "2.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i>')
		break;

		case "2.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i>')
		break;

		case "3.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i>')
		break;

		case "3.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i>')
		break;

		case "4.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-o text-success" aria-hidden="true"></i>')
		break;

		case "4.5":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star-half-o text-success" aria-hidden="true"></i>')
		break;

		case "5.0":
		$("#estrellas").html('<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i> '+
							'<i class="fa fa-star text-success" aria-hidden="true"></i>')
		break;
	}
})

function validarComentario(){
	var comentario = $("#comentario").val()
	if (comentario != "") {
		var expresion = /^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;
		if (!expresion.test(comentario)) {
			$("#comentario").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong> No se permiten caracteres especiales</div>')
			return false;
		}


	} else {
		$("#comentario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Campo obligatorio</div>')
		return false;
	}

	return true;
}

$(".deseos").click(function(){
	var idProducto = $(this).attr("idProductos");
	//console.log("idPR", idProducto)
	var idUsuario = localStorage.getItem("usuario")

	if (idUsuario == null) {
		swal({
			  title:"Debe ingresar al sistema",
			  text: "¡Para agregar un producto a la 'lista de deseos' debe primero ingresar al sistema!",
			  type: "warning",
			  confirmButtonText: "Cerrar",
			  closeOnConfirm: false
			},
			function(isConfirm){
				if(isConfirm){
					window.location = rutaFron;
				}
			}
		);					
	} else {

		$(this).addClass("btn-danger")
		var datos = new FormData();
		datos.append("idUsuario", idUsuario);
		datos.append("idProducto", idProducto);

		$.ajax({
			url: rutaFron+"ajax/AjaxUser.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(response){
				//console.log("resp", response)
			}
		})
	}
})

$(".quitarDeseo").click(function(){
	var idDeseo = $(this).attr("idDeseo")
	$(this).parent().parent().parent().remove()
	var datos = new FormData()
	datos.append("idDeseo", idDeseo)

	$.ajax({
			url: rutaFron+"ajax/AjaxUser.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(response){
				//console.log("resp", response)
			}
		})
})
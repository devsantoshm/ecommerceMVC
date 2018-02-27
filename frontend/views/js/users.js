
var rutaActual = location.href;

$(".btnIngreso").click(function(){
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
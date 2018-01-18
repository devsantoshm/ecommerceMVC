$.ajax({
	url: "ajax/AjaxTemplate.php",
	success: function(response){
		//console.log(JSON.parse(response)); //convertir un string en formato json
		var colorFondo = JSON.parse(response).colorFondo;
		var colorTexto = JSON.parse(response).colorTexto;
		var barraSuperior = JSON.parse(response).barraSuperior;
		var textoSuperior = JSON.parse(response).textoSuperior;

		$(".backColor, .backColor a").css({"background": colorFondo,
											"color": colorTexto})
		$(".barraSuperior, .barraSuperior a").css({"background": barraSuperior,
											"color": textoSuperior})
	}
});
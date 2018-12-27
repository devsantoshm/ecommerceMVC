$("#buscador a").click(function(){
	
	if ($("#buscador input").val() == "") {
		$("#buscador a").attr("href", "");
	}
	
})

$("#buscador input").change(function(){
	var busqueda = $("#buscador input").val();
	var expresion = /^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]*$/;
	if (!expresion.test(busqueda)) {
		$("#buscador input").val("");
	}else{
		var evaluarBusqueda = busqueda.replace(/[áéíóúÁÉÍÓÚ ]/g, "-");
		var rutaBuscador = $("#buscador a").attr("href");
		if ($("#buscador input").val() != "") {
			$("#buscador a").attr("href", rutaBuscador+"/"+evaluarBusqueda);
		}
	}
})

$("#buscador input").focus(function(){
	$(document).keyup(function(event){
		event.preventDefault(); //evita disparar el evento por default
		if (event.keyCode == 13 && $("#buscador input").val() != "") {
			var rutaBuscador = $("#buscador a").attr("href");
			window.location.href = rutaBuscador;
		}
	})
})

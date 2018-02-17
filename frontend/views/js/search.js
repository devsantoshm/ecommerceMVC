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

var indice = url.split("/");
var pagActual = indice[6];

/*console.log("indice", indice[6]);
var pagSearch = indice[6];*/

if(pagActual != "#"){
	if (isNaN(pagActual)) {
		//$("#item1").addClass("active");
		//$("#item1 a").removeAttr("href");
	} else {
		$("#item1").removeClass("active");
		$("#item"+pagActual).addClass("active");
		$("#item"+pagActual+" a").removeAttr("href");
	}
}
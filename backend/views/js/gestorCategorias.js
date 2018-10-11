//ejemplo para verificar el formato json
/*$.ajax({
	url:"ajax/AjaxTableCategories.php",
	succes:function(response){
		console.log("response", response);
	}
})*/

$(".tablaCategorias").DataTable({
	 "ajax": "ajax/AjaxTableCategories.php",
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

//ACTIVAR CATEGORIA
//aplicar on una vez se cargo el documento html funcione el evento click
$(".tablaCategorias tbody").on("click", ".btnActivar", function(){
	var idCategoria = $(this).attr("idCategoria")
	var estadoCategoria = $(this).attr("estadoCategoria")

	var datos = new FormData()
	datos.append("activarId", idCategoria)
	datos.append("activarCategoria", estadoCategoria)

	$.ajax({
		url: "ajax/AjaxCategories.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(response){
			/*if(response == "ok"){
				swal({
			      title: "Cambios guardados",
			      text: "¡La plantilla ha sido actualizada correctamente!",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    });
			}*/
		}
	})

	if (estadoCategoria == 0) {
		$(this).removeClass('btn-success')
		$(this).addClass('btn-danger')
		$(this).html('Desactivado')
		$(this).attr('estadoCategoria', 1)
	} else {
		$(this).addClass('btn-success')
		$(this).removeClass('btn-danger')
		$(this).html('Activado')
		$(this).attr('estadoCategoria', 0)
	}
})

//REVISAR SI LA CATEGORIA YA EXISTE
$(".validarCategoria").change(function(){
	$(".alert").remove()
	var categoria = $(this).val()
	var datos = new FormData()
	datos.append("validarCategoria", categoria)

	$.ajax({
		url: "ajax/AjaxCategories.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){
			//console.log("response", response);
			if (response) {
				$(".validarCategoria").parent().after('<div class="alert alert-warning">Esta categoría ya existe en la bd</div>')
				$(".validarCategoria").val("")
			}
		}
	})
})

//RUTA CATEGORIA
function limpiarUrl(texto){
	var texto  = texto.toLowerCase()
	texto = texto.replace(/[á]/, 'a')
	texto = texto.replace(/[é]/, 'e')
	texto = texto.replace(/[í]/, 'i')
	texto = texto.replace(/[ó]/, 'o')
	texto = texto.replace(/[ú]/, 'u')
	texto = texto.replace(/[ñ]/, 'n')
	texto = texto.replace(/ /g, '-')

	return texto
}

$(".tituloCategoria").change(function(){
	$(".rutaCategoria").val(
		limpiarUrl($(".tituloCategoria").val())
	)
})

/*=============================================
SUBIENDO LA FOTO DE PORTADA DE LA CATEGORÍA
=============================================*/

$(".fotoPortada").change(function(){

	var imagen = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

		$(".fotoPortada").val("");

		swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen debe estar en formato JPG o PNG!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;

  	}else if(imagen["size"] > 2000000){

  		$(".fotoPortada").val("");

		swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen no debe pesar más de 2MB!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){
		
  			var rutaImagen = event.target.result;

  			$(".previsualizarPortada").attr("src", rutaImagen);

		})
  	}
})

$(".fotoOferta").change(function(){

	var imagen = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

		$(".fotoOferta").val("");

		swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen debe estar en formato JPG o PNG!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;

  	}else if(imagen["size"] > 2000000){

  		$(".fotoOferta").val("");

		swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen no debe pesar más de 2MB!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){
		
  			var rutaImagen = event.target.result;

  			$(".previsualizarOferta").attr("src", rutaImagen);

		})
  	}
})

//ACTIVAR OFERTA
function activarOferta(evento){
	if (evento == "oferta") {
		$(".datosOferta").show()
		$(".valorOferta").prop("required", true)//Set the property and value
		$(".valorOferta").val("")
	} else {
		$(".datosOferta").hide()
		$(".valorOferta").prop("required", false)//Set the property and value
		$(".valorOferta").val("")
	}
}

$(".selActivarOferta").change(function(){
	activarOferta($(this).val())
})

$(".valorOferta").change(function(){

	if ($(this).attr("id") == "precioOferta") {
		$("#precioOferta").prop("readonly", true)//Set the property and value
		$("#descuentoOferta").prop("readonly", false)
		$("#descuentoOferta").val(0)
	}

	if ($(this).attr("id") == "descuentoOferta") {
		$("#descuentoOferta").prop("readonly", true)//Set the property and value
		$("#precioOferta").prop("readonly", false)
		$("#precioOferta").val(0)
	}
})
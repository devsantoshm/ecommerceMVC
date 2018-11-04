//ejemplo para verificar el formato json
/*$.ajax({
	url:"ajax/AjaxTableSubCategories.php",
	succes:function(response){
		console.log("response", response);
	}
})*/

$(".tablaSubCategorias").DataTable({
	 "ajax": "ajax/AjaxTableSubCategories.php",
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
$(".tablaSubCategorias tbody").on("click", ".btnActivar", function(){
	var idSubCategoria = $(this).attr("idSubCategoria")
	var estadoSubCategoria = $(this).attr("estadoSubCategoria")

	var datos = new FormData()
	datos.append("activarId", idSubCategoria)
	datos.append("activarSubCategoria", estadoSubCategoria)

	$.ajax({
		url: "ajax/AjaxSubCategories.php",
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

	if (estadoSubCategoria == 0) {
		$(this).removeClass('btn-success')
		$(this).addClass('btn-danger')
		$(this).html('Desactivado')
		$(this).attr('estadoSubCategoria', 1)
	} else {
		$(this).addClass('btn-success')
		$(this).removeClass('btn-danger')
		$(this).html('Activado')
		$(this).attr('estadoSubCategoria', 0)
	}
})

//REVISAR SI LA SubCATEGORIA YA EXISTE
$(".validarSubCategoria").change(function(){
	$(".alert").remove()
	var Subcategoria = $(this).val()
	var datos = new FormData()
	datos.append("validarSubCategoria", Subcategoria)

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
				$(".validarSubCategoria").parent().after('<div class="alert alert-warning">Esta categoría ya existe en la bd</div>')
				$(".validarSubCategoria").val("")
			}
		}
	})
})

//RUTA SubCATEGORIA
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

$(".tituloSubCategoria").change(function(){
	$(".rutaSubCategoria").val(
		limpiarUrl($(".tituloSubCategoria").val())
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

//EDITAR SubCATEGORIA
$(".tablaSubCategorias tbody").on("click", ".btnEditarCategoria", function(){
	var idCategoria = $(this).attr("idCategoria")

	var datos = new FormData()
	datos.append("idCategoria", idCategoria)

	$.ajax({
		url: "ajax/AjaxCategories.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){

			$("#modalEditarCategoria .editarIdCategoria").val(response["id"])

			$("#modalEditarCategoria .tituloCategoria").val(response["categoria"])
			$("#modalEditarCategoria .rutaCategoria").val(response["ruta"])

			$("#modalEditarCategoria .tituloCategoria").change(function(){
				$("#modalEditarCategoria .rutaCategoria").val(
					limpiarUrl($("#modalEditarCategoria .tituloCategoria").val())
				)
			})

			//TRAEMOS DATOS DE CABECERA
			var datosCabecera = new FormData()
			datosCabecera.append("ruta", response["ruta"])

			$.ajax({
				url: "ajax/AjaxHeaders.php",
				method: "POST",
				data: datosCabecera,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success: function(response){

					$("#modalEditarCategoria .editarIdCabecera").val(response["id"])

					$("#modalEditarCategoria .descripcionCategoria").val(response["descripcion"])

					if (response["palabrasClave"] != null) {
						$(".editarPalabrasClaves").html(
				              '<div class="input-group">'+
				                '<span class="input-group-addon"><i class="fa fa-key"></i></span>'+
				                '<input type="text" name="pClavesCategoria" class="form-control input-lg pClavesCategoria tagsInput" data-role="tagsInput" value="'+response["palabrasClave"]+'" required>'+
				              '</div>'
				        )

				        $("#modalEditarCategoria .pClavesCategoria").tagsinput('items')

				        $(".bootstrap-tagsinput").css({
							"padding":"11px",
							"width":"100%",
							"border-radius":"1px"
						})
					}else{
						$(".editarPalabrasClaves").html(
				              '<div class="input-group">'+
				                '<span class="input-group-addon"><i class="fa fa-key"></i></span>'+
				                '<input type="text" name="pClavesCategoria" class="form-control input-lg pClavesCategoria tagsInput" data-role="tagsInput" placeholder="Ingresar palabras claves" required>'+
				              '</div>'
				        )

				        $("#modalEditarCategoria .pClavesCategoria").tagsinput('items')

				        $(".bootstrap-tagsinput").css({
							"padding":"11px",
							"width":"100%",
							"border-radius":"1px"
						})
					}

					$("#modalEditarCategoria .previsualizarPortada").attr("src", response["portada"])
					$("#modalEditarCategoria .antiguaFotoPortada").val(response["portada"])
				}
			})

			//PREGUNTAMOS SI EXISTE OFERTA
			if (response["oferta"] != 0) {
				$("#modalEditarCategoria .selActivarOferta").val("oferta")
				$("#modalEditarCategoria .datosOferta").show()
				$("#modalEditarCategoria .valorOferta").prop("required", true)
				$("#modalEditarCategoria #precioOferta").val(response["precioOferta"])
				$("#modalEditarCategoria #descuentoOferta").val(response["descuentoOferta"])

				if (response["precioOferta"] != 0) {
					$("#modalEditarCategoria #precioOferta").prop("readonly", true)
					$("#modalEditarCategoria #descuentoOferta").prop("readonly", false)
				}

				if (response["descuentoOferta"] != 0) {
					$("#modalEditarCategoria #precioOferta").prop("readonly", false)
					$("#modalEditarCategoria #descuentoOferta").prop("readonly", true)
				}

				$("#modalEditarCategoria .previsualizarOferta").attr("src", response["imgOferta"])
				$("#modalEditarCategoria .antiguaFotoOferta").val(response["imgOferta"])
				$("#modalEditarCategoria .finOferta").val(response["finOferta"])
			}else{
				$("#modalEditarCategoria .selActivarOferta").val("")
				$("#modalEditarCategoria .datosOferta").hide()
				$("#modalEditarCategoria .valorOferta").prop("required", false)
				$("#modalEditarCategoria .previsualizarOferta").attr("src", "views/img/ofertas/default/default.jpg")
				$("#modalEditarCategoria .antiguaFotoOferta").val(response["imgOferta"])
			}

			$("#modalEditarCategoria .selActivarOferta").change(function(){
				activarOferta($(this).val())
			})

			$("#modalEditarCategoria .valorOferta").change(function(){
				if ($(this).attr("id") == "precioOferta") {
					$("#modalEditarCategoria #precioOferta").prop("readonly", true)//Set the property and value
					$("#modalEditarCategoria #descuentoOferta").prop("readonly", false)
					$("#modalEditarCategoria #descuentoOferta").val(0)
				}

				if ($(this).attr("id") == "descuentoOferta") {
					$("#modalEditarCategoria #descuentoOferta").prop("readonly", true)//Set the property and value
					$("#modalEditarCategoria #precioOferta").prop("readonly", false)
					$("#modalEditarCategoria #precioOferta").val(0)
				}
			})

		}
	})
})

//ELIMINAR CATEGORIA
$(".tablaSubCategorias tbody").on("click", ".btnEliminarCategoria", function(){
	var idCategoria = $(this).attr("idCategoria")
	var imgOferta = $(this).attr("imgOferta")
	var rutaCabecera = $(this).attr("rutaCabecera")
	var imgPortada = $(this).attr("imgPortada")

	swal({
      title: "¿Está seguro de borrar la categoría?",
      text: "¡Si no lo está puede candelar la acción!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',  
      confirmButtonText: "¡Si, borrar categoría!"
      }).then(function(result){
		 if (result.value) {
		 	window.location = "index.php?ruta=categorias&idCategoria="+idCategoria+"&imgOferta="+imgOferta+"&rutaCabecera="+rutaCabecera+"&imgPortada="+imgPortada;
		 }
    });
})
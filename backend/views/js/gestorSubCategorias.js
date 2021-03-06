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
		url: "ajax/AjaxSubCategories.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){
			//console.log("response", response);
			if (response.length != 0) {//el modelo Subcategorias devuelve un fetchAll
				$(".validarSubCategoria").parent().after('<div class="alert alert-warning">Esta Subcategoría ya existe en la bd</div>')
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
$(".tablaSubCategorias tbody").on("click", ".btnEditarSubCategoria", function(){
	var idSubCategoria = $(this).attr("idSubCategoria")

	var datos = new FormData()
	datos.append("idSubCategoria", idSubCategoria)

	$.ajax({
		url: "ajax/AjaxSubCategories.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){//retorna un fetchall la bd

			$("#modalEditarSubCategoria .editarIdSubCategoria").val(response[0]["id"])

			$("#modalEditarSubCategoria .tituloSubCategoria").val(response[0]["categoria"])
			$("#modalEditarSubCategoria .rutaSubCategoria").val(response[0]["ruta"])

			$("#modalEditarSubCategoria .tituloSubCategoria").change(function(){
				$("#modalEditarSubCategoria .rutaSubCategoria").val(
					limpiarUrl($("#modalEditarSubCategoria .tituloSubCategoria").val())
				)
			})

			//TRAEMOS LA CATEGORIA
			if (response[0]["id_categoria"] != 0) {
				
				var datosCategoria = new FormData()
				datosCategoria.append("idCategoria", response[0]["id_categoria"])

				$.ajax({
				url: "ajax/AjaxCategories.php",
				method: "POST",
				data: datosCategoria,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success: function(response){

					$("#modalEditarSubCategoria .seleccionarCategoria").val(response["id"])
					$("#modalEditarSubCategoria .optionEditarCategoria").html(response["categoria"])
				}
			})

			}else{
				$("#modalEditarSubCategoria .optionEditarCategoria").html("SIN CATEGORIA")
			}

			//TRAEMOS DATOS DE CABECERA
			var datosCabecera = new FormData()
			datosCabecera.append("ruta", response[0]["ruta"])

			$.ajax({
				url: "ajax/AjaxHeaders.php",
				method: "POST",
				data: datosCabecera,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success: function(response){

					$("#modalEditarSubCategoria .editarIdCabecera").val(response["id"])

					$("#modalEditarSubCategoria .descripcionSubCategoria").val(response["descripcion"])

					if (response["palabrasClave"] != null) {
						$(".editarPalabrasClaves").html(
				              '<div class="input-group">'+
				                '<span class="input-group-addon"><i class="fa fa-key"></i></span>'+
				                '<input type="text" name="pClavesSubCategoria" class="form-control input-lg pClavesSubCategoria tagsInput" data-role="tagsInput" value="'+response["palabrasClave"]+'">'+
				              '</div>'
				        )

				        $("#modalEditarSubCategoria .pClavesSubCategoria").tagsinput('items')

				        $(".bootstrap-tagsinput").css({
							"padding":"11px",
							"width":"100%",
							"border-radius":"1px"
						})
					}else{
						$(".editarPalabrasClaves").html(
				              '<div class="input-group">'+
				                '<span class="input-group-addon"><i class="fa fa-key"></i></span>'+
				                '<input type="text" name="pClavesSubCategoria" class="form-control input-lg pClavesSubCategoria tagsInput" data-role="tagsInput">'+
				              '</div>'
				        )

				        $("#modalEditarSubCategoria .pClavesSubCategoria").tagsinput('items')

				        $(".bootstrap-tagsinput").css({
							"padding":"11px",
							"width":"100%",
							"border-radius":"1px"
						})
					}

					$("#modalEditarSubCategoria .previsualizarPortada").attr("src", response["portada"])
					$("#modalEditarSubCategoria .antiguaFotoPortada").val(response["portada"])
				}
			})

			//PREGUNTAMOS SI EXISTE OFERTA
			if (response[0]["oferta"] != 0) {
				$("#modalEditarSubCategoria .selActivarOferta").val("oferta")
				$("#modalEditarSubCategoria .datosOferta").show()
				$("#modalEditarSubCategoria .valorOferta").prop("required", true)
				$("#modalEditarSubCategoria #precioOferta").val(response[0]["precioOferta"])
				$("#modalEditarSubCategoria #descuentoOferta").val(response[0]["descuentoOferta"])

				if (response[0]["precioOferta"] != 0) {
					$("#modalEditarSubCategoria #precioOferta").prop("readonly", true)
					$("#modalEditarSubCategoria #descuentoOferta").prop("readonly", false)
				}

				if (response[0]["descuentoOferta"] != 0) {
					$("#modalEditarSubCategoria #precioOferta").prop("readonly", false)
					$("#modalEditarSubCategoria #descuentoOferta").prop("readonly", true)
				}

				$("#modalEditarSubCategoria .previsualizarOferta").attr("src", response[0]["imgOferta"])
				$("#modalEditarSubCategoria .antiguaFotoOferta").val(response[0]["imgOferta"])
				$("#modalEditarSubCategoria .finOferta").val(response[0]["finOferta"])
			}else{
				$("#modalEditarSubCategoria .selActivarOferta").val("")
				$("#modalEditarSubCategoria .datosOferta").hide()
				$("#modalEditarSubCategoria .valorOferta").prop("required", false)
				$("#modalEditarSubCategoria .previsualizarOferta").attr("src", "views/img/ofertas/default/default.jpg")
				$("#modalEditarSubCategoria .antiguaFotoOferta").val(response[0]["imgOferta"])
			}

			$("#modalEditarSubCategoria .selActivarOferta").change(function(){
				activarOferta($(this).val())
			})

			$("#modalEditarSubCategoria .valorOferta").change(function(){
				if ($(this).attr("id") == "precioOferta") {
					$("#modalEditarSubCategoria #precioOferta").prop("readonly", true)//Set the property and value
					$("#modalEditarSubCategoria #descuentoOferta").prop("readonly", false)
					$("#modalEditarSubCategoria #descuentoOferta").val(0)
				}

				if ($(this).attr("id") == "descuentoOferta") {
					$("#modalEditarSubCategoria #descuentoOferta").prop("readonly", true)//Set the property and value
					$("#modalEditarSubCategoria #precioOferta").prop("readonly", false)
					$("#modalEditarSubCategoria #precioOferta").val(0)
				}
			})

		}
	})
})

//ELIMINAR CATEGORIA
$(".tablaSubCategorias tbody").on("click", ".btnEliminarSubCategoria", function(){
	var idSubCategoria = $(this).attr("idSubCategoria")
	var imgOferta = $(this).attr("imgOferta")
	var rutaCabecera = $(this).attr("rutaCabecera")
	var imgPortada = $(this).attr("imgPortada")

	swal({
      title: "¿Está seguro de borrar la subcategoría?",
      text: "¡Si no lo está puede candelar la acción!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',  
      confirmButtonText: "¡Si, borrar subcategoría!"
      }).then(function(result){
		 if (result.value) {
		 	window.location = "index.php?ruta=subcategorias&idSubCategoria="+idSubCategoria+"&imgOferta="+imgOferta+"&rutaCabecera="+rutaCabecera+"&imgPortada="+imgPortada;
		 }
    });
})
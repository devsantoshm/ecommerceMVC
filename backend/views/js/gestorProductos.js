//ejemplo para verificar el formato json
$.ajax({
	url:"ajax/AjaxTableProducts.php",
	succes:function(response){
		console.log("response", response);
	}
})

$(".tablaProductos").DataTable({
	 "ajax": "ajax/AjaxTableProducts.php",
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
$(".tablaProductos tbody").on("click", ".btnActivar", function(){
	var idProducto = $(this).attr("idProducto")
	var estadoProducto = $(this).attr("estadoProducto")

	var datos = new FormData()
	datos.append("activarId", idProducto)
	datos.append("activarProducto", estadoProducto)

	$.ajax({
		url: "ajax/AjaxProducts.php",
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

	if (estadoProducto == 0) {
		$(this).removeClass('btn-success')
		$(this).addClass('btn-danger')
		$(this).html('Desactivado')
		$(this).attr('estadoProducto', 1)
	} else {
		$(this).addClass('btn-success')
		$(this).removeClass('btn-danger')
		$(this).html('Activado')
		$(this).attr('estadoProducto', 0)
	}
})

//REVISAR SI EL PRODUCTO YA EXISTE
$(".validarProducto").change(function(){
	$(".alert").remove()
	var producto = $(this).val()
	var datos = new FormData()
	datos.append("validarProducto", producto)

	$.ajax({
		url: "ajax/AjaxProducts.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(response){
			console.log("response", response.length);
			if (response.length != 0) {
				$(".validarProducto").parent().after('<div class="alert alert-warning">Esta producto ya existe en la bd</div>')
				$(".validarProducto").val("")
			}
		}
	})
})

//RUTA PRODUCTO
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

$(".tituloProducto").change(function(){
	$(".rutaProducto").val(
		limpiarUrl($(".tituloProducto").val())
	)
})

/*AGREGAR MULTIMEDIA*/
var tipo = null

$(".seleccionarTipo").change(function(){
	tipo = $(this).val()
	if (tipo == "virtual") {
		$(".multimediaVirtual").show()
		$(".multimediaFisica").hide()
		$(".detallesVirtual").show()
		$(".detallesFisicos").hide()

	} else {
		$(".multimediaFisica").show()
		$(".multimediaVirtual").hide()
		$(".detallesFisicos").show()
		$(".detallesVirtual").hide()
	}
})

/*=============================================
AGREGAR MULTIMEDIA CON DROPZONE
=============================================*/
var arrayFiles = [];

$(".multimediaFisica").dropzone({

	url: "/",
	addRemoveLinks: true,
	acceptedFiles: "image/jpeg, image/png",
	maxFilesize: 2,
	maxFiles: 10,
	init: function(){

		this.on("addedfile", function(file){

			arrayFiles.push(file);

			// console.log("arrayFiles", arrayFiles);
		})

		this.on("removedfile", function(file){

			var index = arrayFiles.indexOf(file);

			arrayFiles.splice(index, 1);

			// console.log("arrayFiles", arrayFiles);
		})
	}
})

/*=============================================
SELECCIONAR SUBCATEGORÍA
=============================================*/
$(".seleccionarCategoria").change(function(){

	var categoria = $(this).val();

	$(".seleccionarSubCategoria").html(""); // el html se resetee cada vexz que cambio de categoria

	$("#modalEditarProducto .seleccionarSubCategoria").html("");

	var datos = new FormData();
	datos.append("idCategoria", categoria);

	 $.ajax({
	    url:"ajax/AjaxSubCategories.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	// console.log("respuesta", respuesta);

	    	$(".entradaSubcategoria").show();

	    	respuesta.forEach(funcionForEach);

	        function funcionForEach(item, index){

	        	$(".seleccionarSubCategoria").append(

    				'<option value="'+item["id"]+'">'+item["subcategoria"]+'</option>'

    			)

	        }

	    }

	})

})

/*=============================================
SUBIENDO LA FOTO DE PORTADA
=============================================*/
var imagenPortada = null;

$(".fotoPortada").change(function(){

	imagenPortada = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagenPortada["type"] != "image/jpeg" && imagenPortada["type"] != "image/png"){

  		$(".fotoPortada").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagenPortada["size"] > 2000000){

  		$(".fotoPortada").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenPortada);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarPortada").attr("src", rutaImagen);

  		})

  	}

})

/*=============================================
SUBIENDO LA FOTO PRINCIPAL
=============================================*/
var imagenFotoPrincipal = null;

$(".fotoPrincipal").change(function(){

	imagenFotoPrincipal = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagenFotoPrincipal["type"] != "image/jpeg" && imagenFotoPrincipal["type"] != "image/png"){

  		$(".fotoPrincipal").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagenFotoPrincipal["size"] > 2000000){

  		$(".fotoPrincipal").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenFotoPrincipal);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarPrincipal").attr("src", rutaImagen);

  		})

  	}

})

/*=============================================
SUBIENDO LA FOTO DE LA OFERTA
=============================================*/
var imagenOferta = null;

$(".fotoOferta").change(function(){

	imagenOferta = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagenOferta["type"] != "image/jpeg" && imagenOferta["type"] != "image/png"){

  		$(".fotoOferta").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagenOferta["size"] > 2000000){

  		$(".fotoOferta").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenOferta);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarOferta").attr("src", rutaImagen);

  		})

  	}
})


/*=============================================
ACTIVAR OFERTA
=============================================*/
function activarOferta(event){

	if(event == "oferta"){

		$(".datosOferta").show();
		$(".valorOferta").prop("required",true);
		$(".valorOferta").val("");

	}else{

		$(".datosOferta").hide();
		$(".valorOferta").prop("required",false);
		$(".valorOferta").val("");

	}
}

$(".selActivarOferta").change(function(){

	activarOferta($(this).val())

})

/*=============================================
VALOR OFERTA
=============================================*/
$("#modalAgregarProducto .valorOferta").change(function(){

	if($(".precio").val()!= 0){

		if($(this).attr("tipo") == "oferta"){

			var descuento = 100 - (Number($(this).val())*100/Number($(".precio").val()));

			$(".precioOferta").prop("readonly",true);
			$(".descuentoOferta").prop("readonly",false);
			$(".descuentoOferta").val(Math.ceil(descuento));	

		}

		if($(this).attr("tipo") == "descuento"){

			var oferta = Number($(".precio").val())-(Number($(this).val())*Number($(".precio").val())/100);
			
			$(".descuentoOferta").prop("readonly",true);
			$(".precioOferta").prop("readonly",false);
			$(".precioOferta").val(oferta);
		}

	}else{

	 swal({
	      title: "Error al agregar la oferta",
	      text: "¡Primero agregue un precio al producto!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	 $(".precioOferta").val(0);
	 $(".descuentoOferta").val(0);

	 return;
	}
})

/*=============================================
CAMBIAR EL PRECIO
=============================================*/
$(".precio").change(function(){

	$(".precioOferta").val(0);
	$(".descuentoOferta").val(0);

})

/*=============================================
GUARDAR EL PRODUCTO
=============================================*/
var multimediaFisica = null;
var multimediaVirtual = null;

$(".guardarProducto").click(function(){

	/*=============================================
	PREGUNTAMOS SI LOS CAMPOS OBLIGATORIOS ESTÁN LLENOS
	=============================================*/
	if($(".tituloProducto").val() != "" && 
	   $(".seleccionarTipo").val() != "" && 
	   $(".seleccionarCategoria").val() != "" &&
	   $(".seleccionarSubCategoria").val() != "" &&
	   $(".descripcionProducto").val() != "" &&
	   $(".pClavesProducto").val() != ""){

		/*=============================================
	   	PREGUNTAMOS SI VIENEN IMÁGENES PARA MULTIMEDIA O LINK DE YOUTUBE
	   	=============================================*/
	   	if(tipo != "virtual"){

	   		if(arrayFiles.length > 0 && $(".rutaProducto").val() != ""){

	   			var listaMultimedia = [];
	   			var finalFor = 0;

	   			for(var i = 0; i < arrayFiles.length; i++){

	   				var datosMultimedia = new FormData();
	   				datosMultimedia.append("file", arrayFiles[i]);
					datosMultimedia.append("ruta", $(".rutaProducto").val());

					$.ajax({
						url:"ajax/AjaxProducts.php",
						method: "POST",
						data: datosMultimedia,
						cache: false,
						contentType: false,
						processData: false,
						success: function(respuesta){
							
							listaMultimedia.push({"foto" : respuesta.substr(3)})
							multimediaFisica = JSON.stringify(listaMultimedia);
							multimediaVirtual = null;

							if(multimediaFisica == null){

							 	swal({
							      title: "El campo de multimedia no debe estar vacío",
							      type: "error",
							      confirmButtonText: "¡Cerrar!"
							    });

							 	return;

							}

							if((finalFor + 1) == arrayFiles.length){

								agregarMiProducto(multimediaFisica); 
								finalFor = 0; 

							}

							finalFor++;
						}

					})
	   			}
	   		}

	   	}else{

	   		multimediaVirtual = $(".multimedia").val();
	   		multimediaFisica = null;

	   		if(multimediaVirtual == null){	

 			 swal({
			      title: "El campo de multimedia no debe estar vacío",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

 			  return;
			
			}	

			agregarMiProducto(multimediaVirtual); 	

	   	}	

	}else{

		 swal({
	      title: "Llenar todos los campos obligatorios",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;
	}

})

function agregarMiProducto(imagen)
{
	/*=============================================
	ALMACENAMOS TODOS LOS CAMPOS DE PRODUCTO
	=============================================*/
	var tituloProducto = $(".tituloProducto").val();
	var rutaProducto = $(".rutaProducto").val();
	var seleccionarTipo = $(".seleccionarTipo").val();
   	var seleccionarCategoria = $(".seleccionarCategoria").val();
    var seleccionarSubCategoria = $(".seleccionarSubCategoria").val();
    var descripcionProducto = $(".descripcionProducto").val();
    var pClavesProducto = $(".pClavesProducto").val();
    var precio = $(".precio").val();
    var peso = $(".peso").val();
    var entrega = $(".entrega").val();
    var selActivarOferta = $(".selActivarOferta").val();
    var precioOferta = $(".precioOferta").val();
    var descuentoOferta = $(".descuentoOferta").val();
    var finOferta = $(".finOferta").val();

    if(seleccionarTipo == "virtual"){

		var detalles = {"Clases": $(".detalleClases").val(),
	       				"Tiempo": $(".detalleTiempo").val(),
	       				"Nivel": $(".detalleNivel").val(),
	       				"Acceso": $(".detalleAcceso").val(),
	       				"Dispositivo": $(".detalleDispositivo").val(),
	   					"Certificado": $(".detalleCertificado").val()};
	}else{

		var detalles = {"Talla": $(".detalleTalla").tagsinput('items'),
		       			"Color": $(".detalleColor").tagsinput('items'),
		       			"Marca": $(".detalleMarca").tagsinput('items')};

	}

	var detallesString = JSON.stringify(detalles);

 	var datosProducto = new FormData();
	datosProducto.append("tituloProducto", tituloProducto);
	datosProducto.append("rutaProducto", rutaProducto);
	datosProducto.append("seleccionarTipo", seleccionarTipo);	
	datosProducto.append("detalles", detallesString);	
	datosProducto.append("seleccionarCategoria", seleccionarCategoria);
	datosProducto.append("seleccionarSubCategoria", seleccionarSubCategoria);
	datosProducto.append("descripcionProducto", descripcionProducto);
	datosProducto.append("pClavesProducto", pClavesProducto);
	datosProducto.append("precio", precio);
	datosProducto.append("peso", peso);
	datosProducto.append("entrega", entrega);

	datosProducto.append("multimedia", imagen);

	datosProducto.append("fotoPortada", imagenPortada);
	datosProducto.append("fotoPrincipal", imagenFotoPrincipal);
	datosProducto.append("selActivarOferta", selActivarOferta);
	datosProducto.append("precioOferta", precioOferta);
	datosProducto.append("descuentoOferta", descuentoOferta);
	datosProducto.append("finOferta", finOferta);
	datosProducto.append("fotoOferta", imagenOferta);

	$.ajax({
		url:"ajax/AjaxProducts.php",
		method: "POST",
		data: datosProducto,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			
			console.log("respuesta", respuesta);
			if(respuesta == "ok"){

				swal({
				  type: "success",
				  title: "El producto ha sido guardado correctamente",
				  showConfirmButton: true,
				  confirmButtonText: "Cerrar"
				  }).then(function(result){
					if (result.value) {

					window.location = "productos";

					}
				})
			}
		}
	})
}

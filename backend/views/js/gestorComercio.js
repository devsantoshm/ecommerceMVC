$("#subirLogo").change(function(){
	var imagenLogo = this.files[0];
	//VALIDAMOS LA IMAGEN
	if (imagenLogo["type"] != "image/jpeg" && imagenLogo["type"] != "image/png") {
		$("#subirLogo").val("");
		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
	}else if(imagenLogo["size"] > 2000000){
		$("#subirLogo").val("");
		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar más de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
	}else{
		var datosImagen = new FileReader;
		//El método readAsDataURL es usado para leer el contenido del especificado Blob o File
		datosImagen.readAsDataURL(imagenLogo);

		$(datosImagen).on("load", function(event){
			var rutaImagen = event.target.result;
			$(".previsualizarLogo").attr("src", rutaImagen);
		})
	}

	//GUARDAR EL LOGOTIPO
	$("#guardarLogo").click(function(){
		var datos = new FormData();
		datos.append("imagenLogo", imagenLogo);

		$.ajax({
			url: "ajax/AjaxCommerce.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(response){
				if(response == "ok"){

					swal({
				      title: "Cambios guardados",
				      text: "¡La plantilla ha sido actualizada correctamente!",
				      type: "success",
				      confirmButtonText: "¡Cerrar!"
				    });
				}
			}
		})
	})
})

/*=============================================
SUBIR ICONO
=============================================*/

$("#subirIcono").change(function(){

	var imagenIcono = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagenIcono["type"] != "image/jpeg" && imagenIcono["type"] != "image/png"){

  		$("#subirIcono").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	/*=============================================
  	VALIDAMOS EL TAMAÑO DE LA IMAGEN
  	=============================================*/

  	}else if(imagenIcono["size"] > 2000000){

  		$("#subirIcono").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

	/*=============================================
  	PREVISUALIZAMOS LA IMAGEN
  	=============================================*/

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagenIcono);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizarIcono").attr("src", rutaImagen);

  		})

  	}

  	/*=============================================
  	GUARDAR EL ICONO
  	=============================================*/

  	$("#guardarIcono").click(function(){

		var datos = new FormData();
		datos.append("imagenIcono", imagenIcono);

		$.ajax({

			url:"ajax/AjaxCommerce.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
				
				if(respuesta == "ok"){

					swal({
				      title: "Cambios guardados",
				      text: "¡La plantilla ha sido actualizada correctamente!",
				      type: "success",
				      confirmButtonText: "¡Cerrar!"
				    });
				}
			}
		});
	})
})

//CAMBIAR COLOR
$(".cambioColor").change(function(){
	var barraSuperior = $("#barraSuperior").val();
	var textoSuperior = $("#textoSuperior").val();
	var colorFondo = $("#colorFondo").val();
	var colorTexto = $("#colorTexto").val();

	$("#guardarColores").click(function(){
		var datos = new FormData();
		datos.append("barraSuperior", barraSuperior);
		datos.append("textoSuperior", textoSuperior);
		datos.append("colorFondo", colorFondo);
		datos.append("colorTexto", colorTexto);

		$.ajax({
			url:"ajax/AjaxCommerce.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
				if(respuesta == "ok"){
					swal({
				      title: "Cambios guardados",
				      text: "¡La plantilla ha sido actualizada correctamente!",
				      type: "success",
				      confirmButtonText: "¡Cerrar!"
				    });
				}		
			}
		});
	})
})

//CAMBIAR COLOR REDES SOCIALES

var checkBox = $(".seleccionarRed")

$("input[name='colorRedSocial']").on("ifChecked", function(){
	var color = $(this).val()
	var colorRed = null
	var iconos = $(".redSocial")
	var redes = ["facebook", "youtube", "twitter", "google-plus", "instagram"];

	if (color == "color") {
		colorRed = "Color"
	} else if(color == "blanco"){
		colorRed = "Blanco"
	} else{
		colorRed = "Negro"
	}

	for (var i = 0; i < iconos.length; i++) {
		$(iconos[i]).attr("class", "fa fa-"+redes[i]+" "+redes[i]+colorRed+" redSocial");
		$(checkBox[i]).attr("estilo", redes[i]+colorRed)
	}

	crearDatosJsonRedes()
})

// CAMBIAR URL REDES SOCIALES
$(".cambiarUrlRed").change(function(){
	var cambiarUrlRed = $(".cambiarUrlRed")
	for (var i = 0; i < cambiarUrlRed.length; i++) {
		$(checkBox[i]).attr("ruta", $(cambiarUrlRed[i]).val())
	}

	crearDatosJsonRedes()
})

//	QUITAR RED SOCIAL
$(".seleccionarRed").on("ifUnchecked", function(){
	$(this).attr("validarRed", "")
	crearDatosJsonRedes()
})

//	AGREGAR RED SOCIAL
$(".seleccionarRed").on("ifChecked", function(){
	$(this).attr("validarRed", $(this).attr("red"))
	crearDatosJsonRedes()
})

// CREAR DATOS JSON PARA ALMACENAR EN BD
function crearDatosJsonRedes(){
	var redesSociales = []
	for (var i = 0; i < checkBox.length; i++) {
		if ($(checkBox[i]).attr("validarRed") != "") {
			redesSociales.push({"red": $(checkBox[i]).attr("red"),
								"estilo": $(checkBox[i]).attr("estilo"),
								"url": $(checkBox[i]).attr("ruta"),
								"activo": 1
							})
		}else{
			redesSociales.push({"red": $(checkBox[i]).attr("red"),
								"estilo": $(checkBox[i]).attr("estilo"),
								"url": $(checkBox[i]).attr("ruta"),
								"activo": 0
							})
		}
		//Create JSON string from a JavaScript object.
		$("#valorRedesSociales").val(JSON.stringify(redesSociales))
	}
}

$("#guardarRedesSociales").click(function(){
	var valorRedesSociales = $("#valorRedesSociales").val()
	var datos = new FormData()
	datos.append("redesSociales", valorRedesSociales)

	$.ajax({
			url:"ajax/AjaxCommerce.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
				if(respuesta == "ok"){
					swal({
				      title: "Cambios guardados",
				      text: "¡La plantilla ha sido actualizada correctamente!",
				      type: "success",
				      confirmButtonText: "¡Cerrar!"
				    });
				}		
			}
		});
})

$(".cambioScript").change(function(){
	var apiFacebook = $("#apiFacebook").val()
	var pixelFacebook = $("#pixelFacebook").val()
	var googleAnalytics = $("#googleAnalytics").val()

	$("#guardarScript").click(function(){
		var datos = new FormData()
		datos.append("apiFacebook", apiFacebook)
		datos.append("pixelFacebook", pixelFacebook)
		datos.append("googleAnalytics", googleAnalytics)

		$.ajax({
			url:"ajax/AjaxCommerce.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
				if(respuesta == "ok"){
					swal({
				      title: "Cambios guardados",
				      text: "¡La plantilla ha sido actualizada correctamente!",
				      type: "success",
				      confirmButtonText: "¡Cerrar!"
				    });
				}		
			}
		});
	})
})

$.ajax({
	url: "views/js/countries.json",
	type: "GET",
	cache: false,
	contentType: false,
	processData: false,
	dataType: "json",
	success: function(response){
		response.forEach(seleccionarPais);
		function seleccionarPais(item, index){
			var pais = item.name;
			var codPais = item.code;

			if ($("#codigoPais").val() == codPais) {
				$("#paisSeleccionado").attr("value", codPais)
				$("#paisSeleccionado").html(pais)
			}

			$("#seleccionarPais").append('<option value="'+codPais+'">'+pais+'</option>')
		}
	}
})

//CAMBIAR INFORMACIÓN
var impuesto = $("#impuesto").val()
var envioNacional = $("#envioNacional").val()
var envioInternacional = $("#envioInternacional").val()
var tasaMinimaNal = $("#tasaMinimaNal").val()
var tasaMinimaInt = $("#tasaMinimaInt").val()
var seleccionarPais = $("#seleccionarPais").val()
var clienteIdPaypal = $("#clienteIdPaypal").val()
var llaveSecretaPaypal = $("#llaveSecretaPaypal").val()

//CAMBIAR MODO PAYPAL
$("input[name='modoPaypal']").on("ifChecked", function(){
	var modoPaypal = $(this).val()
	$("#guardarInformacion").click(function(){
		cambiarInformacion(modoPaypal)
	})
})

//GUARDAR LA INFORMACION
$(".cambioConfiguracion").change(function(){
	impuesto = $("#impuesto").val()
	envioNacional = $("#envioNacional").val()
	envioInternacional = $("#envioInternacional").val()
	tasaMinimaNal = $("#tasaMinimaNal").val()
	tasaMinimaInt = $("#tasaMinimaInt").val()
	seleccionarPais = $("#seleccionarPais").val()
	modoPaypal = $("input[name='modoPaypal']:checked").val()
	clienteIdPaypal = $("#clienteIdPaypal").val()
	llaveSecretaPaypal = $("#llaveSecretaPaypal").val()

	$("#guardarInformacion").click(function(){
		cambiarInformacion(modoPaypal)
	})
})

function cambiarInformacion(modoPaypal){
	var datos = new FormData()
	datos.append("impuesto", impuesto) 
	datos.append("envioNacional", envioNacional) 
	datos.append("envioInternacional", envioInternacional) 
	datos.append("tasaMinimaNal", tasaMinimaNal) 
	datos.append("tasaMinimaInt", tasaMinimaInt) 
	datos.append("seleccionarPais", seleccionarPais) 
	datos.append("modoPaypal", modoPaypal) 
	datos.append("clienteIdPaypal", clienteIdPaypal) 
	datos.append("llaveSecretaPaypal", llaveSecretaPaypal)

	$.ajax({
		url:"ajax/AjaxCommerce.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			if(respuesta == "ok"){
				swal({
			      title: "Cambios guardados",
			      text: "¡La plantilla ha sido actualizada correctamente!",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    });
			}		
		}
	});
}
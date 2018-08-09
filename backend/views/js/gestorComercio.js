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

//AGREGAR SLIDE
$(".agregarSlide").click(function(){
	var imgFondo = "views/img/slide/default/fondo.jpg";
	var tipoSlide = "slideOpcion1"
	var estiloTextoSlide = '{"top":"20","right":"","left":"15","width":"40"}'
	var titulo1 = '{"texto":"Lorem ipsim","color":"#333"}'
	var titulo2 = '{"texto":"Lorem ipsim","color":"#777"}'
	var titulo3 = '{"texto":"Lorem ipsim","color":"#888"}'
	var boton = 'VER PRODUCTO'
	var url = '#'

	var datos = new FormData()
	datos.append("crearSlide", "ok")
	datos.append("imgFondo", imgFondo)
	datos.append("tipoSlide", tipoSlide)
	datos.append("estiloTextoSlide", estiloTextoSlide)
	datos.append("titulo1", titulo1)
	datos.append("titulo2", titulo2)
	datos.append("titulo3", titulo3)
	datos.append("boton", boton)
	datos.append("url", url)

	$.ajax({
		url: "ajax/AjaxSlide.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(response){
			console.log("response", response);
			if(response == "ok"){

				swal({
			      type: "success",
			      title: "El slide ha sido agregado correctamente",
			      showConfirmButton: true,  
			      confirmButtonText: "¡Cerrar!"
			      }).then((result) => {
					 if (result.value) {
					 	window.location = "slide"
					 }
				})
			}

		}
	})
})
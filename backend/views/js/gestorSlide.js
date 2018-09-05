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

// CAMBIAR EL ORDEN DEL SLIDE
var itemSlide = $(".itemSlide")

$('.todo-list').sortable({
	placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999,
    stop: function(event){
    	//para identificar el orden del slide a modificar
    	for (var i = 0; i < itemSlide.length; i++) {
    		//console.log("event", event.target.children[i].id);
    		var datos = new FormData()
    		//idSlide 2 , orden 1  idSlide 4 , orden 2
    		datos.append("idSlide", event.target.children[i].id)
    		datos.append("orden", (i+1))

    		$.ajax({
				url: "ajax/AjaxSlide.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				success: function(response){
					
				}
			})	
    	}
    }
})

//VARIABLES GLOBALES PARA CAMBIOS DEL SLIDE
//GUARDAR TODOS LOS BOTONES QUE TIENEN LA CLASE GUARDARSLIDE
var guardarSlide = $(".guardarSlide")
var tipoSlide = $(".tipoSlide")
var tipoSlideIzq = $(".tipoSlideIzq")
var tipoSlideDer = $(".tipoSlideDer")
var slideOpciones = $(".slideOpciones")

//ACTUALIZAR NOMBRE SLIDE
$(".nombreSlide").change(function(){
	var nombre = $(this).val()
	var indiceSlide = $(this).attr("indice")

	$(guardarSlide[indiceSlide]).attr("nombreSlide", nombre)
})

//CHECKED PARA EL TIPO DE SLIDE
for (var i = 0; i < tipoSlide.length; i++) {
	if($(tipoSlide[i]).val() == "slideOpcion1"){
		$(tipoSlideIzq[i]).parent().addClass("checked")
	}else{
		$(tipoSlideDer[i]).parent().addClass("checked")
	}
}

//CAMBIO DE TIPO DE SLIDE
for (var i = 0; i < tipoSlide.length; i++) {
	$("input[name='tipoSlide"+i+"']").on("ifChecked", function(){
		//slideopcion1 o slideiopcion2
		var tipoSlide = $(this).val()
		var indice = $(this).attr("indice")
		var slide = $(".slide")

		$(slideOpciones[indice]).addClass(tipoSlide)

		var anchoSlide = $(slide[indice]).css("width").replace(/px/, " ")

		if (tipoSlide == "slideOpcion1") {
			//obtengo el ancho del inicio hasta la imagen
			var posHImagen = $(slideOpciones[indice]).children("img").css("left").replace(/px/, " ")
			// distancia en porcentajes
			var nuevaPosHImagen = posHImagen*100/anchoSlide
		} else {
			var posHImagen = $(slideOpciones[indice]).children("img").css("right").replace(/px/, " ")
			var nuevaPosHImagen = posHImagen*100/anchoSlide
		}

	})
}

//GUARDAR SLIDE
$(".guardarSlide").click(function(){
	var id = $(this).attr("id")
	var nombre = $(this).attr("nombreSlide")

	var datos = new FormData()
	datos.append("id", id)
	datos.append("nombre", nombre)

	$.ajax({
		url: "ajax/AjaxSlide.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(response){
			if(response == "ok"){

				swal({
			      type: "success",
			      title: "El nombre ha sido cambiado correctamente",
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

/*=============================================
CARGAR LA TABLA DINÁMICA DE BANNER
=============================================*/

// $.ajax({

// 	url:"ajax/tablaBanner.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })

$(".tablaBanner").DataTable({
	 "ajax": "ajax/AjaxTableBanner.php",
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

/*=============================================
ACTIVAR BANNER
=============================================*/
$(".tablaBanner tbody").on("click", ".btnActivar", function(){

	var idBanner = $(this).attr("idBanner");
	var estadoBanner = $(this).attr("estadoBanner");

	var datos = new FormData();
 	datos.append("activarId", idBanner);
  	datos.append("activarBanner", estadoBanner);

	$.ajax({

	 	url:"ajax/AjaxBanner.php",
	 	method: "POST",
	  	data: datos,
	  	cache: false,
      	contentType: false,
      	processData: false,
      	success: function(respuesta){ 
      	    
      	   console.log("respuesta", respuesta);

      	} 	 

  	});

	if(estadoBanner == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoBanner',1);
  	
  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoBanner',0);
  	}

})

/*=============================================
SUBIENDO LA FOTO DE BANNER
=============================================*/
$(".fotoBanner").change(function(){

	var imagen = this.files[0];

	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/
  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

		$(".fotoBanner").val("");

		swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen debe estar en formato JPG o PNG!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

		return;

  	}else if(imagen["size"] > 2000000){

  		$(".fotoBanner").val("");

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

  			$(".previsualizarBanner").attr("src", rutaImagen);

		})
  	}
})

/*=============================================
SELECCIONAR RUTA DE BANNER
=============================================*/
$(".seleccionarTipoBanner").change(function(){

	var tipoBanner = $(this).val();
	//console.log("tipoBanner", tipoBanner);

	$(".seleccionarRutaBanner").html("");	

	if(tipoBanner != "sin-categoria"){

		$(".seleccionarRutaBanner").attr("name","rutaBanner");

		var datos = new FormData();
		datos.append("tabla", tipoBanner);

		$.ajax({
		    url:"ajax/AjaxBanner.php",
		    method:"POST",
		    data: datos,
		    cache: false,
		    contentType: false,
		    processData: false,
		    dataType: "json",
		    success:function(respuesta){
		    	//console.log("respuesta", respuesta);
		    	
		    	$(".entradaRutaBanner").show();

		    	$(".seleccionarRutaBanner").html(

		    		'<option value="">Seleccione la ruta</option>'
	    		)

    			respuesta.forEach(funcionForEach);

		        function funcionForEach(item, index){

		        	$(".seleccionarRutaBanner").append(

	    				'<option value="'+item["ruta"]+'">'+item["ruta"]+'</option>'
	    			)
		        }
		    }
		})    

	}else{

		$(".entradaRutaBanner").hide();	
	}
})

/*=============================================
REVISAR SI LA RUTA DEL BANNER YA EXISTE
=============================================*/
$(document).on("change", ".seleccionarRutaBanner, .seleccionarTipoBanner", function(){

	$(".alert").remove();

	var ruta = $(this).val();

	var datos = new FormData();
	datos.append("validarRuta", ruta);

	 $.ajax({
	    url:"ajax/AjaxBanner.php",
	    method:"POST",
	    data: datos,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	
	    	if(respuesta){

	    		if(ruta == "sin-categoria"){

	    			$(".seleccionarTipoBanner").parent().after('<div class="alert alert-warning">Esta ruta ya existe en la base de datos</div>');

	    			$(".seleccionarTipoBanner").val("");

	    		}else{

	    			$(".seleccionarRutaBanner").parent().after('<div class="alert alert-warning">Esta ruta ya existe en la base de datos</div>');

	    			$(".seleccionarRutaBanner").val("");

	    		}
	    	}
	    }
	})
})





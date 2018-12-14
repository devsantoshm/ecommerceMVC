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


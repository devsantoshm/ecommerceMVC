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
/*=============================================
ACTIVAR PERFIL
=============================================*/
$(".tablaPerfiles").on("click", ".btnActivar", function(){

	var idPerfil = $(this).attr("idPerfil");
	var estadoPerfil = $(this).attr("estadoPerfil");

	var datos = new FormData();
 	datos.append("activarId", idPerfil);
  datos.append("activarPerfil", estadoPerfil);

  	$.ajax({

  	  url:"ajax/AjaxManagers.php",
  	  method: "POST",
  	  data: datos,
  	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
      	console.log("respuesta", respuesta);
      }

  	})

  	if(estadoPerfil == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoPerfil',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoPerfil',0);

  	}

})

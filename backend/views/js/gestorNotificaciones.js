/*=============================================
ACTUALIZAR NOTIFICACIONES
=============================================*/
$(".actualizarNotificaciones").click(function(e){

  /*Para no tener conflictos con el href vacio ponemos preventDefault, para prevenir acciones
  o eventos por defecto que vienen del navegador*/
	e.preventDefault();

	var item = $(this).attr("item");

	var datos = new FormData();
 	datos.append("item", item );

  	$.ajax({

  		url:"ajax/AjaxNotifications.php",
  		method: "POST",
	  	data: datos,
	  	cache: false,
    	contentType: false,
    	processData: false,
    	success: function(respuesta){

		    if(respuesta == "ok"){

  	    	if(item == "nuevosUsuarios"){

  	    		window.location = "usuarios";
  	    	}

  	    	if(item == "nuevasVentas"){

  	    		window.location = "ventas";
  	    	}

  	    	if(item == "nuevasVisitas"){

  	    		window.location = "visitas";
  	    	}

        }

    	}
    
    })

})
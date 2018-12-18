<?php

require_once "../controllers/UsersController.php";
require_once "../models/UsersModel.php";
require_once "../models/routes.php";

class AjaxTableUsers{

 	/*=============================================
  	MOSTRAR LA TABLA DE USUARIOS
  	=============================================*/ 
	public function mostrarTabla(){	

		$item = null;
 		$valor = null;

 		$usuarios = UsersController::showUsers($item, $valor);

 		$urlFron = Route::urlFron();

 		if(count($usuarios) == 0){

	      $datosJson = '{ "data":[]}';

	      echo $datosJson;

	      return;

	    }

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($usuarios); $i++){

	 		/*=============================================
			TRAER FOTO USUARIO
			=============================================*/
			if($usuarios[$i]["foto"] != ""  && $usuarios[$i]["modo"] == "directo"){

				$foto = "<img class='img-circle' src='".$urlFron.$usuarios[$i]["foto"]."' width='60px'>";

			}else if($usuarios[$i]["foto"] != "" && $usuarios[$i]["modo"] != "directo"){

				$foto = "<img class='img-circle' src='".$usuarios[$i]["foto"]."' width='60px'>";

			}else{

				$foto = "<img class='img-circle' src='views/img/usuarios/default/anonymous.png' width='60px'>";
			}

			/*=============================================
  			REVISAR ESTADO
  			=============================================*/
  			if($usuarios[$i]["modo"] == "directo"){

	  			if( $usuarios[$i]["verificacion"] == 1){

	  				$colorEstado = "btn-danger";
	  				$textoEstado = "Desactivado";
	  				$estadoUsuario = 0;

	  			}else{

	  				$colorEstado = "btn-success";
	  				$textoEstado = "Activado";
	  				$estadoUsuario = 1;

	  			}

	  			$estado = "<button class='btn btn-xs btnActivar ".$colorEstado."' idUsuario='". $usuarios[$i]["id"]."' estadoUsuario='".$estadoUsuario."'>".$textoEstado."</button>";

	  		}else{

	  			$estado = "<button class='btn btn-xs btn-info'>Activado</button>";

	  		}


	 		/*=============================================
			DEVOLVER DATOS JSON
			=============================================*/
			$datosJson	 .= '[
				      "'.($i+1).'",
				      "'.$usuarios[$i]["nombre"].'",
				      "'.$usuarios[$i]["email"].'",
				      "'.$usuarios[$i]["modo"].'",
				      "'.$foto.'",
				      "'.$estado.'",
				      "'.$usuarios[$i]["fecha"].'"    
				    ],';

	 	}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
			  
		}'; 

		echo $datosJson;

 	}

}

/*=============================================
ACTIVAR TABLA DE VENTAS
=============================================*/ 
$activar = new AjaxTableUsers();
$activar -> mostrarTabla();




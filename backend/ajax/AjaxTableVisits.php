<?php

require_once "../controllers/VisitsController.php";
require_once "../models/VisitsModel.php";

class AjaxTableVisits{

 	/*=============================================
  	MOSTRAR LA TABLA DE VISITAS
  	=============================================*/ 
 	public function mostrarTabla(){

 		$visitas = VisitsController::showVisits();

 		if(count($visitas) == 0){

	      $datosJson = '{ "data":[]}';

	      echo $datosJson;

	      return;

	    }

 		$datosJson = '{
		 
	 	"data": [ ';

	 	for($i = 0; $i < count($visitas); $i++){

		/*=============================================
		DEVOLVER DATOS JSON
		=============================================*/
		$datosJson	 .= '[
			      "'.($i+1).'",
			      "'.$visitas[$i]["ip"].'",
			      "'.$visitas[$i]["pais"].'",
			      "'.$visitas[$i]["visitas"].'",
			      "'.$visitas[$i]["fecha"].'"    
			    ],';

		}

	 	$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']
		  
		}'; 

		echo $datosJson;
 	}
}

/*=============================================
ACTIVAR TABLA DE VISITAS
=============================================*/ 
$activar = new AjaxTableVisits();
$activar -> mostrarTabla();
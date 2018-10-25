<?php
require_once "../controllers/HeadersController.php";
require_once "../models/HeadersModel.php";

class AjaxHeaders{

 	public $ruta;

 	public function editHeader()
 	{	
 		$item = "ruta";
 		$valor = $this->ruta;

 		$response = HeadersController::showHeaders($item, $valor);

 		echo json_encode($response);
 	}

}

/*=============================================
EDITAR CABECERA
=============================================*/ 
if (isset($_POST["ruta"])) {
	$editar = new AjaxHeaders();
	$editar->ruta = $_POST["ruta"];
	$editar->editHeader();
}



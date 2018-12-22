<?php

require_once "../controllers/ManagersController.php";
require_once "../models/ManagersModel.php";

class AjaxManagers{

	/*=============================================
	ACTIVAR PERFIL
	=============================================*/	
	public $activarPerfil;
	public $activarId;

	public function updateActivateManager(){

		$tabla = "managers";

		$item1 = "estado";
		$valor1 = $this->activarPerfil;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ManagersModel::updateActivateManager($tabla, $item1, $valor1, $item2, $valor2);

		echo $respuesta;
	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/	
	public $idPerfil;

	public function showEditProfile(){

		$item = "id";
		$valor = $this->idPerfil;

		$respuesta = ManagersController::showManagers($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
ACTIVAR PERFIL
=============================================*/	
if(isset($_POST["activarPerfil"])){

	$activarPerfil = new AjaxManagers();
	$activarPerfil -> activarPerfil = $_POST["activarPerfil"];
	$activarPerfil -> activarId = $_POST["activarId"];
	$activarPerfil -> updateActivateManager();

}

/*=============================================
EDITAR PERFIL
=============================================*/
if(isset($_POST["idPerfil"])){

	$editar = new AjaxManagers();
	$editar -> idPerfil = $_POST["idPerfil"];
	$editar -> showEditProfile();

}
<?php  
require_once "../controllers/UserController.php";
require_once "../models/UserModel.php";

class AjaxUer
{
	public $validarEmail;

	public function ajaxValidarEmail()
	{
		$datos = $this->validarEmail;
		$respuesta = UserController::showUser("email", $datos);

		echo json_encode($respuesta);
	}
}

if (isset($_POST["validarEmail"])) {
	$valEmail = new AjaxUer();
	$valEmail->validarEmail = $_POST["validarEmail"];
	$valEmail->ajaxValidarEmail();
}
?>
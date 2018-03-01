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

	public $email;
	public $nombre;
	public $foto;

	public function ajaxRegistroFacebook()
	{
		$datos = array("nombre" => $this->nombre,
						"email" => $this->email,
						"foto" => $this->foto,
						"password" => "null",
						"modo" => "facebook",
						"verificacion" => 0,
						"emailEncriptado" => "null",

		);

		$respuesta = UserController::registerNetworkSocial($datos);

		echo $respuesta;
	}
}

if (isset($_POST["validarEmail"])) {
	$valEmail = new AjaxUer();
	$valEmail->validarEmail = $_POST["validarEmail"];
	$valEmail->ajaxValidarEmail();
}


if (isset($_POST["email"])) {
	$regFacebook = new AjaxUer();
	$regFacebook->email = $_POST["email"];
	$regFacebook->nombre = $_POST["nombre"];
	$regFacebook->foto = $_POST["foto"];
	$regFacebook->ajaxRegistroFacebook();
}
?>
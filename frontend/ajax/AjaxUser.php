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

	public $idUsuario;
	public $idProducto;

	public function ajaxAgregarDeseo()
	{
		$datos = array("idUsuario" => $this->idUsuario,
						"idProducto" => $this->idProducto);

		$respuesta = UserController::addWish($datos);
		echo $respuesta;
	}

	public $idDeseo;

	public function ajaxQuitarDeseo()
	{
		$datos = $this->idDeseo;

		$respuesta = UserController::removeWish($datos);
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

if (isset($_POST["idUsuario"])) {
	$deseo = new AjaxUer();
	$deseo->idUsuario = $_POST["idUsuario"];
	$deseo->idProducto = $_POST["idProducto"];
	$deseo->ajaxAgregarDeseo();
}

if (isset($_POST["idDeseo"])) {
	$quitarDeseo = new AjaxUer();
	$quitarDeseo->idDeseo = $_POST["idDeseo"];
	$quitarDeseo->ajaxQuitarDeseo();
}
?>
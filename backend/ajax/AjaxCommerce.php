<?php
require_once "../controllers/CommerceController.php";
require_once "../models/CommerceModel.php";

class AjaxCommerce
{
	public $imagenLogo;

	public function ajaxChangeLogo()
	{	
		$item = "logo"; //columna logo de la tabla template
		$valor = $this->imagenLogo;

		$response = CommerceController::updateLogoIcon($item, $valor);

		echo $response; //convertir un array en un string
	}

	public $imagenIcon;

	public function ajaxChangeIcon()
	{	
		$item = "icono"; //columna icono de la tabla template
		$valor = $this->imagenIcon;

		$response = CommerceController::updateLogoIcon($item, $valor);

		echo $response; //convertir un array en un string
	}
}

if (isset($_FILES["imagenLogo"])) {
	$logotipo = new AjaxCommerce();
	$logotipo->imagenLogo = $_FILES["imagenLogo"];
	$logotipo->ajaxChangeLogo();	
}

if (isset($_FILES["imagenIcono"])) {
	$logotipo = new AjaxCommerce();
	$logotipo->imagenIcon = $_FILES["imagenIcono"];
	$logotipo->ajaxChangeIcon();	
}
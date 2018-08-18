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

	public $barraSuperior;
	public $textoSuperior;
	public $colorFondo;
	public $colorTexto;

	public function ajaxChangeColor()
	{	
		$datos = array("barraSuperior" => $this->barraSuperior,
						"textoSuperior" => $this->textoSuperior,
						"colorFondo" => $this->colorFondo,
						"colorTexto" => $this->colorTexto);

		$response = CommerceController::updateColors($datos);

		echo $response; //convertir un array en un string
	}

	public $redesSociales;

	public function ajaxChangeRed()
	{	
		$item = "redesSociales";
		$valor = $this->redesSociales;

		$response = CommerceController::updateLogoIcon($item, $valor);

		echo $response;
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

if (isset($_POST["barraSuperior"])) {
	$colores = new AjaxCommerce();
	$colores->barraSuperior = $_POST["barraSuperior"];
	$colores->textoSuperior = $_POST["textoSuperior"];
	$colores->colorFondo = $_POST["colorFondo"];
	$colores->colorTexto = $_POST["colorTexto"];
	$colores->ajaxChangeColor();	
}

if (isset($_POST["redesSociales"])) {
	$redesSociales = new AjaxCommerce();
	$redesSociales->redesSociales = $_POST["redesSociales"];
	$redesSociales->ajaxChangeRed();	
}


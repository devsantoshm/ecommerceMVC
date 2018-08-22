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

	public $apiFacebook;
	public $pixelFacebook;
	public $googleAnalytics;

	public function ajaxChangeScript()
	{	
		$datos = array("apiFacebook" => $this->apiFacebook,
						"pixelFacebook" => $this->pixelFacebook,
						"googleAnalytics" => $this->googleAnalytics);

		$response = CommerceController::updateScript($datos);

		echo $response; //convertir un array en un string
	}

	public $impuesto;
	public $envioNacional; 
	public $envioInternacional;
	public $tasaMinimaNal; 
	public $tasaMinimaInt; 
	public $seleccionarPais; 
	public $modoPaypal; 
	public $clienteIdPaypal;
	public $llaveSecretaPaypal;

	public function ajaxChangeInformation()
	{	
		$datos = array("impuesto" => $this->impuesto,
						"envioNacional" => $this->envioNacional,
						"envioInternacional" => $this->envioInternacional,
						"tasaMinimaNal" => $this->tasaMinimaNal,
						"tasaMinimaInt" => $this->tasaMinimaInt,
						"seleccionarPais" => $this->seleccionarPais,
						"modoPaypal" => $this->modoPaypal,
						"clienteIdPaypal" => $this->clienteIdPaypal,
						"llaveSecretaPaypal" => $this->llaveSecretaPaypal
						);

		$response = CommerceController::updateInformation($datos);

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

if (isset($_POST["apiFacebook"])) {
	$script = new AjaxCommerce();
	$script->apiFacebook = $_POST["apiFacebook"];
	$script->pixelFacebook = $_POST["pixelFacebook"];
	$script->googleAnalytics = $_POST["googleAnalytics"];
	$script->ajaxChangeScript();	
}

if (isset($_POST["impuesto"])) {
	$information = new AjaxCommerce();
	$information->impuesto = $_POST["impuesto"];
	$information->envioNacional = $_POST["envioNacional"];
	$information->envioInternacional = $_POST["envioInternacional"];
	$information->tasaMinimaNal = $_POST["tasaMinimaNal"];
	$information->tasaMinimaInt = $_POST["tasaMinimaInt"];
	$information->seleccionarPais = $_POST["seleccionarPais"];
	$information->modoPaypal = $_POST["modoPaypal"];
	$information->clienteIdPaypal = $_POST["clienteIdPaypal"];
	$information->llaveSecretaPaypal = $_POST["llaveSecretaPaypal"];
	$information->ajaxChangeInformation();	
}


<?php
require_once "../controllers/SlideController.php";
require_once "../models/SlideModel.php";

class AjaxSlide
{
	public $imgFondo;
	public $tipoSlide;
	public $estiloTextoSlide;
	public $titulo1;
	public $titulo2;
	public $titulo3;
	public $boton;
	public $url;

	public function ajaxCreateSlide()
	{	
		$datos = array("imgFondo" => $this->imgFondo,
						"tipoSlide" => $this->tipoSlide,
						"estiloTextoSlide" => $this->estiloTextoSlide,
						"titulo1" => $this->titulo1,
						"titulo2" => $this->titulo2,
						"titulo3" => $this->titulo3,
						"boton" => $this->boton,
						"url" => $this->url
						);

		$response = SlideController::createSlide($datos);

		echo $response; //convertir un array en un string
	}
}

if (isset($_POST["crearSlide"])) {
	$crearSlide = new AjaxSlide();
	$crearSlide->imgFondo = $_POST["imgFondo"];
	$crearSlide->tipoSlide = $_POST["tipoSlide"];
	$crearSlide->estiloTextoSlide = $_POST["estiloTextoSlide"];
	$crearSlide->titulo1 = $_POST["titulo1"];
	$crearSlide->titulo2 = $_POST["titulo2"];
	$crearSlide->titulo3 = $_POST["titulo3"];
	$crearSlide->boton = $_POST["boton"];
	$crearSlide->url = $_POST["url"];
	$crearSlide->ajaxCreateSlide();	
}


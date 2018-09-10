<?php
require_once "../controllers/SlideController.php";
require_once "../models/SlideModel.php";

class AjaxSlide
{
	public $imgFondo;
	public $tipoSlide;
	public $estiloImgProducto;
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

	public $id;
	public $orden;

	public function ajaxOrdenSlide()
	{	
		$datos = array("id" => $this->id,
						"orden" => $this->orden
						);

		$response = SlideController::updateOrderSlide($datos);

		echo $response; //convertir un array en un string
	}

	public $nombre;

	public function ajaxChangeSlide()
	{	
		$datos = array("id" => $this->id,
						"nombre" => $this->nombre,
						"tipoSlide" => $this->tipoSlide,
						"estiloImgProducto" => $this->estiloImgProducto,
						"estiloTextoSlide" => $this->estiloTextoSlide
						);

		$response = SlideController::updateSlide($datos);

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

//ACTUALIZAR ORDEN SLIDE
if (isset($_POST["idSlide"])) {
	$ordenSlide = new AjaxSlide();
	$ordenSlide->id = $_POST["idSlide"];
	$ordenSlide->orden = $_POST["orden"];
	$ordenSlide->ajaxOrdenSlide();	
}

//ACTUALIZAR NOMBRE SLIDE
if (isset($_POST["id"])) {
	$nombreSlide = new AjaxSlide();
	$nombreSlide->id = $_POST["id"];
	$nombreSlide->nombre = $_POST["nombre"];
	$nombreSlide->tipoSlide = $_POST["tipoSlide"];
	$nombreSlide->estiloImgProducto = $_POST["estiloImgProducto"];
	$nombreSlide->estiloTextoSlide = $_POST["estiloTextoSlide"];
	$nombreSlide->ajaxChangeSlide();	
}


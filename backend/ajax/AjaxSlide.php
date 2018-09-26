<?php
require_once "../controllers/SlideController.php";
require_once "../models/SlideModel.php";

class AjaxSlide
{
	public $imgFondo;
	public $tipoSlide;
	public $estiloImgProducto;
	public $estiloTextoSlide;
	public $imgProducto;
	public $subirImgProducto;
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
	//public $imgFondo; // trae la ruta de la imagen antigua
	public $subirFondo; // trae archivo de la imagen nueva

	public function ajaxChangeSlide()
	{	
		$datos = array("id" => $this->id,
						"nombre" => $this->nombre,
						"tipoSlide" => $this->tipoSlide,
						"estiloImgProducto" => $this->estiloImgProducto,
						"estiloTextoSlide" => $this->estiloTextoSlide,
						"imgFondo" => $this->imgFondo,
						"subirFondo" => $this->subirFondo,
						"imgProducto" => $this->imgProducto,
						"subirImgProducto" => $this->subirImgProducto,
						"titulo1" => $this->titulo1,
						"titulo2" => $this->titulo2,
						"titulo3" => $this->titulo3,
						"boton" => $this->boton,
						"url" => $this->url
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
	$slide = new AjaxSlide();
	$slide->id = $_POST["id"];
	$slide->nombre = $_POST["nombre"];
	$slide->tipoSlide = $_POST["tipoSlide"];
	$slide->estiloImgProducto = $_POST["estiloImgProducto"];
	$slide->estiloTextoSlide = $_POST["estiloTextoSlide"];
	
	$slide->imgFondo = $_POST["imgFondo"];
	
	if (isset($_FILES["subirFondo"])) {
		$slide->subirFondo = $_FILES["subirFondo"];
	} else {
		// si solo estoy cambiando el nombre del slide y no el fondo envio subitfondo igual a nulo
		$slide->subirFondo = null;
	}

	//CAMBIAR IMAGEN PRODUCTO
	$slide->imgProducto = $_POST["imgProducto"];
	
	if (isset($_FILES["subirImgProducto"])) {
		$slide->subirImgProducto = $_FILES["subirImgProducto"];
	} else {
		// si solo estoy cambiando el nombre del slide y no el fondo envio subitfondo igual a nulo
		$slide->subirImgProducto = null;
	}
	
	$slide->titulo1 = $_POST["titulo1"];
	$slide->titulo2 = $_POST["titulo2"];
	$slide->titulo3 = $_POST["titulo3"];
	$slide->boton = $_POST["boton"];
	$slide->url = $_POST["url"];
	$slide->ajaxChangeSlide();	
}


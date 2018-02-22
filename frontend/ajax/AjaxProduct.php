<?php
require_once "../controllers/ProductController.php";
require_once "../models/ProductModel.php";

class AjaxProduct
{
	public $valor;
	public $item;
	public $ruta;

	public function ajaxViewProduct()
	{
		$data = array("valor" => $this->valor,
					"ruta" => $this->ruta);

		$item = $this->item;

		$response = ProductController::updateViewProduct($data, $item);

		echo $response; //convertir un array en un string
	}
}

if (isset($_POST["valor"])) {
	$view = new AjaxProduct();
	$view->valor = $_POST["valor"];
	$view->item = $_POST["item"];
	$view->ruta = $_POST["ruta"];
	$view->ajaxViewProduct();	
}

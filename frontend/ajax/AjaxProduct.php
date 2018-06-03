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
		$item1 = $this->item;
		$valor1 = $this->valor;
		
		$item2 = "ruta";
		$valor2 = $this->ruta;

		$response = ProductController::updateProduct($item1, $valor1, $item2, $valor2);

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

<?php
require_once "../controllers/ProductsController.php";
require_once "../models/ProductsModel.php";

require_once "../controllers/CategoriesController.php";
require_once "../models/CategoriesModel.php";

require_once "../controllers/SubCategoriesController.php";
require_once "../models/SubCategoriesModel.php";

require_once "../controllers/HeadersController.php";
require_once "../models/HeadersModel.php";

class AjaxProducts{

	public $activarProducto;
	public $activarId;

 	public function activateProduct()
 	{	
 		$table = "products";
 		$item1 = "estado";
 		$valor1 = $this->activarProducto;

 		$item2 = "id";
 		$valor2 = $this->activarId;

 		$respuesta = ProductsModel::updateProducts($table, $item1, $valor1, $item2, $valor2);

 		echo $respuesta;
 	}

 	public $validarCategoria;

 	public function validateCategory()
 	{	
 		$item = "categoria";
 		$valor = $this->validarCategoria;

 		$response = CategoriesController::showCategories($item, $valor);

 		echo json_encode($response);
 	}

 	public $idCategoria;

 	public function editCategory()
 	{	
 		$item = "id";
 		$valor = $this->idCategoria;

 		$response = CategoriesController::showCategories($item, $valor);

 		echo json_encode($response);
 	}

}

/*=============================================
ACTIVAR CATEGORÍA
=============================================*/ 
if (isset($_POST["activarProducto"])) {
	$activarProducto = new AjaxProducts();
	$activarProducto->activarProducto = $_POST["activarProducto"];
	$activarProducto->activarId = $_POST["activarId"];
	$activarProducto->activateProduct();
}

//VALIDAR NO REPETIR CATEGORIA
if (isset($_POST["validarCategoria"])) {
	$validarCategoria = new AjaxCategories();
	$validarCategoria->validarCategoria = $_POST["validarCategoria"];
	$validarCategoria->validateCategory();
}

if (isset($_POST["idCategoria"])) {
	$editCategory = new AjaxCategories();
	$editCategory->idCategoria = $_POST["idCategoria"];
	$editCategory->editCategory();
}

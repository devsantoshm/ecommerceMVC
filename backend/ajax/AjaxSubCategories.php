<?php
require_once "../controllers/SubCategoriesController.php";
require_once "../models/SubCategoriesModel.php";

require_once "../controllers/CategoriesController.php";
require_once "../models/CategoriesModel.php";

require_once "../controllers/ProductsController.php";
require_once "../models/ProductsModel.php";

class AjaxSubCategories{

	public $activarSubCategoria;
	public $activarId;

 	public function activateSubCategory()
 	{	
 		$tabla = "subcategories";
 		$item1 = "estado";
 		$valor1 = $this->activarSubCategoria;
 		$item2 = "id";
 		$valor2 = $this->activarId;

 		ProductsModel::updateProducts("products", $item1, $valor1, "id_subcategoria", $valor2);
 		
 		$response = SubCategoriesModel::updateSubCategories($tabla, $item1, $valor1, $item2, $valor2);

 		echo $response;
 	}

 	public $validarSubCategoria;

 	public function validateSubCategory()
 	{	
 		$item = "subcategoria";
 		$valor = $this->validarSubCategoria;

 		$response = SubCategoriesController::showSubCategories($item, $valor);

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
if (isset($_POST["activarSubCategoria"])) {
	$activarSubCategoria = new AjaxSubCategories();
	$activarSubCategoria->activarSubCategoria = $_POST["activarSubCategoria"];
	$activarSubCategoria->activarId = $_POST["activarId"];
	$activarSubCategoria->activateSubCategory();
}

//VALIDAR NO REPETIR CATEGORIA
if (isset($_POST["validarSubCategoria"])) {
	$validarSubCategoria = new AjaxSubCategories();
	$validarSubCategoria->validarSubCategoria = $_POST["validarSubCategoria"];
	$validarCategoria->validateSubCategory();
}

if (isset($_POST["idCategoria"])) {
	$editCategory = new AjaxCategories();
	$editCategory->idCategoria = $_POST["idCategoria"];
	$editCategory->editCategory();
}

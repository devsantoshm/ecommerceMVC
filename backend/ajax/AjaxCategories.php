<?php
//require_once "../controllers/CategoriesController.php";
require_once "../models/CategoriesModel.php";

//require_once "../controllers/SubCategoriesController.php";
require_once "../models/SubCategoriesModel.php";

//require_once "../controllers/ProductsController.php";
require_once "../models/ProductsModel.php";

class AjaxCategories{

	public $activarCategoria;
	public $activarId;

 	public function activateCategory()
 	{	
 		SubCategoriesModel::updateSubCategories("subcategories", "estado", $this->activarCategoria, "id_categoria", $this->activarId);
 		ProductsModel::updateProducts("products", "estado", $this->activarCategoria, "id_categoria", $this->activarId);
 		$response = CategoriesModel::updateCategory("categories", "estado", $this->activarCategoria, "id", $this->activarId);

 		echo $response;
 	}
}

/*=============================================
ACTIVAR CATEGORÍA
=============================================*/ 
if (isset($_POST["activarCategoria"])) {
	$activarCategoria = new AjaxCategories();
	$activarCategoria->activarCategoria = $_POST["activarCategoria"];
	$activarCategoria->activarId = $_POST["activarId"];
	$activarCategoria->activateCategory();
}
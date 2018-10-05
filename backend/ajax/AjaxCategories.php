<?php
require_once "../controllers/CategoriesController.php";
require_once "../models/CategoriesModel.php";

class AjaxCategories{

	public $activarCategoria;
	public $activarId;

 	public function activateCategory()
 	{	
 		$response = CategoriesModel::updateCategory("categories", "estado", $this->activarCategoria, "id", $this->activarId);

 		//echo $response;
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
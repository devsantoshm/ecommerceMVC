<?php  

class SubCategoriesController
{	
	static public function showSubCategories($item, $valor)
	{
		$tabla = "subcategories";
		$response = SubCategoriesModel::showSubCategories($tabla, $item, $valor);

		return $response;
	}
}

?>
<?php  

class SubCategoriesController
{	
	static public function showCategories($item, $valor)
	{
		$tabla = "categories";
		$response = CategoriesModel::showCategories($tabla, $item, $valor);

		return $response;
	}
}

?>
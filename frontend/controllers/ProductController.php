<?php  
class ProductController
{
	static public function showCategories($item, $valor)
	{
		$table = "categories";
		$response = ProductModel::showCategories($table, $item, $valor);
		return $response;
	}

	static public function showSubCategories($item, $valor)
	{
		$table = "subcategories";
		$response = ProductModel::showSubCategories($table, $item, $valor);
		return $response;
	}
}
?>
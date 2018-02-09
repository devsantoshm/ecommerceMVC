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

	static public function showProducts($ordenar, $item, $valor, $base, $tope)
	{
		$table = "products";
		$response = ProductModel::showProducts($table, $ordenar, $item, $valor, $base, $tope);
		return $response;
	}

	static public function showInfoProduct($item, $valor)
	{
		$table = "products";
		$response = ProductModel::showInfoProduct($table, $item, $valor);
		return $response;
	}
}
?>
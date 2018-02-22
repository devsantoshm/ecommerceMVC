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

	static public function showProducts($ordenar, $item, $valor, $base, $tope, $modo)
	{
		$table = "products";
		$response = ProductModel::showProducts($table, $ordenar, $item, $valor, $base, $tope, $modo);
		return $response;
	}

	static public function showInfoProduct($item, $valor)
	{
		$table = "products";
		$response = ProductModel::showInfoProduct($table, $item, $valor);
		return $response;
	}

	static public function listProducts($ordenar, $item, $valor)
	{
		$table = "products";
		$response = ProductModel::listProducts($table, $ordenar, $item, $valor);
		return $response;
	}

	static public function showBanner($ruta)
	{
		$table = "banner";
		$response = ProductModel::showBanner($table, $ruta);
		return $response;
	}

	static public function searchProducts($busqueda, $ordenar, $modo, $base, $tope)
	{
		$table = "products";
		$response = ProductModel::searchProducts($table, $busqueda, $ordenar, $modo, $base, $tope);
		return $response;
	}

	static public function listProductsSearch($busqueda)
	{
		$table = "products";
		$response = ProductModel::listProductsSearch($table, $busqueda);
		return $response;
	}

	static public function updateViewProduct($datos, $item)
	{
		$table = "products";
		$response = ProductModel::updateViewProduct($table, $datos, $item);
		return $response;
	}
}
?>
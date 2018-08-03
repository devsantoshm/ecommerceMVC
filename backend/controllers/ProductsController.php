<?php  

class ProductsController
{
	static public function showProductsTotal($orden)
	{
		$table = "products";
		$response = ProductsModel::showProductsTotal($table, $orden);

		return $response; 
	}

	static public function showSalesTotal()
	{
		$table = "products";
		$response = ProductsModel::showSalesTotal($table);

		return $response; 
	}
}

?>
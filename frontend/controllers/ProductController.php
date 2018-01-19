<?php  
class ProductController
{
	public function showCategories()
	{
		$table = "categories";
		$response = ProductModel::showCategories($table);
		return $response;
	}

	static public function showSubCategories($id)
	{
		$table = "subcategories";
		$response = ProductModel::showSubCategories($table, $id);
		return $response;
	}
}
?>
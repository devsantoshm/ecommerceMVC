<?php  

class SalesController
{
	public function showSalesTotal()
	{
		$table = "shopping";
		$response = SalesModel::showSalesTotal($table);

		return $response; 
	}

	public function showSales()
	{
		$table = "shopping";
		$response = SalesModel::showSales($table);

		return $response; 
	}
}

?>
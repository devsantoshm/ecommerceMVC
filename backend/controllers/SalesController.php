<?php  

class SalesController
{
	public function showSalesTotal()
	{
		$table = "shopping";
		$response = SalesModel::showSalesTotal($table);

		return $response; 
	}
}

?>
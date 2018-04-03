<?php  
class CarController
{
	static public function showRates()
	{
		$table = "commerce";
		$response = CarModel::showRates($table);
		return $response;
	}
}
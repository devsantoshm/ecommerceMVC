<?php  
class CarController
{
	static public function showRates()
	{
		$table = "commerce";
		$response = CarModel::showRates($table);
		return $response;
	}

	static public function newShopping($data)
	{
		$table = "shopping";
		$response = CarModel::newShopping($table, $data);

		return $response;
	}
}
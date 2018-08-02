<?php  

class VisitsController
{
	public function showVisitsTotal()
	{
		$table = "visitscountry";
		$response = VisitsModel::showVisitsTotal($table);

		return $response; 
	}

	static public function showCountries($orden)
	{
		$table = "visitscountry";
		$response = VisitsModel::showCountries($table, $orden);

		return $response; 
	}
}

?>
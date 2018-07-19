<?php  

class VisitsController
{
	public function showVisitsTotal()
	{
		$table = "visitscountry";
		$response = VisitsModel::showVisitsTotal($table);

		return $response; 
	}
}

?>
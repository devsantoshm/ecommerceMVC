<?php  

class CommerceController
{
	static public function selectTemplate()
	{
		$table = "template";
		$response = CommerceModel::selectTemplate($table);

		return $response; 
	}
}

?>
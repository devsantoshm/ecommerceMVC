<?php  

class UsersController
{
	static public function showUsersTotal($orden)
	{
		$table = "users";
		$response = UsersModel::showUsersTotal($table, $orden);

		return $response; 
	}
}

?>
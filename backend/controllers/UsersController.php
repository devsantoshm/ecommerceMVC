<?php  

class UsersController
{
	static public function showUsersTotal($orden)
	{
		$table = "users";
		$response = UsersModel::showUsersTotal($table, $orden);

		return $response; 
	}

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/
	static public function showUsers($item, $valor){

		$tabla = "users";

		$respuesta = UsersModel::showUsers($tabla, $item, $valor);

		return $respuesta;
	}
}

?>
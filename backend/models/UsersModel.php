<?php  

require_once "conexion.php";

class UsersModel
{
	//método estático por que recibe parámetro
	static public function showUsersTotal($table, $orden)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table order by $orden desc");
		$stmt->execute();
		
		return $stmt->fetchAll();
	}
}

?>
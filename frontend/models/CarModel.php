<?php  
require_once "conexion.php";

class CarModel
{
	static public function showRates($table)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table");
		$stmt->execute();
		return $stmt->fetch();
	}
}
<?php  

require_once "conexion.php";

class VisitsModel
{
	//método estático por que recibe parámetro
	static public function showVisitsTotal($table)
	{
		$stmt = Conexion::conectar()->prepare("select SUM(cantidad) as total from $table");
		$stmt->execute();
		return $stmt->fetch();
	}
}

?>
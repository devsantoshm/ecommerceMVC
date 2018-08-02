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

	//mostrar paises por la cantidad mas alta de visitantes
	static public function showCountries($table, $orden)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table order by $orden desc");
		$stmt->execute();
		return $stmt->fetchAll();
	}
}

?>
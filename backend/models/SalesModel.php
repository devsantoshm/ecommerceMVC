<?php  

require_once "conexion.php";

class SalesModel
{
	static public function showSalesTotal($table)
	{
		$stmt = Conexion::conectar()->prepare("select SUM(pago) as total from $table");
		$stmt->execute();
		return $stmt->fetch();
	}

	static public function showSales($table)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table");
		$stmt->execute();
		return $stmt->fetchAll();
	}
}

?>
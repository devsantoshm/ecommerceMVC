<?php  

require_once "conexion.php";

class ProductsModel
{
	//método estático por que recibe parámetro
	static public function showProductsTotal($table, $orden)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table order by $orden desc");
		$stmt->execute();
		
		return $stmt->fetchAll();
	}

	static public function showSalesTotal($table)
	{
		$stmt = Conexion::conectar()->prepare("select SUM(ventas) as total from $table");
		$stmt->execute();
		return $stmt->fetch();
	}
}

?>
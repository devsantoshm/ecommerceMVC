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

	static public function updateProducts($table, $item1, $valor1, $item2, $valor2)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $table SET $item1 = :valor1 WHERE $item2 = :valor2");
		$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":valor2", $valor2, PDO::PARAM_STR);
		
		if($stmt->execute()){
			return "ok";
		}
		else{ 
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
}

?>
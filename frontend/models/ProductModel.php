<?php  
require_once "conexion.php";

class ProductModel
{
	static public function showCategories($table, $item, $valor)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor");
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("select * from $table");
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}

	static public function showSubCategories($table, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor");
		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetchAll();
	}
}
?>
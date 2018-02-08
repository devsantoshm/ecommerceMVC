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

	static public function showProducts($table, $ordenar, $item, $valor)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor order by $ordenar desc limit 4");
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		//traer cuatro productos ordenados por los mas vistos o vendidos
		}else{
			$stmt = Conexion::conectar()->prepare("select * from $table order by $ordenar desc limit 4");
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}

	static public function showInfoProduct($table, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor");
		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}
}
?>
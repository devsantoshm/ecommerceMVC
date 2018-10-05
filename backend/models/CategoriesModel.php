<?php  
require_once "conexion.php";

class CategoriesModel
{
	static public function showCategories($table, $item, $valor)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor");
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("select * from $table order by id desc");
			$stmt->execute();
			return $stmt->fetchAll();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function updateCategory($table, $item1, $valor1, $item2, $valor2)
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
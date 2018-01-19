<?php  
require_once "conexion.php";

class ProductModel
{
	static public function showCategories($table)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	static public function showSubCategories($table, $id)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where id_categoria = :id_categoria");
		$stmt->bindParam(":id_categoria", $id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll();
	}
}
?>
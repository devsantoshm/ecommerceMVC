<?php  

require_once "conexion.php";

class CommerceModel
{
	//método estático por que recibe parámetro
	static public function selectTemplate($table)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table");
		$stmt->execute();
		
		return $stmt->fetch();
	}

	static public function updateLogoIcon($table, $id, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("update $table set $item = :valor where id = :id");
		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		
		if($stmt->execute())
			return "ok";
		else 
			return "error";
	}
}

?>
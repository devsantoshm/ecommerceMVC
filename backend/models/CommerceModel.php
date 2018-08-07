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
}

?>
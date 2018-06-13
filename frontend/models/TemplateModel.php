<?php  
require_once "conexion.php";

class TemplateModel
{	
	static public function templateStyle($table)
	{	
		$stmt = Conexion::conectar()->prepare("select * from $table");
		$stmt->execute();
		return $stmt->fetch(); // retorno un solo registro
		$stmt->close();
	}

	static public function getHeaders($table, $ruta)
	{	
		$stmt = Conexion::conectar()->prepare("select * from $table where ruta = :ruta");
		$stmt->bindParam(":ruta", $ruta, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(); // retorno un solo registro
		$stmt->close();
	}
}
?>
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

	static public function updateColors($table, $id, $datos)
	{
		$stmt = Conexion::conectar()->prepare("update $table set barraSuperior = :barraSuperior, textoSuperior = :textoSuperior, colorFondo = :colorFondo, colorTexto = :colorTexto where id = :id");
		$stmt->bindParam(":barraSuperior", $datos["barraSuperior"], PDO::PARAM_STR);
		$stmt->bindParam(":textoSuperior", $datos["textoSuperior"], PDO::PARAM_STR);
		$stmt->bindParam(":colorFondo", $datos["colorFondo"], PDO::PARAM_STR);
		$stmt->bindParam(":colorTexto", $datos["colorTexto"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		
		if($stmt->execute()){
			return "ok";
		}
		else{ 
			return "error";
		}

		//$stmt->close();
		$stmt = null;
	}
}

?>
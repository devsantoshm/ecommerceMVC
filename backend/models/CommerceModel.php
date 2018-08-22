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

		$stmt->close();
		$stmt = null;
	}

	static public function updateScript($table, $id, $datos)
	{
		$stmt = Conexion::conectar()->prepare("update $table set apiFacebook = :apiFacebook, pixelFacebook = :pixelFacebook, googleAnalytics = :googleAnalytics where id = :id");
		$stmt->bindParam(":apiFacebook", $datos["apiFacebook"], PDO::PARAM_STR);
		$stmt->bindParam(":pixelFacebook", $datos["pixelFacebook"], PDO::PARAM_STR);
		$stmt->bindParam(":googleAnalytics", $datos["googleAnalytics"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		
		if($stmt->execute()){
			return "ok";
		}
		else{ 
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function selectCommerce($table)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table");
		$stmt->execute();
		
		return $stmt->fetch();
	}

	static public function updateInformation($table, $id, $datos)
	{
		$stmt = Conexion::conectar()->prepare("update $table set impuesto = :impuesto, envioNacional = :envioNacional, envioInternacional = :envioInternacional, tasaMinimaNal = :tasaMinimaNal, tasaMinimaInt = :tasaMinimaInt, pais = :pais, modoPaypal = :modoPaypal, clienteIdPaypal = :clienteIdPaypal, llaveSecretaPaypal = :llaveSecretaPaypal where id = :id");
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":envioNacional", $datos["envioNacional"], PDO::PARAM_STR);
		$stmt->bindParam(":envioInternacional", $datos["envioInternacional"], PDO::PARAM_STR);
		$stmt->bindParam(":tasaMinimaNal", $datos["tasaMinimaNal"], PDO::PARAM_STR);
		$stmt->bindParam(":tasaMinimaInt", $datos["tasaMinimaInt"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datos["seleccionarPais"], PDO::PARAM_STR);
		$stmt->bindParam(":modoPaypal", $datos["modoPaypal"], PDO::PARAM_STR);
		$stmt->bindParam(":clienteIdPaypal", $datos["clienteIdPaypal"], PDO::PARAM_STR);
		$stmt->bindParam(":llaveSecretaPaypal", $datos["llaveSecretaPaypal"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		
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
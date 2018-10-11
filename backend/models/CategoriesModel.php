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

	static public function createCategory($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria, ruta, estado, oferta, precioOferta, descuentoOferta, imgOferta, finOferta) VALUES (:categoria, :ruta, :estado, :oferta, :precioOferta, :descuentoOferta, :imgOferta, :finOferta)");

		$stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":finOferta", $datos["finOferta"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
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
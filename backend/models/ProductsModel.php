<?php  

require_once "conexion.php";

class ProductsModel
{
	//método estático por que recibe parámetro
	static public function showProductsTotal($table, $orden)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table order by $orden desc");
		$stmt->execute();
		
		return $stmt->fetchAll();
	}

	static public function showSalesTotal($table)
	{
		$stmt = Conexion::conectar()->prepare("select SUM(ventas) as total from $table");
		$stmt->execute();
		return $stmt->fetch();
	}

	static public function updateProducts($table, $item1, $valor1, $item2, $valor2)
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

	static public function updateOfertaProductos($table, $datos, $ofertadoPor)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $table SET $ofertadoPor = :ofertadoPor, oferta = :oferta, precioOferta = :precioOferta, descuentoOferta = :descuentoOferta, imgOferta = :imgOferta, finOferta = :finOferta WHERE id_categoria = :id_categoria");
		$stmt->bindParam(":ofertadoPor", $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
		$stmt->bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":descuentoOferta", $datos["descuentoOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":imgOferta", $datos["imgOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":finOferta", $datos["finOferta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datos["id"], PDO::PARAM_INT);
		
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
<?php  

require_once "conexion.php";

class SalesModel
{
	static public function showSalesTotal($table)
	{
		$stmt = Conexion::conectar()->prepare("select SUM(pago) as total from $table");
		$stmt->execute();
		return $stmt->fetch();
	}

	static public function showSales($table)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table");
		$stmt->execute();
		return $stmt->fetchAll();
	}

	/*=============================================
	ACTUALIZAR ENVIO VENTA
	=============================================*/
	static public function updateSales($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();
		$stmt = null;
	}
}

?>
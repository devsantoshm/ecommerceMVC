<?php  
require_once "conexion.php";

class CarModel
{
	static public function showRates($table)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table");
		$stmt->execute();
		return $stmt->fetch();
	}

	static public function newShopping($table, $data)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $table(id_usuario, id_producto, metodo, email, direccion, pais) VALUES(:id_usuario, :id_producto, :metodo, :email, :direccion, :pais)");
		$stmt->bindParam(":id_usuario", $data["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $data["idProducto"], PDO::PARAM_INT);
		$stmt->bindParam(":metodo", $data["metodo"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $data["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $data["pais"], PDO::PARAM_STR);

		if($stmt->execute())
			return "ok";
		else
			return "error";
	}
}
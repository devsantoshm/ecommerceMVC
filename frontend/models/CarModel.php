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
		$stmt = Conexion::conectar()->prepare("INSERT INTO $table(id_usuario, id_producto, metodo, email, direccion, pais, pago) VALUES(:id_usuario, :id_producto, :metodo, :email, :direccion, :pais, :pago)");
		$stmt->bindParam(":id_usuario", $data["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $data["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":metodo", $data["metodo"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $data["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $data["pais"], PDO::PARAM_STR);
		$stmt->bindParam(":pago", $data["pago"], PDO::PARAM_STR);

		if($stmt->execute())
			return "ok";
		else
			return "error";


		$stmt->close();
		$stmt = null;

	}

	static public function verifyProduct($table, $data)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where id_usuario = :id_usuario and id_producto = :id_producto");
		$stmt->bindParam(":id_usuario", $data["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $data["idProducto"], PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(); 
	}
}
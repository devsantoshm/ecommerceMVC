<?php  
require_once "conexion.php";

class UserModel
{
	static public function registerUser($table, $data)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $table(nombre, password, email, foto, modo, verificacion, emailEncriptado) VALUES(:nombre, :password, :email, :foto, :modo, :verificacion, :emailEncriptado)");
		$stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $data["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":modo", $data["modo"], PDO::PARAM_STR);
		$stmt->bindParam(":verificacion", $data["verificacion"], PDO::PARAM_INT);
		$stmt->bindParam(":emailEncriptado", $data["emailEncriptado"], PDO::PARAM_STR);

		if($stmt->execute())
			return "ok";
		else
			return "error";
	}

	static public function showUser($table, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor");
		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}

	static public function updateUser($table, $id, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("update $table set $item = :valor where id = :id");
		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		
		if($stmt->execute())
			return "ok";
		else 
			return "error";
	}

	static public function updatePerfil($table, $data)
	{
		$stmt = Conexion::conectar()->prepare("update $table set nombre = :nombre, email = :email, password = :password, foto = :foto where id = :id");
		$stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $data["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $data["id"], PDO::PARAM_STR);
		
		if($stmt->execute())
			return "ok";
		else 
			return "error";
	}

	static public function showShopping($table, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor");
		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	static public function showCommentsProfile($table, $data)
	{
		if ($data["idUsuario"] != "") {
			$stmt = Conexion::conectar()->prepare("select * from $table where id_usuario = :id_usuario and id_producto = :id_producto");
			$stmt->bindParam(":id_usuario", $data["idUsuario"], PDO::PARAM_INT);
			$stmt->bindParam(":id_producto", $data["idProducto"], PDO::PARAM_INT);
			$stmt->execute();
			
			return $stmt->fetch();
			
		}else{
			$stmt = Conexion::conectar()->prepare("select * from $table where id_producto = :id_producto order by Rand()");
			$stmt->bindParam(":id_producto", $data["idProducto"], PDO::PARAM_INT);
			$stmt->execute();
			
			return $stmt->fetchAll();
		}
	}

	static public function updateCommentary($table, $data)
	{
		$stmt = Conexion::conectar()->prepare("update $table set calificacion = :calificacion, comentario = :comentario where id = :id");
		$stmt->bindParam(":calificacion", $data["calificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":comentario", $data["comentario"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $data["id"], PDO::PARAM_STR);
		
		if($stmt->execute())
			return "ok";
		else 
			return "error";
	}

	static public function addWish($table, $data)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $table(id_usuario, id_producto) VALUES(:id_usuario, :id_producto)");
		$stmt->bindParam(":id_usuario", $data["idUsuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $data["idProducto"], PDO::PARAM_INT);

		if($stmt->execute())
			return "ok";
		else
			return "error";
	}

	static public function showWishes($table, $item)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where id_usuario = :id_usuario");
		$stmt->bindParam(":id_usuario", $item, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}
?>
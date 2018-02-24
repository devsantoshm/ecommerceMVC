<?php  
require_once "conexion.php";

class UserModel
{
	static public function registerUser($table, $data)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $table(nombre, password, email, modo, verificacion) VALUES(:nombre, :password, :email, :modo, :verificacion)");
		$stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":modo", $data["modo"], PDO::PARAM_STR);
		$stmt->bindParam(":verificacion", $data["verificacion"], PDO::PARAM_INT);

		if($stmt->execute())
			return "ok";
		else
			return "error";
	}
}
?>
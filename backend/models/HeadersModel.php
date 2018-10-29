<?php  
require_once "conexion.php";

class HeadersModel
{
	static public function showHeaders($table, $item, $valor)
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

	static public function createHeader($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (ruta, titulo, descripcion, palabrasClave, portada) VALUES (:ruta, :titulo, :descripcion, :palabrasClave, :portada)");

		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":palabrasClave", $datos["palabrasClave"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["imgPortada"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function editHeader($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ruta = :ruta, titulo = :titulo, descripcion = :descripcion, palabrasClave = :palabrasClave, portada = :portada WHERE id = :id");

		$stmt->bindParam(":ruta", $datos["ruta"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":palabrasClave", $datos["palabrasClave"], PDO::PARAM_STR);
		$stmt->bindParam(":portada", $datos["imgPortada"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["idCabecera"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
}
?>
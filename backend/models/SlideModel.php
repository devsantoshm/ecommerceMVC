<?php  

require_once "conexion.php";

class SlideModel
{
	//método estático por que recibe parámetro
	static public function showSlide($table)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table order by orden asc");
		$stmt->execute();
		
		return $stmt->fetchAll();
	}

	static public function createSlide($table, $datos, $orden)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $table(imgFondo, tipoSlide, estiloTextoSlide, titulo1, titulo2, titulo3, boton, url, orden) VALUES(:imgFondo, :tipoSlide, :estiloTextoSlide, :titulo1, :titulo2, :titulo3, :boton, :url, :orden)");
		$stmt->bindParam(":imgFondo", $datos["imgFondo"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoSlide", $datos["tipoSlide"], PDO::PARAM_STR);
		$stmt->bindParam(":estiloTextoSlide", $datos["estiloTextoSlide"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo1", $datos["titulo1"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo2", $datos["titulo2"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo3", $datos["titulo3"], PDO::PARAM_STR);
		$stmt->bindParam(":boton", $datos["boton"], PDO::PARAM_STR);
		$stmt->bindParam(":url", $datos["url"], PDO::PARAM_STR);
		$stmt->bindParam(":orden", $orden, PDO::PARAM_INT);
		
		if($stmt->execute()){
			return "ok";
		}
		else{ 
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function updateOrderSlide($table, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $table SET orden = :orden where id = :id");
		$stmt->bindParam(":orden", $datos["orden"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		
		if($stmt->execute()){
			return "ok";
		}
		else{ 
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function updateSlide($table, $rutaFondo, $rutaProducto, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $table SET nombre = :nombre, tipoSlide = :tipoSlide, estiloImgProducto = :estiloImgProducto, estiloTextoSlide = :estiloTextoSlide, imgFondo = :imgFondo, imgProducto = :imgProducto, titulo1 = :titulo1, titulo2 = :titulo2, titulo3 = :titulo3, boton = :boton, url = :url where id = :id");
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoSlide", $datos["tipoSlide"], PDO::PARAM_STR);
		$stmt->bindParam(":estiloImgProducto", $datos["estiloImgProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":estiloTextoSlide", $datos["estiloTextoSlide"], PDO::PARAM_STR);
		$stmt->bindParam(":imgFondo", $rutaFondo, PDO::PARAM_STR);
		$stmt->bindParam(":imgProducto", $rutaProducto, PDO::PARAM_STR);
		$stmt->bindParam(":titulo1", $datos["titulo1"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo2", $datos["titulo2"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo3", $datos["titulo3"], PDO::PARAM_STR);
		$stmt->bindParam(":boton", $datos["boton"], PDO::PARAM_STR);
		$stmt->bindParam(":url", $datos["url"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		
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
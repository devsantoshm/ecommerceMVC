<?php  
require_once "conexion.php";

class ProductModel
{
	static public function showCategories($table, $item, $valor)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor");
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = Conexion::conectar()->prepare("select * from $table");
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}

	static public function showSubCategories($table, $item, $valor)
	{
		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor");
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();

		} else{

			$stmt = Conexion::conectar()->prepare("select * from $table");
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}

	static public function showProducts($table, $ordenar, $item, $valor, $base, $tope, $modo)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor order by $ordenar $modo limit $base, $tope");
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		//traer cuatro productos ordenados por los mas vistos o vendidos
		}else{
			$stmt = Conexion::conectar()->prepare("select * from $table order by $ordenar $modo limit $base, $tope");
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}

	static public function showInfoProduct($table, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor");
		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt->execute();
		
		return $stmt->fetch();

		$stmt -> close();
		$stmt = null;
	}

	static public function listProducts($table, $ordenar, $item, $valor)
	{
		if ($item != null) {
			$stmt = Conexion::conectar()->prepare("select * from $table where $item = :valor order by $ordenar desc");
			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		//traer cuatro productos ordenados por los mas vistos o vendidos
		}else{
			$stmt = Conexion::conectar()->prepare("select * from $table order by $ordenar desc");
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}

	static public function showBanner($table, $ruta)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where ruta = :valor");
		$stmt->bindParam(":valor", $ruta, PDO::PARAM_STR);
		$stmt->execute();

		return $stmt->fetch();
	}

	static public function searchProducts($table, $busqueda, $ordenar, $modo, $base, $tope)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where ruta like '%$busqueda%' or titulo like '%$busqueda%' or titular like '%$busqueda%' or descripcion like '%$busqueda%' order by $ordenar $modo limit $base, $tope");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	static public function listProductsSearch($table, $busqueda)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where ruta like '%$busqueda%' or titulo like '%$busqueda%' or titular like '%$busqueda%' or descripcion like '%$busqueda%'");
		$stmt->execute();

		return $stmt->fetchAll();
	}

	static public function updateProduct($table, $item1, $valor1, $item2, $valor2)
	{
		$stmt = Conexion::conectar()->prepare("update $table set $item1 = :valor1 where $item2 = :valor2");
		$stmt->bindParam(":valor1", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":valor2", $valor2, PDO::PARAM_STR);
		
		if($stmt->execute())
			return "ok";
		else
			return "error";
	}
}
?>
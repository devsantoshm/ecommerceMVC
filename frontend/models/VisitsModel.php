<?php  

require_once "conexion.php";

class VisitsModel
{

	static public function selectIp($table, $ip)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where ip = :ip");
		$stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	static public function saveIp($table, $ip, $pais, $visita)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $table(ip, pais, visitas) VALUES(:ip, :pais, :visitas)");

		$stmt->bindParam(":ip", $ip, PDO::PARAM_STR);
		$stmt->bindParam(":pais", $pais, PDO::PARAM_STR);
		$stmt->bindParam(":visitas", $visita, PDO::PARAM_INT);

		if($stmt->execute())
			return "ok";
		else
			return "error";
	}

	static public function selectCountry($table, $pais)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table where pais = :pais");
		$stmt->bindParam(":pais", $pais, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}

	static public function insertCountry($table, $pais, $cantidad)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $table(pais, cantidad) VALUES(:pais, :cantidad)");

		$stmt->bindParam(":pais", $pais, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);

		if($stmt->execute())
			return "ok";
		else
			return "error";
	}

	static public function updateCountry($table, $pais, $actualizarCantidad)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $table SET cantidad = :cantidad WHERE pais = :pais");

		$stmt->bindParam(":cantidad", $actualizarCantidad, PDO::PARAM_INT);
		$stmt->bindParam(":pais", $pais, PDO::PARAM_STR);

		if($stmt->execute())
			return "ok";
		else
			return "error";
	}

	static public function showTotalVisits($table)
	{
		$stmt = Conexion::conectar()->prepare("select sum(cantidad) as total from $table");
		$stmt->execute();
		return $stmt->fetch();
	}

	static public function showCountries($table)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table order by cantidad desc limit 6");
		$stmt->execute();
		return $stmt->fetchAll();
	}
}

?>
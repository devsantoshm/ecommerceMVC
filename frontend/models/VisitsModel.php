<?php  

require_once "conexion.php";

class VisitsModel
{
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
}

?>
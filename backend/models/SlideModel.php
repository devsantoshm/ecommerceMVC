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
}

?>
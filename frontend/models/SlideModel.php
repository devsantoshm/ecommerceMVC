<?php
require_once "conexion.php";

class SlideModel
{
	static public function showSlide($table)
	{
		$stmt = Conexion::conectar()->prepare("select * from $table");
		$stmt->execute();

		return $stmt->fetchAll();
	}
}
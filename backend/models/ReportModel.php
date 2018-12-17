<?php

require_once "conexion.php";

class ReportModel{
		
	/*=============================================
	DESCARGAR REPORTE
	=============================================*/
	static public function downloadReport($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
		
		$stmt = null;
	
	}

}
<?php 
Class TemplateController
{
	public function template()
	{
		include "views/template.php";
	}

	public function templateStyle()
	{
		$table = "template";
		$response = TemplateModel::templateStyle($table);
		return $response;
	}

	static public function getHeaders($ruta)
	{
		$table = "headers";
		$response = TemplateModel::getHeaders($table, $ruta);
		return $response;
	}
}

?>
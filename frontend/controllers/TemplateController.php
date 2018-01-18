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
}

?>
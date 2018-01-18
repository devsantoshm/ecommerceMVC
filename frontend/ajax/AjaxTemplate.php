<?php
require_once "../controllers/TemplateController.php";
require_once "../models/TemplateModel.php";

class AjaxTemplate
{
	public function ajaxTemplateStyle()
	{
		$response = TemplateController::templateStyle();
		echo json_encode($response); //convertir un array en un string
	}
}

$obj = new AjaxTemplate();
$obj->ajaxTemplateStyle();
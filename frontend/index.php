<?php
require_once "controllers/TemplateController.php";
require_once "models/TemplateModel.php";

require_once "controllers/ProductController.php";
require_once "models/ProductModel.php";

$template = new TemplateController();
$template->template();



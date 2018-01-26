<?php
require_once "controllers/TemplateController.php";
require_once "models/TemplateModel.php";

require_once "controllers/ProductController.php";
require_once "models/ProductModel.php";

require_once "controllers/SlideController.php";
require_once "models/SlideModel.php";

require_once "models/routes.php";

$template = new TemplateController();
$template->template();



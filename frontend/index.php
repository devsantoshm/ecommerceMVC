<?php
require_once "controllers/TemplateController.php";
require_once "models/TemplateModel.php";

require_once "controllers/ProductController.php";
require_once "models/ProductModel.php";

require_once "controllers/SlideController.php";
require_once "models/SlideModel.php";

require_once "controllers/UserController.php";
require_once "models/UserModel.php";

require_once "controllers/CarController.php";
require_once "models/CarModel.php";

require_once "controllers/VisitsController.php";
require_once "models/VisitsModel.php";

require_once "controllers/NotificationsController.php";
require_once "models/NotificationsModel.php";

require_once "models/routes.php";

require_once "extensiones/PHPMailer/PHPMailerAutoload.php";
require_once "extensiones/vendor/autoload.php";

$template = new TemplateController();
$template->template();



<?php
require_once "controllers/TemplateController.php";

require_once "controllers/ManagersController.php";
require_once "models/ManagersModel.php";

require_once "controllers/BannerController.php";
require_once "models/BannerModel.php";

require_once "controllers/CategoriesController.php";
require_once "models/CategoriesModel.php";

require_once "controllers/subCategoriesController.php";
require_once "models/SubCategoriesModel.php";

require_once "controllers/HeadersController.php";
require_once "models/HeadersModel.php";

require_once "controllers/CommerceController.php";
require_once "models/CommerceModel.php";

require_once "controllers/MessagesController.php";
require_once "models/MessagesModel.php";

require_once "controllers/ProductsController.php";
require_once "models/ProductsModel.php";

require_once "controllers/ProfilesController.php";
require_once "models/ProfilesModel.php";

require_once "controllers/SalesController.php";
require_once "models/SalesModel.php";

require_once "controllers/VisitsController.php";
require_once "models/VisitsModel.php";

require_once "controllers/SlideController.php";
require_once "models/SlideModel.php";

require_once "controllers/UsersController.php";
require_once "models/UsersModel.php";

require_once "models/routes.php";

$template = new TemplateController();
$template->template();



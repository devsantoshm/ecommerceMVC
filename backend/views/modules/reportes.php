<?php

require_once "../../controllers/ReportController.php";
require_once "../../models/ReportModel.php";

require_once "../../controllers/ProductsController.php";
require_once "../../models/ProductsModel.php";

require_once "../../controllers/UsersController.php";
require_once "../../models/UsersModel.php";

$reporte = new ReportController();
$reporte -> downloadReport();
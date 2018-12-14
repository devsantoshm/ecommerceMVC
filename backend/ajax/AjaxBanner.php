<?php

require_once "../controllers/BannerController.php";
require_once "../models/BannerModel.php";

require_once "../models/CategoriesModel.php";
require_once "../models/SubCategoriesModel.php";

class AjaxBanner{

  /*=============================================
  ACTIVAR BANNER
  =============================================*/ 
  public $activarBanner;
  public $activarId;

  public function activateBanner(){

    $respuesta = BannerModel::updateStatusBanner("banner", "estado", $this->activarBanner, "id", $this->activarId);

    echo $respuesta;

  }


}

/*=============================================
ACTIVAR BANNER
=============================================*/
if(isset($_POST["activarBanner"])){

  $activarBanner = new AjaxBanner();
  $activarBanner -> activarBanner = $_POST["activarBanner"];
  $activarBanner -> activarId = $_POST["activarId"];
  $activarBanner -> activateBanner();

}

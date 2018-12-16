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

  /*=============================================
  TRAER RUTAS DE ACUERDO A LA TABLA
  =============================================*/ 
  public $tabla;

  public function ajaxTraerRutasBanner(){

    $tabla = $this->tabla;
    $item = null;
    $valor = null;

    if($tabla == "categories"){

        $respuesta = CategoriesModel::showCategories($tabla, $item, $valor);

        echo json_encode($respuesta);

    }

    if($tabla == "subcategories"){

          $respuesta = SubCategoriesModel::showSubCategories($tabla, $item, $valor);

          echo json_encode($respuesta);

    }

  }

  /*=============================================
  VALIDAR RUTA BANNER PARA NO REPETIRLA EN EL FRONTEND
  =============================================*/ 
  public $validarRuta;

    public function ajaxValidarRuta(){

      $item = "ruta";
      $valor = $this->validarRuta;

      $respuesta = BannerController::showBanner($item, $valor);

      echo json_encode($respuesta);

    }

   /*=============================================
    EDITAR BANNER
    =============================================*/ 
    public $idBanner;

    public function ajaxEditarBanner(){

      $item = "id";
      $valor = $this->idBanner;

      $respuesta = BannerController::showBanner($item, $valor);

      echo json_encode($respuesta);

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

/*=============================================
TRAER RUTAS DE ACUERDO A LA TABLA
=============================================*/
if(isset($_POST["tabla"])){

  $traerRutas = new AjaxBanner();
  $traerRutas -> tabla = $_POST["tabla"];
  $traerRutas -> ajaxTraerRutasBanner();

}

/*=============================================
VALIDAR NO REPETIR RUTA
=============================================*/
if(isset( $_POST["validarRuta"])){

  $valRuta = new AjaxBanner();
  $valRuta -> validarRuta = $_POST["validarRuta"];
  $valRuta -> ajaxValidarRuta();

}

/*=============================================
EDITAR BANNER
=============================================*/
if(isset($_POST["idBanner"])){

  $editar = new AjaxBanner();
  $editar -> idBanner = $_POST["idBanner"];
  $editar -> ajaxEditarBanner();

}


<?php

require_once "../controllers/SalesController.php";
require_once "../models/SalesModel.php";


class AjaxSales{

  /*=============================================
  ACTUALIZAR PROCESO DE ENVÍO
  =============================================*/
  public $idVenta;
  public $etapa;

  public function ajaxEnvioVenta(){

    $respuesta = SalesModel::updateSales("shopping", "envio", $this->etapa, "id", $this->idVenta);

    echo $respuesta;

  }

}

/*=============================================
ACTUALIZAR PROCESO DE ENVÍO
=============================================*/
if(isset($_POST["idVenta"])){

  $envioVenta = new AjaxSales();
  $envioVenta -> idVenta = $_POST["idVenta"];
  $envioVenta -> etapa = $_POST["etapa"];
  $envioVenta -> ajaxEnvioVenta();

}


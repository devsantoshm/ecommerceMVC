<?php

require_once "../controllers/UsersController.php";
require_once "../models/UsersModel.php";

class AjaxUsers{

  /*=============================================
  ACTIVAR USUARIOS
  =============================================*/ 
  public $activarUsuario;
  public $activarId;

  public function ajaxActivarUsuario(){

    $respuesta = UsersModel::updateActivateUser("users", "verificacion", $this->activarUsuario, "id", $this->activarId);

    echo $respuesta;

  }

}

/*=============================================
ACTIVAR CATEGORIA
=============================================*/
if(isset($_POST["activarUsuario"])){

  $activarUsuario = new AjaxUsers();
  $activarUsuario -> activarUsuario = $_POST["activarUsuario"];
  $activarUsuario -> activarId = $_POST["activarId"];
  $activarUsuario -> ajaxActivarUsuario();

}
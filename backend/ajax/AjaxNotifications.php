<?php

require_once "../models/NotificationsModel.php";

Class AjaxNotifications{

	/*=============================================
	ACTUALIZAR NOTIFICACIONES
	=============================================*/
	public $item;

	public function updateNotifications(){

		$item = $this->item;
		$valor = 0;

		$respuesta = NotificationsModel::updateNotifications("notifications", $item, $valor);

		echo $respuesta;

	}		

}

if(isset($_POST["item"])){

	$actualizarNotificaciones = new AjaxNotifications();
	$actualizarNotificaciones -> item = $_POST["item"];
	$actualizarNotificaciones -> updateNotifications();

}

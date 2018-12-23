<?php

Class NotificationsController{

	/*=============================================
	MOSTRAR NOTIFICACIONES
	=============================================*/
	static public function showNotifications(){

		$tabla = "notifications";

		$respuesta = NotificationsModel::showNotifications($tabla);

		return $respuesta;

	}

}
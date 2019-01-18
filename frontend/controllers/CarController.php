<?php  
class CarController
{
	static public function showRates()
	{
		$table = "commerce";
		$response = CarModel::showRates($table);
		return $response;
	}

	static public function newShopping($data)
	{
		$table = "shopping";
		$response = CarModel::newShopping($table, $data);

		if($response == "ok"){

			$tabla = "comments";
			UserModel::insertComment($tabla, $data);

			/*=============================================
			ACTUALIZAR NOTIFICACIONES NUEVAS VENTAS
			=============================================*/
			$traerNotificaciones = NotificationsController::showNotifications();

			$nuevaVenta = $traerNotificaciones["nuevasVentas"] + 1;

			NotificationsModel::updateNotifications("notifications", "nuevasVentas", $nuevaVenta);

		}

		return $response;
	}

	static public function verifyProduct($data)
	{
		$table = "shopping";
		$response = CarModel::verifyProduct($table, $data);

		return $response;
	}
}
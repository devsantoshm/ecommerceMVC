<?php  

class VisitsController
{
	static public function saveIp($ip, $pais)
	{
		$table = "visitspeople";
		$visita = 1;

		if ($pais == "") {
			$pais = "Unknown";
		}

		$response = VisitsModel::saveIp($table, $ip, $pais, $visita);

		return $response;
	}
}

?>
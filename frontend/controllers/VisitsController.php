<?php  

class VisitsController
{
	static public function saveIp($ip, $pais, $codigo)
	{
		$table = "visitspeople";
		$visita = 1;
		$respuestaInsertarIp = null;
		$respuestaActualizarIp = null;

		if ($pais == "") {
			$pais = "Unknown";
		}

		//BUSCAR IP EXISTENTE
		$buscarIpExistente = VisitsModel::selectIp($table, $ip);

		if (!$buscarIpExistente) {
			//Guardar ip nueva
			$respuestaInsertarIp = VisitsModel::saveIp($table, $ip, $pais, $visita);
			
		} else {
			//SI LA IP EXISTE Y ES OTRO DIA VOLVERA A Guardar
			date_default_timezone_set('America/Lima');
			$fechaActual = date('Y-m-d');
			$encontroFecha = false;
	
			foreach ($buscarIpExistente as $key => $value) {
				$compararFecha = substr($value["fecha"], 0, 10);
				if ($fechaActual == $compararFecha) {
					$encontroFecha = true;
				}
			}

			if (!$encontroFecha) {
				$respuestaActualizarIp = VisitsModel::saveIp($table, $ip, $pais, $visita);
			}
		}

		if ($respuestaInsertarIp == "ok" || $respuestaActualizarIp == "ok") {
			$tableCountry = "visitscountry";
			//SELECCIONAR PAIS
			$seleccionarPais = VisitsModel::selectCountry($tableCountry, $pais);

			if (!$seleccionarPais) {
				//SI NO EXISTE PAIS AGREGAR NUEVO PAIS
				$cantidad = 1;
				$insertarPais = VisitsModel::insertCountry($tableCountry, $pais, $codigo, $cantidad);
			} else {
				//SI EXISTE EL PAIS ACTUALIZAR UNA NUEVA VISITA
				$actualizarCantidad = $seleccionarPais["cantidad"] + 1;
				$actualizarPais = VisitsModel::updateCountry($tableCountry, $pais, $actualizarCantidad);
			}
		}
	}

	static public function showTotalVisits()
	{
		$table = "visitscountry";
		$response = VisitsModel::showTotalVisits($table);
		return $response;
	}

	static public function showCountries()
	{
		$table = "visitscountry";
		$response = VisitsModel::showCountries($table);
		return $response;
	}
}

?>
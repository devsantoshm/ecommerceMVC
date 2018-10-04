<?php  

class HeadersController
{	
	static public function showHeaders($item, $valor)
	{
		$tabla = "headers";
		$response = HeadersModel::showHeaders($tabla, $item, $valor);

		return $response;
	}
}

?>
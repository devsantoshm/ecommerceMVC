<?php  

class BannerController
{	
	static public function showBanner($item, $valor)
	{
		$tabla = "banner";
		$response = BannerModel::showBanner($tabla, $item, $valor);

		return $response;
	}
}

?>
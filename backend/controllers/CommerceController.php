<?php  

class CommerceController
{
	static public function selectTemplate()
	{
		$table = "template";
		$response = CommerceModel::selectTemplate($table);

		return $response; 
	}

	//ACTUALIZAR LOGO O ICONO
	static public function updateLogoIcon($item, $valor)
	{
		$table = "template";
		$id = 1;
		
	}
}

?>
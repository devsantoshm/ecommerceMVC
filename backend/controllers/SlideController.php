<?php  

class SlideController{

	static public function showSlide()
	{
		$tabla = "slide";
		$respuesta = SlideModel::showSlide($tabla);

		return $respuesta;
	}

	static public function createSlide($datos)
	{
		$tabla = "slide";
		$traerSlide = SlideModel::showSlide($tabla);
		//me trae el ultimo orden del slide
		foreach ($traerSlide as $key => $value) {
		}

		$orden = $value["orden"] + 1;

		$respuesta = SlideModel::createSlide($tabla, $datos, $orden);

		return $respuesta;
	}

	static public function updateOrderSlide($datos)
	{
		$tabla = "slide";
		$respuesta = SlideModel::updateOrderSlide($tabla, $datos);

		return $respuesta;
	}

	static public function updateNameSlide($datos)
	{
		$tabla = "slide";
		$respuesta = SlideModel::updateNameSlide($tabla, $datos);

		return $respuesta;
	}
}

?>
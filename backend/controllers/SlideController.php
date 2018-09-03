<?php  

class SlideController{

	static public function showSlide()
	{
		$tabla = "slide";
		$respuesta = SlideModel::showSlide($tabla);

		return $respuesta;
	}
}

?>
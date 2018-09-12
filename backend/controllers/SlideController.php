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

	static public function updateSlide($datos)
	{
		$tabla = "slide";
		$ruta1 = null;

		//SI HAY CAMBIO DE FONDO
		if ($datos["subirFondo"] != null) {
			// BORRAMOS EL ANTIGUO FONDO DEL SLIDE
			if ($datos["imgFondo"] != "views/img/slide/default/fondo.jpg") {
				unlink("../".$datos["imgFondo"]);// salgo de la carpeta ajax
			}

			//CREAMOS EL DIRECTORIO SI NO EXISTE
			$directorio = "../views/img/slide/slide".$datos["id"];
			if (!file_exists($directorio)) {
				mkdir($directorio, 0755);
			}

			//CAPTURAMOS EL ANCHO Y ALTO DEL FONDO DEL SLIDE
			list($ancho, $alto) = getimagesize($datos["subirFondo"]["tmp_name"]);
			$nuevoAncho = 1600;
			$nuevoAlto = 520;

			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

			if ($datos["subirFondo"]["type"] == "image/jpeg") {
				$ruta1 = $directorio."/fondo.jpg";
				$origen = imagecreatefromjpeg($datos["subirFondo"]["tmp_name"]);
				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				imagejpeg($destino, $ruta1);
			}

			if ($datos["subirFondo"]["type"] == "image/png") {
				$ruta1 = $directorio."/fondo.jpg";
				$origen = imagecreatefromjpeg($datos["subirFondo"]["tmp_name"]);
				imagealphablending($destino, FALSE);
				imagesavealpha($destino, TRUE);
				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
				imagepng($destino, $ruta1);
			}

			$rutaFondo = substr($ruta1, 3);

		}else{
			$rutaFondo = $datos["imgFondo"]; // actualizo con la mimsa ruta vieja de la imagen
		}

		$respuesta = SlideModel::updateSlide($tabla, $rutaFondo, $datos);

		return $respuesta;
	}
}

?>
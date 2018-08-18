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

		$plantilla = CommerceModel::selectTemplate($table);

		//mientras no sea la imagen puedo enviar el valor del json redes socia
		$valorNuevo = $valor;

		//CAMBIANDO LOGOTIPO O ICONO
		if (isset($valor["tmp_name"])) {
			//getimagesize — Obtener el tamaño de una imagen
			/*$info = array('café', 'marrón', 'cafeína');
			//Enumerar todas las variables
			list($bebida, $color, $energía) = $info;
			echo "El $bebida es $color y la $energía lo hace especial.\n"
			*/
			list($ancho, $alto) = getimagesize($valor["tmp_name"]);
			//CAMBIANDO LOGOTIPO
			if ($item == "logo") {
				//salgo de la carpeta ajax y accedo a views, unlink — Borra un fichero
				unlink("../".$plantilla["logo"]);
				$nuevoAncho = 500;
				$nuevoAlto = 100;
				//imagecreatetruecolor() devuelve un identificador de imagen que representa una imagen en negro del tamaño especificado.
				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				if ($valor["type"] == "image/jpeg") {
					$ruta = "../views/img/plantilla/logo.jpg";
					//imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL
					$origen = imagecreatefromjpeg($valor["tmp_name"]);
					/*
					imagecopyresized() copia una porción de una imagen a otra imagen. dst_image es la imagen de destino, src_image es el identificador de la imagen de origen.
					En otras palabras, imagecopyresized() tomará un área rectangular de src_image de ancho src_w y alto src_h en la posición (src_x,src_y) y la colocará en un área rectangular de dst_image de ancho dst_w y alto dst_h en la posición (dst_x,dst_y).
					*/
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					//imagejpeg — Exportar la imagen al navegador o a un fichero
					imagejpeg($destino, $ruta);
				}

				if ($valor["type"] == "image/png") {
					$ruta = "../views/img/plantilla/logo.png";
					//imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL
					$origen = imagecreatefrompng($valor["tmp_name"]);
					//imagealphablending — Establece el modo de mezcla para una imagen
					//imagesavealpha — Establecer la bandera para guardar la información completa del canal alfa
					// Desactivar la mezcla alfa y establecer la bandera alfa
					// establecer la imagen con fondo transparente
					imagealphablending($destino, FALSE);
					imagesavealpha($destino, TRUE);	

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagepng($destino, $ruta);
				}
			}
			//CAMBIANDO ICONO
			if ($item == "icono") {
				//salgo de la carpeta ajax y accedo a views, unlink — Borra un fichero
				unlink("../".$plantilla["icono"]);
				$nuevoAncho = 100;
				$nuevoAlto = 100;
				//imagecreatetruecolor() devuelve un identificador de imagen que representa una imagen en negro del tamaño especificado.
				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				if ($valor["type"] == "image/jpeg") {
					$ruta = "../views/img/plantilla/icono.jpg";
					//imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL
					$origen = imagecreatefromjpeg($valor["tmp_name"]);
					/*
					imagecopyresized() copia una porción de una imagen a otra imagen. dst_image es la imagen de destino, src_image es el identificador de la imagen de origen.
					En otras palabras, imagecopyresized() tomará un área rectangular de src_image de ancho src_w y alto src_h en la posición (src_x,src_y) y la colocará en un área rectangular de dst_image de ancho dst_w y alto dst_h en la posición (dst_x,dst_y).
					*/
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					//imagejpeg — Exportar la imagen al navegador o a un fichero
					imagejpeg($destino, $ruta);
				}

				if ($valor["type"] == "image/png") {
					$ruta = "../views/img/plantilla/icono.png";
					//imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL
					$origen = imagecreatefrompng($valor["tmp_name"]);
					//imagealphablending — Establece el modo de mezcla para una imagen
					//imagesavealpha — Establecer la bandera para guardar la información completa del canal alfa
					// Desactivar la mezcla alfa y establecer la bandera alfa
					// establecer la imagen con fondo transparente
					imagealphablending($destino, FALSE);
					imagesavealpha($destino, TRUE);	

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagepng($destino, $ruta);
				}
			}

			$valorNuevo = substr($ruta, 3);
		}

		$respuesta = CommerceModel::updateLogoIcon($table, $id, $item, $valorNuevo);

		return $respuesta;
	}

	static public function updateColors($datos)
	{
		$table = "template";
		$id = 1;
		$response = CommerceModel::updateColors($table, $id, $datos);

		return $response; 
	}
}

?>
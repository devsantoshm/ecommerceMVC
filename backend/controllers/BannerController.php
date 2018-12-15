<?php  

class BannerController
{	
	static public function showBanner($item, $valor)
	{
		$tabla = "banner";
		$response = BannerModel::showBanner($tabla, $item, $valor);

		return $response;
	}

	/*=============================================
	CREAR BANNER
	=============================================*/
	static public function createBanner(){

		if(isset($_POST["tipoBanner"])){

			/*=============================================
			VALIDAR IMAGEN BANNER
			=============================================*/
			$rutaBanner = "";

			if(isset($_FILES["fotoBanner"]["tmp_name"]) && !empty($_FILES["fotoBanner"]["tmp_name"])){

				/*=============================================
				DEFINIMOS LAS MEDIDAS
				=============================================*/
				list($ancho, $alto) = getimagesize($_FILES["fotoBanner"]["tmp_name"]);

				$nuevoAncho = 1600;
				$nuevoAlto = 550;

				/*=============================================
				DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
				=============================================*/	
				if($_FILES["fotoBanner"]["type"] == "image/jpeg"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					$rutaBanner = "views/img/banner/".$_FILES["fotoBanner"]["name"].".jpg";

					$origen = imagecreatefromjpeg($_FILES["fotoBanner"]["tmp_name"]);	

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $rutaBanner);

				}

				if($_FILES["fotoBanner"]["type"] == "image/png"){

					/*=============================================
					GUARDAMOS LA IMAGEN EN EL DIRECTORIO
					=============================================*/
					$rutaBanner = "views/img/banner/".$_FILES["fotoBanner"]["name"].".png";

					$origen = imagecreatefrompng($_FILES["fotoBanner"]["tmp_name"]);						
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, FALSE);
			
					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $rutaBanner);

				}

			}

			if(isset($_POST["rutaBanner"]) && !empty($_POST["rutaBanner"])){

				$ruta = $_POST["rutaBanner"];

			}else{

				$ruta = "sin-categoria";

			}

			$datos = array("img"=>$rutaBanner,
						   "estado"=>1,
						   "tipo"=>$_POST["tipoBanner"],
						   "ruta"=>$ruta);

			$respuesta = BannerModel::createBanner("banner", $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Banner ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {

						window.location = "banner";

						}
					})

				</script>';

			}
		}
	}
}

?>
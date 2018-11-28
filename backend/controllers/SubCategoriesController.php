<?php  

class SubCategoriesController
{	
	static public function showSubCategories($item, $valor)
	{
		$tabla = "subcategories";
		$response = SubCategoriesModel::showSubCategories($tabla, $item, $valor);

		return $response;
	}

	static public function createSubCategory()
	{
		if(isset($_POST["tituloSubCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tituloSubCategoria"]) && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionSubCategoria"]) ){

				/*=============================================
				VALIDAR IMAGEN PORTADA
				=============================================*/

				$rutaPortada = "views/img/cabeceras/default/default.jpg";

				if(isset($_FILES["fotoPortada"]["tmp_name"]) && !empty($_FILES["fotoPortada"]["tmp_name"])){

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoPortada"]["tmp_name"]);

					$nuevoAncho = 1280;
					$nuevoAlto = 720;

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/	

					if($_FILES["fotoPortada"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$rutaPortada = "views/img/cabeceras/".$_POST["rutaSubCategoria"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoPortada"]["tmp_name"]);	

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						/*Guardar la imagen como 'textosimple.jpg'
						  imagejpeg($im, 'textosimple.jpg');*/
						imagejpeg($destino, $rutaPortada);

					}

					if($_FILES["fotoPortada"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$rutaPortada = "views/img/cabeceras/".$_POST["rutaSubCategoria"].".png";

						$origen = imagecreatefrompng($_FILES["fotoPortada"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
    			
    					imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaPortada);

					}
				}

				/*=============================================
				VALIDAR IMAGEN OFERTA
				=============================================*/

				$rutaOferta = "";

				if(isset($_FILES["fotoOferta"]["tmp_name"]) && !empty($_FILES["fotoOferta"]["tmp_name"])){

					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoOferta"]["tmp_name"]);

					$nuevoAncho = 640;
					$nuevoAlto = 430;

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/	

					if($_FILES["fotoOferta"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$rutaOferta = "views/img/ofertas/".$_POST["rutaSubCategoria"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoOferta"]["tmp_name"]);	

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaOferta);

					}

					if($_FILES["fotoOferta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$rutaOferta = "views/img/ofertas/".$_POST["rutaSubCategoria"].".png";

						$origen = imagecreatefrompng($_FILES["fotoOferta"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
    			
    					imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaOferta);

					}
				}

				/*=============================================
				PREGUNTAMOS SI VIENE OFERTA EN CAMINO
				=============================================*/
				if($_POST["selActivarOferta"] == "oferta"){
					//mb_strtoupper() convierte a mayuscula con acentos
					$datos = array("subcategoria"=>$_POST["tituloSubCategoria"],
								   "idCategoria"=>$_POST["seleccionarCategoria"],
								   "ruta"=>$_POST["rutaSubCategoria"],
								   "estado"=> 1,
								   "titulo"=>$_POST["tituloSubCategoria"],
								   "descripcion"=> $_POST["descripcionSubCategoria"],
								   "palabrasClave"=>$_POST["pClavesSubCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>1,
								   "precioOferta"=>$_POST["precioOferta"],
								   "descuentoOferta"=>$_POST["descuentoOferta"],
								   "imgOferta"=>$rutaOferta,								   
								   "finOferta"=>$_POST["finOferta"]);

				}else{

					$datos = array("subcategoria"=>$_POST["tituloSubCategoria"],
								   "idCategoria"=>$_POST["seleccionarCategoria"],
								   "ruta"=>$_POST["rutaSubCategoria"],
								   "estado"=> 1,
								   "titulo"=>$_POST["tituloSubCategoria"],
								   "descripcion"=> $_POST["descripcionSubCategoria"],
								   "palabrasClave"=>$_POST["pClavesSubCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>0,
								   "precioOferta"=>0,
								   "descuentoOferta"=>0,
								   "imgOferta"=>"",								   
								   "finOferta"=>"");

				}

				HeadersModel::createHeader("headers", $datos);

				$respuesta = SubCategoriesModel::createSubCategory("subcategories", $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La subcategoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
								window.location = "subcategorias";
							}
						})
					</script>';
				}

			}else{

				echo'<script>
					swal({
						  type: "error",
						  title: "¡La subcategoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  })
			  	</script>';

			  	return;
			}
		}
	}

	static public function editSubCategory()
	{
		if(isset($_POST["editarTituloSubCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTituloSubCategoria"]) && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionSubCategoria"]) ){

				/*=============================================
				VALIDAR IMAGEN PORTADA
				=============================================*/

				$rutaPortada = $_POST["antiguaFotoPortada"];

				if(isset($_FILES["fotoPortada"]["tmp_name"]) && !empty($_FILES["fotoPortada"]["tmp_name"])){

					unlink($_POST["antiguaFotoPortada"]);
					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoPortada"]["tmp_name"]);

					$nuevoAncho = 1280;
					$nuevoAlto = 720;

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/	

					if($_FILES["fotoPortada"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$rutaPortada = "views/img/cabeceras/".$_POST["rutaSubCategoria"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoPortada"]["tmp_name"]);	

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						/*Guardar la imagen como 'textosimple.jpg'
						  imagejpeg($im, 'textosimple.jpg');*/
						imagejpeg($destino, $rutaPortada);

					}

					if($_FILES["fotoPortada"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$rutaPortada = "views/img/cabeceras/".$_POST["rutaSubCategoria"].".png";

						$origen = imagecreatefrompng($_FILES["fotoPortada"]["tmp_name"]);						
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
    			
    					imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaPortada);

					}
				}

				/*=============================================
				VALIDAR IMAGEN OFERTA
				=============================================*/

				$rutaOferta = $_POST["antiguaFotoOferta"];

				if(isset($_FILES["fotoOferta"]["tmp_name"]) && !empty($_FILES["fotoOferta"]["tmp_name"])){

					unlink($_POST["antiguaFotoOferta"]);
					/*=============================================
					DEFINIMOS LAS MEDIDAS
					=============================================*/

					list($ancho, $alto) = getimagesize($_FILES["fotoOferta"]["tmp_name"]);

					$nuevoAncho = 640;
					$nuevoAlto = 430;

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/	

					if($_FILES["fotoOferta"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$rutaOferta = "views/img/ofertas/".$_POST["rutaSubCategoria"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoOferta"]["tmp_name"]);	

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaOferta);

					}

					if($_FILES["fotoOferta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$rutaOferta = "views/img/ofertas/".$_POST["rutaSubCategoria"].".png";

						$origen = imagecreatefrompng($_FILES["fotoOferta"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagealphablending($destino, FALSE);
    			
    					imagesavealpha($destino, TRUE);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaOferta);

					}
				}

				/*=============================================
				PREGUNTAMOS SI VIENE OFERTA EN CAMINO
				=============================================*/
				if($_POST["selActivarOferta"] == "oferta"){
					//mb_strtoupper() convierte a mayuscula con acentos
					$datos = array("id"=>$_POST["editarIdSubCategoria"],
								   "subcategoria"=>$_POST["editarTituloSubCategoria"],
								   "idCategoria"=>$_POST["seleccionarCategoria"],
								   "ruta"=>$_POST["rutaSubCategoria"],
								   "estado"=> 1,
								   "idCabecera"=>$_POST["editarIdCabecera"],
								   "titulo"=>$_POST["editarTituloSubCategoria"],
								   "descripcion"=> $_POST["descripcionSubCategoria"],
								   "palabrasClave"=>$_POST["pClavesSubCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>1,
								   "precioOferta"=>$_POST["precioOferta"],
								   "descuentoOferta"=>$_POST["descuentoOferta"],
								   "imgOferta"=>$rutaOferta,								   
								   "finOferta"=>$_POST["finOferta"]);

				}else{

					$datos = array("id"=>$_POST["editarIdSubCategoria"],
								   "subcategoria"=>$_POST["editarTituloSubCategoria"],
								   "idCategoria"=>$_POST["seleccionarCategoria"],
								   "ruta"=>$_POST["rutaSubCategoria"],
								   "estado"=> 1,
								   "idCabecera"=>$_POST["editarIdCabecera"],
								   "titulo"=>$_POST["editarTituloSubCategoria"],
								   "descripcion"=> $_POST["descripcionSubCategoria"],
								   "palabrasClave"=>$_POST["pClavesSubCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>0,
								   "precioOferta"=>0,
								   "descuentoOferta"=>0,
								   "imgOferta"=>"",								   
								   "finOferta"=>"");

					if ($_POST["antiguaFotoOferta"] != "") {
						unlink($_POST["antiguaFotoOferta"]);
					}

				}

				$traerProductos = ProductsModel::showProducts("products", "id_subcategoria", $datos["id"]);

				foreach ($traerProductos as $key => $value) {
					if ($value["precio"] != 0) {
						if ($datos["oferta"] != 0 && $datos["precioOferta"] == 0) {
							
							$precioOfertaActualizado = $value["precio"] - ($value["precio"]*$datos["descuentoOferta"]/100);
							$descuentoOfertaActualizado = $datos["descuentoOferta"];
						}

						if ($datos["oferta"] != 0 && $datos["descuentoOferta"] == 0) {
						
							$precioOfertaActualizado = $datos["precioOferta"];
							$descuentoOfertaActualizado = 100 - ($datos["precioOferta"]*100/$value["precio"]);	
						}
					}

					ProductsModel::updateOfertaProductos("products", $datos, "ofertadoPorSubcategoria", $precioOfertaActualizado, $descuentoOfertaActualizado, $value["id"]);
				}

				HeadersModel::editHeader("headers", $datos);

				$respuesta = SubCategoriesModel::editSubCategory("subcategories", $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La subcategoría ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
								window.location = "subcategorias";
							}
						})
					</script>';
				}

			}else{

				echo'<script>
					swal({
						  type: "error",
						  title: "¡La subcategoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  })
			  	</script>';

			  	return;
			}
		}
	}

	static public function deleteSubCategory()
	{
		if (isset($_GET["idSubCategoria"])) {
			
			$datos = $_GET["idSubCategoria"];
			//eliminar imagen oferta
			if ($_GET["imgOferta"] != "") {
				unlink($_GET["imgOferta"]);
			}

			//eliminar cabecera
			if ($_GET["imgPortada"] != "" && $_GET["imgPortada"] != "views/img/cabeceras/default/default.jpg") {
				unlink($_GET["imgPortada"]);
			}

			HeadersModel::deleteHeader("headers", $_GET["rutaCabecera"]);
			
			// QUITAR LAS SUBCATEGORIAS DE LOS PRODUCTOS
			$traerProductos = ProductsModel::showProducts("products", "id_subcategoria", $_GET["idSubCategoria"]);
			
			foreach ($traerProductos as $key => $value) {
				$item1 = "id_subcategoria";
				$valor1 = 0;
				$item2 = "id";
				$valor2 = $value["id"];

				ProductsModel::updateProducts("products", $item1, $valor1, $item2, $valor2);
			}
			

			$respuesta = SubCategoriesModel::deleteSubCategory("subcategories", $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La subcategoría ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {
							window.location = "subcategorias";
						}
					})
				</script>';
			}
		}
		
	}
}

?>
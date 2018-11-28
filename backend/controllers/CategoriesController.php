<?php  

class CategoriesController
{	
	static public function showCategories($item, $valor)
	{
		$tabla = "categories";
		$response = CategoriesModel::showCategories($tabla, $item, $valor);

		return $response;
	}

	static public function createCategory()
	{
		if(isset($_POST["tituloCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["tituloCategoria"]) && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionCategoria"]) ){

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

						$rutaPortada = "views/img/cabeceras/".$_POST["rutaCategoria"].".jpg";

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

						$rutaPortada = "views/img/cabeceras/".$_POST["rutaCategoria"].".png";

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

						$rutaOferta = "views/img/ofertas/".$_POST["rutaCategoria"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoOferta"]["tmp_name"]);	

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaOferta);

					}

					if($_FILES["fotoOferta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$rutaOferta = "views/img/ofertas/".$_POST["rutaCategoria"].".png";

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
					$datos = array("categoria"=>mb_strtoupper($_POST["tituloCategoria"]),
								   "ruta"=>$_POST["rutaCategoria"],
								   "estado"=> 1,
								   "titulo"=>$_POST["tituloCategoria"],
								   "descripcion"=> $_POST["descripcionCategoria"],
								   "palabrasClave"=>$_POST["pClavesCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>1,
								   "precioOferta"=>$_POST["precioOferta"],
								   "descuentoOferta"=>$_POST["descuentoOferta"],
								   "imgOferta"=>$rutaOferta,								   
								   "finOferta"=>$_POST["finOferta"]);

				}else{

					$datos = array("categoria"=>strtoupper($_POST["tituloCategoria"]),
								   "ruta"=>$_POST["rutaCategoria"],
								   "estado"=> 1,
								   "titulo"=>$_POST["tituloCategoria"],
								   "descripcion"=> $_POST["descripcionCategoria"],
								   "palabrasClave"=>$_POST["pClavesCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>0,
								   "precioOferta"=>0,
								   "descuentoOferta"=>0,
								   "imgOferta"=>"",								   
								   "finOferta"=>"");

				}

				HeadersModel::createHeader("headers", $datos);

				$respuesta = CategoriesModel::createCategory("categories", $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
								window.location = "categorias";
							}
						})
					</script>';
				}

			}else{

				echo'<script>
					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  })
			  	</script>';

			  	return;
			}
		}
	}

	static public function editCategory()
	{
		if(isset($_POST["editarTituloCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTituloCategoria"]) && preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["descripcionCategoria"]) ){

				/*=============================================
				VALIDAR IMAGEN PORTADA
				=============================================*/

				$rutaPortada = $_POST["antiguaFotoPortada"];

				if(isset($_FILES["fotoPortada"]["tmp_name"]) && !empty($_FILES["fotoPortada"]["tmp_name"])){

					// BORRAMOS ANTIGUA FOTO PORTADA
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

						$rutaPortada = "views/img/cabeceras/".$_POST["rutaCategoria"].".jpg";

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

						$rutaPortada = "views/img/cabeceras/".$_POST["rutaCategoria"].".png";

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

					// BORRAMOS ANTIGUA FOTO OFERTA
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

						$rutaOferta = "views/img/ofertas/".$_POST["rutaCategoria"].".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoOferta"]["tmp_name"]);	

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaOferta);

					}

					if($_FILES["fotoOferta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$rutaOferta = "views/img/ofertas/".$_POST["rutaCategoria"].".png";

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
					$datos = array("id"=>$_POST["editarIdCategoria"],
								   "categoria"=>mb_strtoupper($_POST["editarTituloCategoria"]),
								   "ruta"=>$_POST["rutaCategoria"],
								   "estado"=> 1,
								   "idCabecera"=>$_POST["editarIdCabecera"],
								   "titulo"=>$_POST["editarTituloCategoria"],
								   "descripcion"=> $_POST["descripcionCategoria"],
								   "palabrasClave"=>$_POST["pClavesCategoria"],
								   "imgPortada"=>$rutaPortada,
								   "oferta"=>1,
								   "precioOferta"=>$_POST["precioOferta"],
								   "descuentoOferta"=>$_POST["descuentoOferta"],
								   "imgOferta"=>$rutaOferta,								   
								   "finOferta"=>$_POST["finOferta"]);

				}else{

					$datos = array("id"=>$_POST["editarIdCategoria"],
								   "categoria"=>strtoupper($_POST["editarTituloCategoria"]),
								   "ruta"=>$_POST["rutaCategoria"],
								   "estado"=> 1,
								   "idCabecera"=>$_POST["editarIdCabecera"],
								   "titulo"=>$_POST["editarTituloCategoria"],
								   "descripcion"=> $_POST["descripcionCategoria"],
								   "palabrasClave"=>$_POST["pClavesCategoria"],
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

				SubCategoriesModel::updateOfertaSubcategorias("subcategories", $datos, "ofertadoPorCategoria");

				$traerProductos = ProductsModel::showProducts("products", "id_categoria", $datos["id"]);

				foreach ($traerProductos as $key => $value) {
					if ($datos["oferta"] != 0 && $datos["precioOferta"] == 0) {
						if ($value["precio"] != 0) {
							$precioOfertaActualizado = $value["precio"] - ($value["precio"]*$datos["descuentoOferta"]/100);
							$descuentoOfertaActualizado = $datos["descuentoOferta"];
						}else{
							$precioOfertaActualizado = 0;
							$descuentoOfertaActualizado = 0;
						}
					}

					if ($datos["oferta"] != 0 && $datos["descuentoOferta"] == 0) {
						if ($value["precio"] != 0) {
							$precioOfertaActualizado = $datos["precioOferta"];
							$descuentoOfertaActualizado = 100 - ($datos["precioOferta"]*100/$value["precio"]);	
						}else{
							$precioOfertaActualizado = 0;
							$descuentoOfertaActualizado = 0;
						}
					}

					ProductsModel::updateOfertaProductos("products", $datos, "ofertadoPorCategoria", $precioOfertaActualizado, $descuentoOfertaActualizado, $value["id"]);
				}

				HeadersModel::editHeader("headers", $datos);

				$respuesta = CategoriesModel::editCategory("categories", $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
								window.location = "categorias";
							}
						})
					</script>';
				}

			}else{

				echo'<script>
					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  })
			  	</script>';

			  	return;
			}
		}
	}

	static public function deleteCategory()
	{
		if (isset($_GET["idCategoria"])) {
			
			//eliminar imagen oferta
			if ($_GET["imgOferta"] != "") {
				unlink($_GET["imgOferta"]);
			}

			//eliminar cabecera
			if ($_GET["imgPortada"] != "" && $_GET["imgPortada"] != "views/img/cabeceras/default/default.jpg") {
				unlink($_GET["imgPortada"]);
			}

			HeadersModel::deleteHeader("headers", $_GET["rutaCabecera"]);
			
			// QUITAR LAS CATEGORIAS DE LAS SUBCATEGORIAS
			$traerSubCategorias = SubCategoriesModel::showSubCategories("subcategories", "id_categoria", $_GET["idCategoria"]);
			if ($traerSubCategorias) {
				foreach ($traerSubCategorias as $key => $value) {
					$item1 = "id_categoria";
					$valor1 = 0;
					$item2 = "id";
					$valor2 = $value["id"];

					SubCategoriesModel::updateSubCategories("subcategories", $item1, $valor1, $item2, $valor2);
				}
			}

			// QUITAR LAS CATEGORIAS DE LAS PRODUCTOS
			$traerProductos = ProductsModel::showProducts("products", "id_categoria", $_GET["idCategoria"]);
			if ($traerProductos) {
				foreach ($traerProductos as $key => $value) {
					$item1 = "id_categoria";
					$valor1 = 0;
					$item2 = "id";
					$valor2 = $value["id"];

					ProductsModel::updateProducts("products", $item1, $valor1, $item2, $valor2);
				}
			}

			$respuesta = CategoriesModel::deleteCategory("categories", $_GET["idCategoria"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La categoría ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {
							window.location = "categorias";
						}
					})
				</script>';
			}
		}
		
	}
}

?>
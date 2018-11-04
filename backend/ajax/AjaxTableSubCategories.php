<?php
require_once "../controllers/SubCategoriesController.php";
require_once "../models/SubCategoriesModel.php";

require_once "../controllers/CategoriesController.php";
require_once "../models/CategoriesModel.php";

require_once "../controllers/HeadersController.php";
require_once "../models/HeadersModel.php";

class AjaxTableSubCategories{

 	public function showTableSubCategories()
 	{	
 		$item = null;
 		$valor = null;

 		$subcategories = SubCategoriesController::showSubCategories($item, $valor);
 		//json_encode($categories); //json_encode — Retorna la representación JSON del valor dado
 		//return ; //canela todo lo que viene debajo
	 	$datosJson = '{
		  "data": [ ';

		for($i = 0; $i < count($subcategories); $i++)
		{
			//TRAER CATEGORIAS
			$item = "id";
			$valor = $subcategories[$i]["id_categoria"];

			$categorias = CategoriesController::showCategories($item, $valor);

			if ($categorias["categoria"] == "") {
				$categoria = "SIN CATEGORÍA";
			} else {
				$categoria = $categorias["categoria"];
			}
			
			// REVISAR ESTADO 
			if ($subcategories[$i]["estado"] == 0) {
				$colorEstado = "btn-danger";
				$textoEstado = "Desactivado";
				$estadoSubCategoria = 1;
			} else {
				$colorEstado = "btn-success";
				$textoEstado = "Activado";
				$estadoSubCategoria = 0;
			}
			
			$estado = "<button class='btn ".$colorEstado." btn-xs btnActivar' estadoSubCategoria='".$estadoSubCategoria."' idSubCategoria='".$subcategories[$i]["id"]."'>".$textoEstado."</button>";

			//REVISAR IMAGEN PORTADA
			$item2 = "ruta";
			$valor2 = $subcategories[$i]["ruta"];

			$headers = HeadersController::showHeaders($item, $valor);

			if ($headers["portada"] != "") {
				$imgPortada = "<img class='img-thumbnail imgPortadaSubCategorias' src='".$headers["portada"]."' width='100px'>";
			} else {
				$imgPortada = "<img class='img-thumbnail imgPortadaSubCategorias' src='views/img/cabeceras/default/default.jpg' width='100px'>";
			}

			//REVISAR OFERTAS
			if ($subcategories[$i]["oferta"] != 0) {
				if ($subcategories[$i]["precioOferta"] != 0) {
					$tipoOferta = "PRECIO";
					$valorOferta = "$ ".number_format($subcategories[$i]["precioOferta"], 2);
				} else {
					$tipoOferta = "DESCUENTO";
					$valorOferta = $subcategories[$i]["descuentoOferta"]." %";
				}
				
			} else {
				$tipoOferta = "No tiene oferta";
				$valorOferta = 0;
			}
			
			if ($subcategories[$i]["imgOferta"] != "") {
				$imgOferta = "<img class='img-thumbnail imgTablaSubCategorias' src='".$subcategories[$i]["imgOferta"]."' width='100px'>";
			} else {
				$imgOferta = "<img class='img-thumbnail imgTablaSubCategorias' src='views/img/ofertas/default/default.jpg' width='100px'>";
			}
			
			$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarSubCategoria' idSubCategoria='".$subcategories[$i]["id"]."' data-toggle='modal' data-target='#modalEditarSubCategoria'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarSubCategoria' idSubCategoria='".$subcategories[$i]["id"]."' imgPortada='".$headers["portada"]."' rutaCabecera='".$subcategories[$i]["ruta"]."' imgOferta='".$subcategories[$i]["imgOferta"]."'><i class='fa fa-times'></i></button></div>";

			$datosJson .= '[
			      "'.($i+1).'",
			      "'.$subcategories[$i]["subcategoria"].'",
			      "'.$categoria.'",
			      "'.$subcategories[$i]["ruta"].'",
			      "'.$estado.'",
			      "'.$headers["descripcion"].'",
			      "'.$headers["palabrasClave"].'",
			      "'.$imgPortada.'",
			      "'.$tipoOferta.'",
			      "'.$valorOferta.'",
			      "'.$imgOferta.'",
			      "'.$subcategories[$i]["finOferta"].'",
			      "'.$acciones.'"
			    ],';
		}
		
		//devuelve parte de una cadena substr("abcdef", 0, -1);  // devuelve "abcde"
		$datosJson = substr($datosJson, 0, -1);

		$datosJson .= '] 
		
		}';

		echo $datosJson;
 	}
}

/*=============================================
ACTIVAR TABLA DE SUBCATEGORÍAS
=============================================*/ 
$activarSubcategoria = new AjaxTableSubCategories();
$activarSubcategoria->showTableSubCategories();
<?php
require_once "../controllers/CategoriesController.php";
require_once "../models/CategoriesModel.php";

require_once "../controllers/HeadersController.php";
require_once "../models/HeadersModel.php";

class AjaxTableCategories{

 	public function showTable()
 	{	
 		$item = null;
 		$valor = null;

 		$categories = CategoriesController::showCategories($item, $valor);
 		//json_encode($categories); //json_encode — Retorna la representación JSON del valor dado
 		//return ; //canela todo lo que viene debajo
	 	$datosJson = '{
		  "data": [ ';

		for($i = 0; $i < count($categories); $i++)
		{  
			if ($categories[$i]["estado"] == 0) {
				$colorEstado = "btn-danger";
				$textoEstado = "Desactivado";
				$estadoCategoria = 1;
			} else {
				$colorEstado = "btn-success";
				$textoEstado = "Activado";
				$estadoCategoria = 0;
			}
			
			$estado = "<button class='btn ".$colorEstado." btn-xs btnActivar' estadoCategoria='".$estadoCategoria."' idCategoria='".$categories[$i]["id"]."'>".$textoEstado."</button>";

			$item = "ruta";
			$valor = $categories[$i]["ruta"];

			$headers = HeadersController::showHeaders($item, $valor);

			if ($headers["portada"] != "") {
				$imgPortada = "<img class='img-thumbnail imgPortadaCategorias' src='".$headers["portada"]."' width='100px'>";
			} else {
				$imgPortada = "<img class='img-thumbnail imgPortadaCategorias' src='views/img/cabeceras/default/default.jpg' width='100px'>";
			}

			if ($categories[$i]["oferta"] != 0) {
				if ($categories[$i]["precioOferta"] != 0) {
					$tipoOferta = "PRECIO";
					$valorOferta = "$ ".$categories[$i]["precioOferta"];
				} else {
					$tipoOferta = "DESCUENTO";
					$valorOferta = $categories[$i]["descuentoOferta"]." %";
				}
				
			} else {
				$tipoOferta = "No tiene oferta";
				$valorOferta = 0;
			}
			
			if ($categories[$i]["imgOferta"] != "") {
				$imgOfertas = "<img class='img-thumbnail imgOfertaCategorias' src='".$categories[$i]["imgOferta"]."' width='100px'>";
			} else {
				$imgOfertas = "<img class='img-thumbnail imgOfertaCategorias' src='views/img/ofertas/default/default.jpg' width='100px'>";
			}
			
			$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarCategoria' idCategoria='".$categories[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCategoria'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCategoria' idCategoria='".$categories[$i]["id"]."' imgPortada='".$headers["portada"]."' rutaCabecera='".$categories[$i]["ruta"]."' imgOferta='".$categories[$i]["imgOferta"]."'><i class='fa fa-times'></i></button></div>";

			$datosJson .= '[
			      "'.($i+1).'",
			      "'.$categories[$i]["categoria"].'",
			      "'.$categories[$i]["ruta"].'",
			      "'.$estado.'",
			      "'.$headers["descripcion"].'",
			      "'.$headers["palabrasClave"].'",
			      "'.$imgPortada.'",
			      "'.$tipoOferta.'",
			      "'.$valorOferta.'",
			      "'.$imgOfertas.'",
			      "'.$categories[$i]["finOferta"].'",
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
ACTIVAR TABLA DE CATEGORÍAS
=============================================*/ 
$activar = new AjaxTableCategories();
$activar->showTable();
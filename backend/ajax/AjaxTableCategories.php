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
			
			$estado = "<button class='btn ".$colorEstado." btn-xs' estadoCategoria='".$estadoCategoria." idCategoria='".$categories[$i]["id"]."'>".$textoEstado."</button>";

			$item = "ruta";
			$valor = $categories[$i]["ruta"];

			$headers = HeadersController::showHeaders($item, $valor);

			if ($headers["portada"] != "") {
				$imgPortada = "<img class='img-thumbnail' src='".$headers["portada"]."' width='100px'>";
			} else {
				$imgPortada = "<img class='img-thumbnail' src='views/img/cabeceras/default/default.jpg' width='100px'>";
			}
		
			$imgOfertas = "<img class='img-thumbnail' src='views/img/ofertas/cursos.jpg' width='100px'>";
			$acciones = "<div class='btn-group'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button><button class='btn btn-danger'><i class='fa fa-times'></i></button></div>";

			$datosJson .= '[
			      "'.($i+1).'",
			      "'.$categories[$i]["categoria"].'",
			      "'.$categories[$i]["ruta"].'",
			      "'.$estado.'",
			      "'.$headers["descripcion"].'",
			      "'.$headers["palabrasClave"].'",
			      "'.$imgPortada.'",
			      "descuento",
			      "80%",
			      "'.$imgOfertas.'",
			      "Fechas",
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
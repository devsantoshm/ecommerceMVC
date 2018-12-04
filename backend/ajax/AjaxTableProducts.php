<?php
require_once "../controllers/ProductsController.php";
require_once "../models/ProductsModel.php";

require_once "../controllers/CategoriesController.php";
require_once "../models/CategoriesModel.php";

require_once "../controllers/SubCategoriesController.php";
require_once "../models/SubCategoriesModel.php";

require_once "../controllers/HeadersController.php";
require_once "../models/HeadersModel.php";

class AjaxTableProducts{

 	public function showTableProducts()
 	{	
 		$item = null;
 		$valor = null;

 		$products = ProductsController::showProducts($item, $valor);
 		//json_encode($products); //json_encode — Retorna la representación JSON del valor dado
 		//return ; //canela todo lo que viene debajo
	 	$datosJson = '{
		  "data": [ ';

		for($i = 0; $i < count($products); $i++)
		{  
			/*TRAER LAS CATEGORIAS*/
			$item = "id";
			$valor = $products[$i]["id_categoria"];

			$categories = CategoriesController::showCategories($item, $valor);

			if ($categories["categoria"] == "") {
				$categoria = "SIN CATEGORÍA";
			} else {
				$categoria = $categories["categoria"];
			}

			/*TRAER LAS SUBCATEGORIAS*/
			$item2 = "id";
			$valor2 = $products[$i]["id_subcategoria"];

			$subcategories = SubCategoriesController::showSubCategories($item2, $valor2);

			if ($subcategories[0]["subcategoria"] == "") {
				$subcategoria = "SIN SUBCATEGORÍA";
			} else {
				$subcategoria = $subcategories[0]["subcategoria"];
			}

			/*AGREGAR BOTON ESTADO*/
			if ($products[$i]["estado"] == 0) {
				$colorEstado = "btn-danger";
				$textoEstado = "Desactivado";
				$estadoProducto = 1;
			} else {
				$colorEstado = "btn-success";
				$textoEstado = "Activado";
				$estadoProducto = 0;
			}
			
			$estado = "<button class='btn ".$colorEstado." btn-xs btnActivar' estadoProducto='".$estadoProducto."' idProducto='".$products[$i]["id"]."'>".$textoEstado."</button>";

			/*TRAER CABECERAS*/
			$item3 = "ruta";
			$valor3 = $products[$i]["ruta"];

			$cabeceras = HeadersController::showHeaders($item3, $valor3);

			if($cabeceras["portada"] != ""){
  				$imagenPortada = "<img src='".$cabeceras["portada"]."' class='img-thumbnail imgPortadaProductos' width='100px'>";
  			}else{
  				$imagenPortada = "<img src='views/img/cabeceras/default/default.jpg' class='img-thumbnail imgPortadaProductos' width='100px'>";
  			}

  			/*=============================================
  			TRAER IMAGEN PRINCIPAL
  			=============================================*/
  			$imagenPrincipal = "<img src='".$products[$i]["portada"]."' class='img-thumbnail imgTablaPrincipal' width='100px'>";

  			/*=============================================
			TRAER MULTIMEDIA
  			=============================================*/
  			if($products[$i]["multimedia"] != null){

  				$multimedia = json_decode($products[$i]["multimedia"],true);

  				if($multimedia[0]["foto"] != ""){
  					$vistaMultimedia = "<img src='".$multimedia[0]["foto"]."' class='img-thumbnail imgTablaMultimedia' width='100px'>";
  				}else{
  					//imagenes de previsualizacion de youtube
  					$vistaMultimedia = "<img src='http://i3.ytimg.com/vi/".$products[$i]["multimedia"]."/hqdefault.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";
  				}

  			}else{
  				$vistaMultimedia = "<img src='views/img/multimedia/default/default.jpg' class='img-thumbnail imgTablaMultimedia' width='100px'>";
  			}

  			/*=============================================
  			TRAER DETALLES
  			=============================================*/
  			$detalles = json_decode($products[$i]["detalles"],true);

  			if($products[$i]["tipo"] == "fisico"){

  				$talla = json_encode($detalles["Talla"]);
				$color = json_encode($detalles["Color"]);
				$marca = json_encode($detalles["Marca"]);

				$vistaDetalles = "Talla: ".str_replace(array("[","]",'"'), "", $talla)." - Color: ".str_replace(array("[","]",'"'), "", $color)." - Marca: ".str_replace(array("[","]",'"'), "", $marca);
  			}else{

				$vistaDetalles = "Clases: ".$detalles["Clases"].", Tiempo: ".$detalles["Tiempo"].", Nivel: ".$detalles["Nivel"].", Acceso: ".$detalles["Acceso"].", Dispositivo: ".$detalles["Dispositivo"].", Certificado: ".$detalles["Certificado"];
  			}

  			/*=============================================
  			TRAER PRECIO
  			=============================================*/
  			if($products[$i]["precio"] == 0){
  				$precio = "Gratis";
  			}else{
  				$precio = "$ ".number_format($products[$i]["precio"],2);
  			}

  			/*=============================================
  			TRAER ENTREGA
  			=============================================*/
  			if($products[$i]["entrega"] == 0){
  				$entrega = "Inmediata";
  			}else{
  				$entrega = $products[$i]["entrega"]. " días hábiles";
  			}

  			/*=============================================
  			REVISAR SI HAY OFERTAS
  			=============================================*/
			if($products[$i]["oferta"] != 0){
				if($products[$i]["precioOferta"] != 0){	
					$tipoOferta = "PRECIO";
					$valorOferta = "$ ".number_format($products[$i]["precioOferta"],2);
				}else{
					$tipoOferta = "DESCUENTO";
					$valorOferta = $products[$i]["descuentoOferta"]." %";	
				}	
			}else{
				$tipoOferta = "No tiene oferta";
				$valorOferta = 0;
			}

			/*=============================================
  			TRAER IMAGEN OFERTA
  			=============================================*/
  			if($products[$i]["imgOferta"] != ""){
	  			$imgOferta = "<img src='".$products[$i]["imgOferta"]."' class='img-thumbnail imgTablaProductos' width='100px'>";
	  		}else{
	  			$imgOferta = "<img src='views/img/ofertas/default/default.jpg' class='img-thumbnail imgTablaProductos' width='100px'>";
	  		}

	  		/*=============================================
  			TRAER LAS ACCIONES
  			=============================================*/

  			$acciones = "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$products[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$products[$i]["id"]."' imgOferta='".$products[$i]["imgOferta"]."' rutaCabecera='".$products[$i]["ruta"]."' imgPortada='".$cabeceras["portada"]."' imgPrincipal='".$products[$i]["portada"]."'><i class='fa fa-times'></i></button></div>";

  			/*=============================================
  			CONSTRUIR LOS DATOS JSON
  			=============================================*/

			$datosJson .='[
					
					"'.($i+1).'",
					"'.$products[$i]["titulo"].'",
					"'.$categoria.'",
					"'.$subcategoria.'",
					"'.$products[$i]["ruta"].'",
					"'.$estado.'",
					"'.$products[$i]["tipo"].'",
					"'.$cabeceras["descripcion"].'",
				  	"'.$cabeceras["palabrasClave"].'",
				  	"'.$imagenPortada.'",
				  	"'.$imagenPrincipal.'",
			 	  	"'.$vistaMultimedia.'",
				  	"'.$vistaDetalles.'",
		  			"'.$precio.'",
				  	"'.$products[$i]["peso"].' kg",
				  	"'.$entrega.'",
				  	"'.$tipoOferta.'",
				  	"'.$valorOferta.'",
				  	"'.$imgOferta.'",
				  	"'.$products[$i]["finOferta"].'",			
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
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProducts = new AjaxTableProducts();
$activarProducts->showTableProducts();
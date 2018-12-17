<?php

require_once "../controllers/SalesController.php";
require_once "../models/salesModel.php";

require_once "../controllers/ProductsController.php";
require_once "../models/ProductsModel.php";

require_once "../controllers/UsersController.php";
require_once "../models/UsersModel.php";

class AjaxTableSales{

  /*=============================================
  MOSTRAR LA TABLA DE VENTAS
  =============================================*/
  public function mostrarTabla(){	

  	$ventas = SalesController::showSales();

  	if(count($ventas) == 0){

      $datosJson = '{ "data":[]}';

      echo $datosJson;

      return;

    }

  	$datosJson = '{
		 
	 "data": [ ';

	for($i = 0; $i < count($ventas); $i++){

		/*=============================================
		TRAER PRODUCTO
		=============================================*/
		$item = "id";
		$valor = $ventas[$i]["id_producto"];

		$traerProducto = ProductsController::showProducts($item, $valor);

		$producto = $traerProducto[0]["titulo"];

		$imgProducto = "<img class='img-thumbnail' src='".$traerProducto[0]["portada"]."' width='100px'>";

		$tipo = $traerProducto[0]["tipo"];


		/*=============================================
		TRAER CLIENTE
		=============================================*/
		$item2 = "id";
		$valor2 = $ventas[$i]["id_usuario"];

		$traerCliente = UsersController::showUsers($item2, $valor2);

		$cliente = $traerCliente["nombre"];

		/*=============================================
		TRAER FOTO CLIENTE
		=============================================*/
		if($traerCliente["foto"] != ""){

			if ($traerCliente["modo"] == "directo") {

				$urlBack = "http://localhost/ecommerce/frontend/";
				$imgCliente = "<img class='img-circle' src='".$urlBack.$traerCliente["foto"]."' width='70px'>";

			}else {

				$imgCliente = "<img class='img-circle' src='".$traerCliente["foto"]."' width='70px'>";
			}

		}else{

			$imgCliente = "<img class='img-circle' src='views/img/usuarios/default/anonymous.png' width='70px'>";
		}

		/*=============================================
		TRAER EMAIL CLIENTE
		=============================================*/
		if($ventas[$i]["email"] == ""){

			$email = $traerCliente["email"];

		}else{

			$email = $ventas[$i]["email"];
		}

		/*=============================================
		TRAER PROCESO DE ENVÍO
		=============================================*/
		if($ventas[$i]["envio"] == 0 && $tipo == "virtual"){

			$envio = "<button class='btn btn-info btn-xs'>Entrega inmediata</button>";
		
		}else if($ventas[$i]["envio"] == 0 && $tipo == "fisico"){

			$envio ="<button class='btn btn-danger btn-xs btnEnvio' idVenta='".$ventas[$i]["id"]."' etapa='1'>Despachando el producto</button>";

		}else if($ventas[$i]["envio"] == 1 && $tipo == "fisico"){

			$envio = "<button class='btn btn-warning btn-xs btnEnvio' idVenta='".$ventas[$i]["id"]."' etapa='2'>Enviando el producto</button>";

		}else{

			$envio = "<button class='btn btn-success btn-xs'>Producto entregado</button>";

		}

		/*=============================================
		LOGOS PAYPAL Y PAYU
		=============================================*/
		if($ventas[$i]["metodo"] == "paypal"){

			$metodo = "<img class='img-responsive' src='views/img/plantilla/paypal.jpg' width='300px'>";
		
		}else if($ventas[$i]["metodo"] == "payu"){

			$metodo = "<img class='img-responsive' src='views/img/plantilla/payu.jpg' width='300px'>";
		
		}else{

			$metodo = "GRATIS";

		}


		/*=============================================
		DEVOLVER DATOS JSON
		=============================================*/
		$datosJson	 .= '[
			      		"'.($i+1).'",
			      		"'.$producto.'",
			      		"'.$imgProducto.'",
			      		"'.$cliente.'",
			      		"'.$imgCliente.'",
			      		"$ '.number_format($ventas[$i]["pago"],2).'",
			      		"'.$tipo.'",
			      		"'.$envio.'",
			      		"'.$metodo.'",	
			      		"'.$email.'",
			      		"'.$ventas[$i]["direccion"].'",
			      		"'.$ventas[$i]["pais"].'",
			      		"'.$ventas[$i]["fecha"].'"	
			      		],';

	} 

	$datosJson = substr($datosJson, 0, -1);

	$datosJson.=  ']
		  
	}'; 
  	
  	echo $datosJson;	

  }

}

/*=============================================
ACTIVAR TABLA DE VENTAS
=============================================*/ 
$activar = new AjaxTableSales();
$activar -> mostrarTabla(); 